<?php

/** @var \Ilch\View $this */

/** @var \Modules\Forum\Models\Remember|null $rememberedPost */
$rememberedPost = $this->get('rememberedPost');
?>
<link href="<?=$this->getModuleUrl('static/css/forum.css') ?>" rel="stylesheet">

<h1><?=$this->getTrans('editRememberedPost') ?></h1>

<div id="editRememberedPost">
    <form id="editRememberedPost_form" method="POST">
        <?=$this->getTokenField() ?>
        <div class="row mb-3<?=$this->validation()->hasError('note') ? ' has-error' : '' ?>">
            <label for="note" class="col-xl-2 col-form-label">
                <?=$this->getTrans('rememberedPostNote') ?>:
            </label>
            <div class="col-xl-6">
                <input type="text"
                       class="form-control"
                       id="note"
                       name="note"
                       maxlength="255"
                       value="<?=($this->originalInput('note') == '') ? $this->escape($rememberedPost->getNote()) : $this->originalInput('note') ?>" />
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary"><?=$this->getTrans('saveNoteRememberedPost') ?></button>
    </form>
</div>
