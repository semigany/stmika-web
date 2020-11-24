<link href="<?= base_url('assets') ?>/css/albums.css" rel="stylesheet" />

<section id="services">
    <div class="container">
        <div class="section-header mb-5">
            <h1 class="display-4 text-warning">Galerie</h1>
        </div>
        <div class="row">
            <?php foreach($albums as $album) { ?>
            <a href="<?= base_url('galery/detail') .'/'. $album->id ?>">
            <div class="col-md-3 col-sm-12 p-2">
                <div class="album text-center">
                    <img src="<?= base_url('uploads/galerie') .'/'. $album->url ?>" class="mb-2"
                        style="width: 100%;" />
                    <a href="<?= base_url('galery/detail') .'/'. $album->id ?>"><?= $album->title ?> </a>
                </div>

            </div>
            </a>
            <?php } ?>
        </div>
    </div>
</section>