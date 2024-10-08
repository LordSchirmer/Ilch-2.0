<?php

/** @var \Ilch\View $this */

/** @var \Modules\Downloads\Models\File $file */
$file = $this->get('file');
$image = '';
if ($file->getFileImage() != '') {
    $image = $this->getBaseUrl($file->getFileImage());
} else {
    $image = $this->getBaseUrl('application/modules/media/static/img/nomedia.png');
}
?>

<h1><?=$this->getTrans('treatFile') ?></h1>
<?php if ($file != '') : ?>
    <form method="POST" action="">
        <div id="gallery">
            <div class="row">
                <div class="col-lg-4">
                    <a href="<?=$this->getBaseUrl($file->getFileUrl()) ?>">
                        <img class="img-thumbnail" src="<?=$image ?>" alt="<?=$this->escape($file->getFileTitle()) ?>" />
                    </a>
                </div>
                <div class="col-lg-8">
                    <?=$this->getTokenField() ?>
                    <div class="row mb-3">
                        <label for="fileTitleInput" class="col-lg-2 col-form-label">
                            <?=$this->getTrans('fileTitle') ?>:
                        </label>
                        <div class="col-xl-8">
                            <input type="text"
                                   class="form-control"
                                   id="fileTitleInput"
                                   name="fileTitle"
                                   value="<?=$this->escape($file->getFileTitle()) ?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="selectedImage" class="col-xl-2 col-form-label">
                            <?=$this->getTrans('fileImage') ?>:
                        </label>
                        <div class="col-xl-8">
                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       id="selectedImage"
                                       name="fileImage"
                                       placeholder="<?=$this->getTrans('fileImageInfo') ?>"
                                       value="<?=$this->escape($file->getFileImage()) ?>" />
                                <span class="input-group-text"><a id="media" href="javascript:media()"><i class="fa-regular fa-image"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fileDescInput" class="col-xl-2 col-form-label">
                            <?=$this->getTrans('fileDesc') ?>:
                        </label>
                        <div class="col-xl-8">
                            <textarea class="form-control"
                                      id="fileDescInput"
                                      name="fileDesc"
                                      rows="8"><?=$this->escape($file->getFileDesc()) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=$this->getSaveBar() ?>
    </form>
<?php else : ?>
    <?=$this->getTrans('noFile') ?>
<?php endif; ?>

<?=$this->getDialog('mediaModal', $this->getTrans('media'), '<iframe frameborder="0"></iframe>') ?>
<script>
<?=$this->getMedia()
        ->addMediaButton($this->getUrl('admin/media/iframe/index/type/single/'))
        ->addUploadController($this->getUrl('admin/media/index/upload'))
?>
</script>
