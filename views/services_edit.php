<h1>Serviços - Editar</h1>

<strong>Nome do Cliente</strong><br/>
<?php echo $service_info['info']['client_name']; ?><br/><br/>

<strong>Data do Serviços</strong><br/>
<?php echo date('d/m/y', strtotime($service_info['info']['date_sale'])); ?><br/><br/>

<strong>Total do Serviços</strong><br/>
R$<?php echo number_format($service_info['info']['total_price'], 2, ',','.'); ?><br/><br/>

<strong>Status do Serviços</strong><br/>
<?php if ($permission_edit): ?>
<form method="POST">
	<select name="status">
		<?php foreach ($statusname as $statuskey => $statusvalue): ?>
			<option value="<?php echo $statuskey; ?>"<?php echo($statuskey == $service_info['info']['status'])?'selected="selected"':''; ?>><?php echo $statusvalue; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
	<input type="submit" value="Salvar" />
	</form>
<?php else: ?>
<?php echo $statusname[$service_info['info']['status']] ?>
<?php endif; ?>
<br/>
<hr/>
<table border="0" width="100%">
	<tr>
		<th>Descrição</th>
		<th>Quantidade</th>
		<th>Preço</th>
		<th>Preço Total</th>
	</tr>
	<?php foreach ($service_info['products'] as $productitem): ?>
		<tr>
			<td><?php echo $productitem['name']; ?></td>
			<td><?php echo $productitem['quant']; ?></td>
			<td><?php echo number_format($productitem['sale_price'], 2, ',','.'); ?></td>
			<td><?php echo number_format($productitem['sale_price'] * $productitem['quant'], 2, ',','.'); ?></td>
		</tr>

	<?php endforeach ?>

</table>