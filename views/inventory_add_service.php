<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Serviços - Adicionar </h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST" >
	<label for="name">Descrição</label></br>
	<input type="text" name="name" required /></br></br>

    <label for="price">Preço</label></br>
	<input type="text" name="price" required /></br></br>
	
	<input type="submit" name="Adicionar" />

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_inventory_add.js"></script>