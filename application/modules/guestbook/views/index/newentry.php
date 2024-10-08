<?php

/** @var \Ilch\View $this */

/** @var \Ilch\Pagination $pagination */
$pagination = $this->get('pagination');

/** @var \Captcha\DefaultCaptcha $defaultcaptcha */
$defaultcaptcha = $this->get('defaultcaptcha');
/** @var \Captcha\GoogleCaptcha $googlecaptcha */
$googlecaptcha = $this->get('googlecaptcha');
?>
<h1><?=$this->getTrans('menuGuestbook') ?></h1>

<form id="guestbookForm" name="guestbookForm" method="POST">
    <?=$this->getTokenField() ?>
    <div class="row mb-3 d-none">
        <label for="bot" class="col-xl-2 col-form-label">
            <?=$this->getTrans('bot') ?>*
        </label>
        <div class="col-xl-8">
            <input type="text"
                   class="form-control"
                   name="bot"
                   id="bot"
                   placeholder="Bot" />
        </div>
    </div>
    <div class="row mb-3<?=$this->validation()->hasError('name') ? ' has-error' : '' ?>">
        <label for="name" class="col-xl-2 col-form-label">
            <?=$this->getTrans('name') ?>*
        </label>
        <div class="col-xl-8">
            <input type="text"
                   class="form-control"
                   name="name"
                   id="name"
                   placeholder="<?=$this->getTrans('name') ?>"
                   value="<?=$this->escape($this->originalInput('name')) ?>" />
        </div>
    </div>
    <div class="row mb-3<?= $this->validation()->hasError('email') ? ' has-error' : '' ?>">
        <label for="email" class="col-xl-2 col-form-label">
            <?=$this->getTrans('email') ?>*
        </label>
        <div class="col-xl-8">
            <input type="email"
                   class="form-control"
                   name="email"
                   id="email"
                   placeholder="<?=$this->getTrans('emailVisibleForAdmins') ?>"
                   value="<?=$this->escape($this->originalInput('email')) ?>" />
        </div>
    </div>
    <div class="row mb-3<?= $this->validation()->hasError('homepage') ? ' has-error' : '' ?>">
        <label for="homepage" class="col-xl-2 col-form-label">
            <?=$this->getTrans('page') ?>
        </label>
        <div class="col-xl-8">
           <input type="text"
                  class="form-control"
                  name="homepage"
                  id="homepage"
                  placeholder="<?=$this->getTrans('page') ?>"
                  value="<?=$this->escape($this->originalInput('homepage')) ?>" />
        </div>
    </div>
    <div class="row mb-3<?= $this->validation()->hasError('text') ? ' has-error' : '' ?>">
        <label for="text" class="col-xl-2 col-form-label">
            <?=$this->getTrans('message') ?>*
        </label>
        <div class="col-xl-8">
            <textarea class="form-control ckeditor"
                      id="ck_1"
                      name="text"
                      id="text"
                      toolbar="ilch_html_frontend"><?=$this->escape($this->originalInput('text')) ?></textarea>
        </div>
    </div>
    <?php if ($this->get('captchaNeeded') && $defaultcaptcha) : ?>
        <?=$defaultcaptcha->getCaptcha($this) ?>
    <?php endif; ?>
    <div class="row mb-3">
        <div class="offset-xl-2 col-xl-8">
            <?php
            if ($this->get('captchaNeeded')) {
                if ($googlecaptcha) {
                    echo $googlecaptcha->setForm('guestbookForm')->getCaptcha($this, 'addButton', 'Guestbook');
                } else {
                    echo $this->getSaveBar('addButton', 'Guestbook');
                }
            } else {
                echo $this->getSaveBar('addButton', 'Guestbook');
            }
            ?>
        </div>
    </div>
</form>
<?=$this->getDialog('mediaModal', $this->getTrans('media'), '<iframe frameborder="0"></iframe>') ?>
