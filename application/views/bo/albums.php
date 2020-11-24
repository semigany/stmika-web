<h1 class="h3 mb-4 text-gray-800">Albums</h1>
<div class="row">
  <?php foreach ($albums as $album) { ?>



    <div class="col-lg-3 mb-4">
      <a href="<?= base_url('crud/photos') . '/' . $album->id ?>">
        <div class="card bg-secondary text-white shadow">
          <div class="card-body">
            <?= $album->title ?>
            <div class="text-white-50 small">nb: </div>
          </div>
        </div>
      </a>
    </div>

  <?php
  }
  ?>
</div>