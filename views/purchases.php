<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Compras</h1>
<div class="button" ><a href="<?php echo BASE_URL; ?>/purchases/add">Adicionar Compra</a></div>

<table border="0" width="100%">
			<tr>
				<th>Nome do Usuário</th>
				<th>Data</th>
				<th>Status</th>
				<th>Valor</th>
				<th>Ações</th>
			</tr>
<?php foreach($purchases_list as $purchase_item): ?>	
			<tr>
				<td><?php echo $purchase_item['email']; ?></td>
				<td width="100"><?php echo date('d/m/y', strtotime($purchase_item['date_purchase'])); ?></td>
				<td width="200"><?php echo $statusname[$purchase_item['status']]; ?></td>
				<td width="200">R$<?php echo number_format($purchase_item['total_price'], 2, ',','.'); ?></td>
				<td width="100">
					<div class="button button_small"><a href="<?php echo BASE_URL; ?>/purchases/edit/<?php echo $purchase_item['id'];?>" >Editar</a></div>
				</td>
			
			    </tr>
	<?php endforeach; ?>
</table>