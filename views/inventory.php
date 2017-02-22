<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Estoque </h1>

<div class="tabarea">
	<?php if ($edit_permission): ?>
	<div class="tabitem activetab">Serviços </div>
	<div class="tabitem">Produtos</div>
</div>
<div class="tabcontent">
	<div class="tabbody" style="display: block;">

<div class="button" ><a href="<?php echo BASE_URL; ?>/inventory/addService">Adicionar Serviços</a></div>
<?php endif; ?>

<input type="text" id="busca" data-type="search_services" />

		<table border="0" width="100%">
			<tr>
				<th>Descrição</th>
				<th>Preço</th>
				<th>Ações</th>
			</tr>

<?php foreach ($inventory_list_service as $service): ?>
			<tr>
				<td><?php echo $service['name']; ?></td>
				<td width="250">R$<?php echo number_format($service['price'], 2, ',','.'); ?></td>
				<td width="190">
					<div class="button button_small"><a href="<?php echo BASE_URL; ?>/inventory/editService/<?php echo $service['id'];?>">Editar</a></div>
				<div class="button button_small"><a href="<?php echo BASE_URL; ?>/inventory/deleteService/<?php echo $service['id'];?>" onclick="return confirm('Deseja mesmo excluir este Servico?')">Excluir</a></div>
				</td>
			
			    </tr>
	<?php endforeach; ?>
		</table> 
	
	 
		</div>
<?php if ($edit_permission): ?>
		<div class="tabbody">
	<div class="button" ><a href="<?php echo BASE_URL; ?>/inventory/add">Adicionar Produtos</a>
	</div>
<?php endif; ?>

<input type="text" id="busca" data-type="search_products" />

		<table border="0" width="100%">
			<tr>
				<th>Nome</th>
				<th>Preço</th>
				<th>Quant</th>
				<th>Qnt. Min</th>
				<th>Ações</th>
			</tr>

<?php foreach ($inventory_list as $product): ?>
			<tr>
				<td><?php echo $product['name']; ?></td>
				<td width="250">R$<?php echo number_format($product['price'], 2, ',','.'); ?></td>
				<td width="80" style="text-align: center;"><?php echo $product['quant']; ?></td>
				<td width="100" style="text-align: center;"><?php
				if ($product['min_quant'] > $product['quant']) {
					echo '<span style="color:red">'.($product['min_quant']).'</span>';
				}else {
				echo $product['min_quant'];
			          }
				?></td>
				<td width="190">
					<div class="button button_small"><a href="<?php echo BASE_URL; ?>/inventory/edit/<?php echo $product['id'];?>">Editar</a></div>
				<div class="button button_small"><a href="<?php echo BASE_URL; ?>/inventory/delete/<?php echo $product['id'];?>" onclick="return confirm('Deseja mesmo excluir este Produto?')">Excluir</a></div>
				</td>
			
			    </tr>
	<?php endforeach; ?>
		</table>
		</div>

</div>

