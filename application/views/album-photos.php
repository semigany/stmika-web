
<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet"/>

<section id="portfolio" style="margin-top: 80px;">
    <div class="container">

        <header class="section-header">
            <h1 class="detail-main-title">Galerie</h1>
            <h2 class="display-4 text-primary"><?= $album->title ?></h2>
        </header>

        <div class="row" style="position: relative;">
            <?php foreach($photos as $photo) { ?>
                <div class="col-md-3 mb-4">
                    <a href="<?= base_url('uploads/galerie') .'/'. $photo->url ?>" data-toggle="lightbox" data-gallery="gallery">
                        <img src="<?= base_url('uploads/galerie') .'/thumb__'. $photo->url ?>" class="img-fluid rounded" style="width:100%;">
                    </a>

                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>