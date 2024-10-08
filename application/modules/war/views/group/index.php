<?php

/** @var \Ilch\View $this */

/** @var \Ilch\Pagination $pagination */
$pagination = $this->get('pagination');

/** @var \Modules\War\Mappers\War $warMapper */
$warMapper = $this->get('warMapper');
/** @var \Modules\War\Mappers\Games $gamesMapper */
$gamesMapper = $this->get('gamesMapper');
?>
<link href="<?=$this->getBaseUrl('application/modules/war/static/css/style.css') ?>" rel="stylesheet">

<h1><?=$this->getTrans('menuGroups') ?></h1>
<?php if ($this->get('groups')) : ?>
    <?=$pagination->getHtml($this, []) ?>
    <div id="war_index">
        <?php
        /** @var \Modules\War\Models\Group $group */
        foreach ($this->get('groups') as $group) : ?>
            <?php

            $win = 0;
            $lost = 0;
            $drawn = 0;
            $winCount = 0;
            $lostCont = 0;
            $drawnCount = 0;

            $wars = $warMapper->getWars(['group' => $group->getId()]);

            foreach ($wars ?? [] as $war) {
                $enemyPoints = 0;
                $groupPoints = 0;
                $games = $gamesMapper->getGamesByWhere(['war_id' => $war->getId()]);

                if ($games) {
                    foreach ($games as $game) {
                        $groupPoints += $game->getGroupPoints();
                        $enemyPoints += $game->getEnemyPoints();
                    }
                }
                if ($groupPoints > $enemyPoints) {
                    $win++;
                }
                if ($groupPoints < $enemyPoints) {
                    $lost++;
                }
                if ($groupPoints == $enemyPoints) {
                    $drawn++;
                }
                $winCount = $win;
                $lostCont = $lost;
                $drawnCount = $drawn;
            }
            ?>
            <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-12 col-xl-3 text-center">
                        <a href="<?=$this->getUrl(['controller' => 'group', 'action' => 'show', 'id' => $group->getId()]) ?>">
                            <img src="<?=$this->getBaseUrl($group->getGroupImage()) ?>" alt="<?=$group->getGroupName() ?>" class="img-thumbnail img-fluid rounded" />
                        </a>
                    </div>
                    <div class="col-12 col-xl-9 section-box">
                        <h4>
                            <a href="<?=$this->getUrl(['controller' => 'group', 'action' => 'show', 'id' => $group->getId()]) ?>"><?=$this->escape($group->getGroupName()) ?></a>
                        </h4>
                        <strong><?=$this->getTrans('groupDesc') ?></strong>
                        <p><?=$this->escape($group->getGroupDesc()) ?></p>
                        <hr />
                        <div class="row rating-desc">
                            <div class="col-lg-12">
                                <strong><?=$this->getTrans('games') ?></strong><br />
                                <span><?=$this->getTrans('warWin') ?></span>(<?=$winCount ?>)<span class="separator">|</span>
                                <span><?=$this->getTrans('warLost') ?></span>(<?=$lostCont ?>)<span class="separator">|</span>
                                <span><?=$this->getTrans('warDrawn') ?></span>(<?=$drawnCount ?>)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        <?php endforeach; ?>
    </div>
    <?=$pagination->getHtml($this, []) ?>
<?php else : ?>
    <?=$this->getTranslator()->trans('noGroup') ?>
<?php endif; ?>
