<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('crud/albums') ?>">Albums</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $album->title ?></li>
  </ol>
</nav>
<h1 class="h3 mb-4 text-gray-800"><?= $album->title ?></h1>
<?php
foreach($crud->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($crud->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<?php echo $crud->output; ?>