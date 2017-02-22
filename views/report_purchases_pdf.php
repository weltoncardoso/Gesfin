<style type="text/css">
	th{
		text-align: left;
	}
</style>
<img src="<?php echo BASE_URL; ?>/assets/images/bannerlogin.jpg" width="250" height="50" border="0" />
<h1> Relatório de Compras</h1>
<fieldset>
	<?php 
	if (isset($filters['email']) && !empty($filters['email'])) {
		echo "Filtrado por Usuario: ".$filters['email']."<br/>";
	}
	if (!empty($filters['period1']) && !empty($filters['period2'])) {
		echo "Filtrado no Período: ".date('d/m/y', strtotime($filters['period1']))." a ".date('d/m/y', strtotime($filters['period2']))."<br/>";
	}
	if ($filters['status'] != '') {
		echo "Filtrado por Status: ".$statusname[$filters['status']]."<br/>";
	}
	?>
</fieldset>
<br/>
<table border="0" width="100%">
			<tr>
				<th>usuario</th>
				<th>Data</th>
				<th>Status</th>
				<th>Valor</th>
			</tr>
<?php foreach($purchases_list as $purchase_item): ?>	
			<tr>
				<td><?php echo $purchase_item['email']; ?></td>
				<td><?php echo date('d/m/y', strtotime($purchase_item['date_purchase'])); ?></td>
				<td><?php echo $statusname[$purchase_item['status']]; ?></td>
				<td>R$<?php echo number_format($purchase_item['total_price'], 2, ',','.'); ?></td>			
			    </tr>
	<?php endforeach; ?>
</table>