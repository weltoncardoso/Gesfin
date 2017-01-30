<style type="text/css">
	th{
		text-align: left;
	}
</style>
<img src="<?php echo BASE_URL; ?>/assets/images/bannerlogin.jpg" width="250" height="50" border="0" />
<h1> Relatório de Vendas</h1>
<fieldset>
	<?php 
	if (isset($filters['client_name']) && !empty($filters['client_name'])) {
		echo "Filtrado pelo Cliente: ".$filters['client_name']."<br/>";
	}
	if (!empty($filters['period1']) && !empty($filters['period2'])) {
		echo "Filtrado no Período: ".date('d/m/y', strtotime($filters['period1']))." a ".date('d/m/y', strtotime($filters['period2']))."<br/>";
	}
	if ($filters['status'] != '') {
		echo "Filtrado com Status: ".$statusname[$filters['status']]."<br/>";
	}
	?>
</fieldset>
<br/>
<table border="0" width="100%">
			<tr>
				<th>Nome do Cliente</th>
				<th>Data</th>
				<th>Status</th>
				<th>Valor</th>
			</tr>
<?php foreach($sales_list as $sale_item): ?>	
			<tr>
				<td><?php echo $sale_item['name']; ?></td>
				<td><?php echo date('d/m/y', strtotime($sale_item['date_sale'])); ?></td>
				<td><?php echo $statusname[$sale_item['status']]; ?></td>
				<td>R$<?php echo number_format($sale_item['total_price'], 2, ',','.'); ?></td>			
			    </tr>
	<?php endforeach; ?>
</table>