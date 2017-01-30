<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Permissões - Adicionar Grupo de Permissões </h1>

<form method="POST">
	
	<label for="name">Nome do Grupo de Permissões</label></br>
	<input type="text" name="name" /></br></br> 

	<label>Permissões</label></br>
	<?php foreach ($permissions_list as $p): ?>
		<div class="p_item">
	  <input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>" />
	  <label for="p_<?php echo $p['id']; ?>"><?php echo $p['name']; ?></label></div>	
	<?php endforeach; ?>
</br></br>

	<input type="submit" name="Adicionar" />

</form>