<?php
foreach ($crud->css_files as $file) : ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<h1 class="h3 mb-4 text-gray-800">Gestion des secteurs d'activités professionnelles</h1>
<?php echo $crud->output; ?>
<?php foreach ($crud->js_files as $file) : ?>
  <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>