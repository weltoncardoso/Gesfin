<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Vendas</h1>
<div class="button" ><a href="<?php echo BASE_URL; ?>/sales/add">Adicionar Venda</a></div>

<table border="0" width="100%">
			<tr>
				<th>Nome do Cliente</th>
				<th>Data</th>
				<th>Status</th>
				<th>Valor</th>
				<th>Ações</th>
			</tr>
<?php foreach($sales_list as $sale_item): ?>	
			<tr>
				<td><?php echo $sale_item['name']; ?></td>
				<td width="80"><?php echo date('d/m/y', strtotime($sale_item['date_sale'])); ?></td>
				<td><?php echo $statusname[$sale_item['status']]; ?></td>
				<td width="250">R$<?php echo number_format($sale_item['total_price'], 2, ',','.'); ?></td>
				<td width="190">
					
				</td>
			
			    </tr>
	<?php endforeach; ?>
</table>