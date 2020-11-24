<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet"/>
<section id="services">
    <div class="container">
        <div class="section-header">
            <h1 class="display-4">Evènements</h1>
        </div>
        <?php 
            $order1 = 1;
            $order2 = 2;
        foreach($events as $event) { 
            
            ?>

        <div class="row feature-item mb-4">
            <div class="col-lg-6 wow fadeInUp order-<?= $order1 ?>" style="visibility: visible; animation-name: fadeInUp; height: 300px;">
                <a href="<?= base_url('uploads/events') .'/'. $event->photo ?>" data-toggle="lightbox" data-gallery="gallery">
                    <img src="<?= base_url('uploads/events') .'/'. $event->photo ?>" class="img-fluid rounded" style="width:100%; height: 100%; object-fit: cover;">
                </a>
            </div>
            <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0 order-<?= $order2 ?>" style="visibility: visible; animation-name: fadeInUp;">
                <h4><?= $event->title ?></h4>
                <?= $event->description ?>
                Date: <span class="badge badge-pill badge-primary"><?= date_format(date_create($event->start_at),"d/m/Y") ?></span>   <span class="badge badge-pill badge-warning"><?= date_format(date_create($event->end_at),"d/m/Y") ?></span>
            </div>
        </div>
        <hr></hr>
        <?php 
        $order3 = $order1;
        $order1 = $order2;
        $order2 = $order3;
    } 
    
    ?>
    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>