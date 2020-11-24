<section id="services">
    <div class="container">
        <div class="section-header mb-5">
            <h1 class="detail-main-title">Actualités</h1>
            <h2 class="display-5 text-primary"><?= $actu->title ?></h2>
        </div>
        <div>
            <small
                class="d-block mb-3 text-muted"><?= strip_tags(date_format(date_create($actu->date),"d/m/Y")) ?></small>
            <p class="mt-3 mb-3"><?= strip_tags($actu->description) ?></p>
            
            <img src="<?= base_url('uploads/actus') .'/'.$actu->photo?>" style="max-width:100%;">
        </div>
    </div>
</section>