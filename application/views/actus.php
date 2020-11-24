<section id="services">
    <div class="container">
        <div class="section-header mb-5">
            <h1 class="display-4">Actualités</h1>
        </div>
        <div class="row">
            <?php 
                foreach($actus as $actu) {
            ?>
            <div class="col-md-4 col-xs-12 mb-4">
                <img src="<?= base_url('uploads/actus') .'/'.$actu->photo?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $actu->title ?></h5>
                    <p class="crop-text-5 mb-3"><small><?= strip_tags($actu->description) ?></small></p>
                    <small class="d-block text-muted mb-3"><?= strip_tags(date_format(date_create($actu->date),"d/m/Y")) ?></small>
                    <small><a href="<?= base_url('actus/detail').'/'.$actu->id ?>" class="text-warning">Lire la suite</a></small>
                </div>
            </div>
            <?php 
                } 
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
