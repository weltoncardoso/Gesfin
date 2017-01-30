<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_purchases_add.js"></script>

<h1>Compras - Editar</h1>

<strong>Nome do Usuário</strong><br/>
<?php echo $purchases_info['info']['user_name']; ?><br/><br/>

<strong>Data da Compra</strong><br/>
<?php echo date('d/m/y', strtotime($purchases_info['info']['date_purchase'])); ?><br/><br/>

<strong>Total da Compra</strong><br/>
R$<?php echo number_format($purchases_info['info']['total_price'], 2, ',','.'); ?><br/><br/>

<strong>Status da Compra</strong><br/>
<?php if ($permission_edit): ?>
<form method="POST">
	<select name="status">
		<?php foreach ($statusname as $statuskey => $statusvalue): ?>
			<option value="<?php echo $statuskey; ?>"<?php echo($statuskey == $purchases_info['info']['status'])?'selected="selected"':''; ?>><?php echo $statusvalue; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
	<input type="submit" value="Salvar" />
	</form>
<?php else: ?>
<?php echo $statusname[$purchases_info['info']['status']] ?>
<?php endif; ?>
<br/>
<hr/>
<table border="0" width="100%">
	<tr>
		<th>Nome do Produto</th>
		<th>Quantidade</th>
		<th>Preço</th>
		<th>Preço Total</th>
	</tr>
	<?php foreach ($purchases_info['products'] as $productitem): ?>
		<tr>
			<td><?php echo $productitem['name']; ?></td>
			<td><?php echo $productitem['quant']; ?></td>
			<td><?php echo number_format($productitem['purchase_price'], 2, ',','.'); ?></td>
			<td><?php echo number_format($productitem['purchase_price'] * $productitem['quant'], 2, ',','.'); ?></td>
		</tr>

	<?php endforeach ?>

</table>