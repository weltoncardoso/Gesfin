<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo BASE_URL; ?>/logo.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
<h1>Vendas - Adicionar </h1>

<form method="POST" >
	<label for="busca">Nome do Cliente</label></br>
	<input type="hidden" name="client_id" />
	<input type="text" name="client_name" id="client_name" data-type="search_clients" />
	<button class="client_add_button">+</button>
	</br></br>

	<div style="clear:both;"></div>

	<label for="status">Status da Venda</label></br>
	<select name="status" id="status">
		<option value="0">Orçamento</option>
		<option value="1">Aguardando Pgto</option>
		<option value="2">Pago</option>
		<option value="3">Cancelado</option>
	</select></br></br>

	<label for="total_price">Preço da venda</label></br>
	<input type="text" name="total_price" disabled="disabled" /></br></br>
	<hr/>
	<h4>Produtos</h4>

	<fieldset>
		<legend>Adicionar Produto</legend>
		<input type="text" name="add_prod" id="add_prod" data-type="search_products" />
	</fieldset>
<table border="0" width="100%" id="products_table">
	
 	<tr>
 	<th>Nome do Produto</th>	
 	<th>Quantidade</th>
 	<th>Preço Unit.</th>
 	<th>Sub-total</th>
 	<th>Ações</th>
 	</tr>

</table>

	<hr/>
	<input type="submit" value="Adicionar Venda">


</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_sales_add.js"></script>