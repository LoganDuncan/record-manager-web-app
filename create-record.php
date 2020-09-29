<?php // Filename: create-record.php
$pageTitle = "Create Record";
require_once 'inc/layout/header.inc.php'; 
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1>Create a New Record</h1>
			<?php require_once __DIR__ .'/inc/create/content.inc.php'; ?>
			<?php require_once __DIR__ .'/inc/shared/form.inc.php' ?>
		</div>
    </div>
</div>

<?php require_once 'inc/layout/footer.inc.php'; ?>