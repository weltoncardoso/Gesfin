<h1>Relatório de Vendas</h1>
<form method="GET" onsubmit="return openPopup(this)">
	<div class="report-grid-4">
		Nome do Cliente:<br/>
		<input type="text" name="client_name" />

	</div>
	<div class="report-grid-4">
		Período: <br/>
		De: <input type="date" name="period1" style="width: 200px; margin-top:5px" /> <br/><br/>
		á: <input type="date" name="period2" style="width: 200px" />
		
	</div>
	<div class="report-grid-4">
		Status da Venda: <br/>
		<select name="status"> 
			<option value="">Todos os status</option>
			<?php foreach ($statusname as $statuskey => $statusvalue):?>
				<option value="<?php echo $statuskey; ?>"><?php echo $statusvalue; ?></option>

			<?php endforeach; ?>	
		</select>
	</div>
	<div class="report-grid-4">
			Ordenação: <br/>
		<select name="order"> 
			<option value="date_desc">Mais Recente</option>	
			<option value="date_asc">Mais Antigo</option>
			<option value="status">Status da Venda</option>		
		</select>
	</div>
	<div style="clear: both;"></div>
	<div style="text-align: center;">
	    <input type="submit" value="Gerar Relatório">
	</div>

</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_sales.js"></script>