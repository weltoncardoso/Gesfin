        <meta charset="UTF-8">
        <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
        <title>Painel - <?php echo $viewData['company_name']; ?> </title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
<div class="db-row row1">
	<div class="grid-1">
		<div class="db-grid-area">
			<div class="db-grid-area-count">
			<?php echo $products_sold; ?>
		</div>
		<div class="db-grid-area-legend">
			Vendas
		</div>
		</div>
	</div>
	<div class="grid-1">
		<div class="db-grid-area">
			<div class="db-grid-area-count">
			R$ <?php echo number_format($revenue, 2); ?>
		</div>
		<div class="db-grid-area-legend">
			Receita
		</div>
		</div>
	</div>
	<div class="grid-1">
		<div class="db-grid-area">
			<div class="db-grid-area-count">
			R$ <?php echo number_format($expenses, 2); ?>
		</div>
		<div class="db-grid-area-legend">
			Despesas
		</div>
		</div>
</div>
<div class="db-row row2">
	<div class="grid-2">
		<div class="db-info">
			<div class="db-info-title">Despesas e Receita Mensal</div>
			<div class="db-info-body" >
				<canvas id="rel1" style="height: 200px"> </canvas>
			</div>
		</div>
    </div>
    <div class="grid-1">
		<div class="db-info">
			<div class="db-info-title">Status das Vendas</div>
			<div class="db-info-body">
				<canvas id="rel2" height="325"> </canvas>
			</div>
		</div>
    </div>
</div>
<div class="db-row">

<div class="db-row row3">
	<div class="grid-2">
		<div class="db-info">
			<div class="db-info-title">Despesas e Receita Semanal</div>
			<div class="db-info-body" >
				<canvas id="rel3" style="height: 200px"> </canvas>
			</div>
		</div>
    </div>
    <div class="grid-1">
		<div class="db-info">
			<div class="db-info-title">Status das Compras</div>
			<div class="db-info-body">
				<canvas id="rel4" height="325"> </canvas>
			</div>
		</div>
    </div>
</div>
<div class="db-row">

<script type="text/javascript">
	var days_list = <?php echo json_encode($days_list) ?>;
	var revenue_list = <?php echo json_encode(array_values($revenue_list)) ?>;
	var expenses_list = <?php echo json_encode(array_values($expenses_list)) ?>;

	var status_name_list = <?php echo json_encode(array_values($statusname)) ?>;
	var status_list = <?php echo json_encode(array_values($status_list)) ?>;

	var status_list_purchases = <?php echo json_encode(array_values($status_list_purchases)) ?>;
	var days_list_week = <?php echo json_encode($days_list_week) ?>;
	var revenue_list_week = <?php echo json_encode(array_values($revenue_list_week)) ?>;
	var expenses_list_week = <?php echo json_encode(array_values($expenses_list_week)) ?>;

</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_home.js"></script>
