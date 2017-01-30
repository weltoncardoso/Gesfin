<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Permissões </h1>
<div class="tabarea">
	<div class="tabitem activetab">Grupos de Permissões </div>
	<div class="tabitem">Permissões </div>
</div>
<div class="tabcontent">
	<div class="tabbody" style="display: block;">
	<div class="button" ><a href="<?php echo BASE_URL; ?>/permissions/add_group">Adicionar grupo de permissões</a></div>
		<table border="0" width="100%">
			<tr>
				<th> Nome do Grupo de Permissões</th>
				<th>Ações</th>
			</tr>
			<?php foreach ($permissions_group_list as $p):?>
			<tr>
				<td><?php echo $p['name']; ?></td>
				<td width="190" ><div class="button button_small"><a href="<?php echo BASE_URL; ?>/permissions/edit_group/<?php echo $p['id'];?>">Editar</a></div>
				<div class="button button_small"><a href="<?php echo BASE_URL; ?>/permissions/delete_group/<?php echo $p['id'];?>" onclick="return confirm('Deseja mesmo excluir este grupo de permissões?')">Excluir</a></div>
				</td>
			</tr>
		    <?php endforeach; ?>
		</table> 
	</div>
	<div class="tabbody">
	<div class="button" ><a href="<?php echo BASE_URL; ?>/permissions/add">Adicionar permissão</a></div>
		<table border="0" width="100%">
			<tr>
				<th> Nome da permissão</th>
				<th>Ação</th>
			</tr>
			<?php foreach ($permissions_list as $p):?>
			<tr>
				<td><?php echo $p['name']; ?></th>
				<td width="50" ><div class="button button_small"><a href="<?php echo BASE_URL; ?>/permissions/delete/<?php echo $p['id'];?>" onclick="return confirm('Deseja mesmo excluir esta permissão?')">Excluir</a></div></th>
			</tr>
		    <?php endforeach; ?>
		</table>
	</div>

</div>