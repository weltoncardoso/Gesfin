<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Usuários - Editar </h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	
	<label for="email">E-mail</label></br>
	<?php echo $user_info['email']; ?></br></br>
	<label for="password">Senha</label></br>
	<input type="password" name="password"/></br></br>
	<label for="group">Grupo de permissões</label></br>
	<select name="group" id="group" required >
		<?php foreach ($group_list as $g): ?>
			<option value="<?php echo $g['id']; ?>" <?php echo ($g['id']==$user_info['id_group'])?'selected':'selected'; ?> ><?php echo $g['name']; ?></option>
		<?php endforeach; ?>
	</select></br></br>

	<input type="submit" name="Editar" />

</form>