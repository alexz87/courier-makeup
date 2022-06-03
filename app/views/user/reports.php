<?php

    if ($_COOKIE['login'] == '') {
        header('Location: /user/auth');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="<?=$data['lang']?>">

	<?php require 'public/blocks/head.php'; ?>
	
	<body>

		<?php require 'public/blocks/header.php'; ?>
		
		<div class="container">
			<div class="reports">
				<h1>Місячні звіти:</h1>
				<?=base64_decode($data['reports']->reports)?>
			</div>
		</div>

		<?php require 'public/blocks/footer.php'; ?>
		
		<script src="public/js/jquery360.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="public/js/index.js">
			// code...
		</script>
	</body>
</html>