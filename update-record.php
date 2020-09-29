<?php // Filename: update-record.php
$pageTitle = "Update Record";
require_once 'inc/layout/header.inc.php'; 
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1>Update Record</h1>
			<?php require_once __DIR__ .'/inc/update/content.inc.php'; ?>
			<?php require_once __DIR__ .'/inc/shared/form.inc.php' ?>
		</div>
    </div>
</div>

<?php require_once 'inc/layout/footer.inc.php'; ?>