<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Usuários </h1>
<div class="button" ><a href="<?php echo BASE_URL; ?>/users/add">Adicionar Usuário</a></div>
		<table border="0" width="100%">
			<tr>
				<th>E-mail</th>
				<th>Grupo de Permissões</th>
				<th>Ações</th>
			</tr>
		<?php foreach ($user_list as $us): ?>
			<tr>
				<td><?php echo $us['email']; ?></td>
				<td width="200"><?php echo $us['name']; ?></td>
				<td width="190" >
				<div class="button button_small"><a href="<?php echo BASE_URL; ?>/users/edit/<?php echo $us['id'];?>">Editar</a></div>
				<div class="button button_small"><a href="<?php echo BASE_URL; ?>/users/delete/<?php echo $us['id'];?>" onclick="return confirm('Deseja mesmo excluir este grupo de permissões?')">Excluir</a></div>
				</td>
			</tr>
	<?php endforeach; ?>
		</table> 