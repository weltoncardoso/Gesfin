<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Serviços</h1>
<div class="button" ><a href="<?php echo BASE_URL; ?>/services/add">Adicionar Serviços</a></div>

<table border="0" width="100%">
			<tr>
				<th>Nome do Cliente</th>
				<th>Data</th>
				<th>Status</th>
				<th>Valor</th>
				<th>Ações</th>
			</tr>
<?php foreach($inventory_list_service as $service_item): ?>	
			<tr>
				<td><?php echo $service_item['name']; ?></td>
				<td width="100"><?php echo date('d/m/y', strtotime($service_item['date_sale'])); ?></td>
				<td width="200"><?php echo $statusname[$service_item['status']]; ?></td>
				<td width="200">R$<?php echo number_format($service_item['total_price'], 2, ',','.'); ?></td>
				<td width="260">
					<div class="button button_small"><a href="<?php echo BASE_URL; ?>/services/edit/<?php echo $service_item['id'];?>" >Editar</a></div>

					<?php if (!empty($service_item['nfe_key'])):?>
						<div class="button button_small"><a target="_blank" href="<?php echo BASE_URL; ?>/services/view_nfe/<?php echo $service_item['nfe_key'];?>" >Visualizar NF-e</a></div>
						<?php else: ?>
						<div class="button button_small"><a target="_blank" href="<?php echo BASE_URL; ?>/services/generate_nfe/<?php echo $service_item['id'];?>" >Emitir NF-e</a></div>
						<?php endif; ?>
				</td>
			
			    </tr>
	<?php endforeach; ?>
</table>