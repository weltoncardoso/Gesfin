<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
        <title>Painel - <?php echo $viewData['company_name']; ?> </title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
        <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>'; </script>

        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>

    </head>
    <body>
         <div class="leftBar">
         </div>
        
        <div class="top">
        <div class="top_rigth1">
           <a href="<?php echo BASE_URL.'/login/logout'; ?>">&nbsp &nbsp &nbsp</a>
        </div>
        <div class="top_rigth2">
           <?php echo $viewData['user_email']; ?> 
        </div> 
            <div style="clear:both"></div>
            
<div class="menuBar">
            <div class="logo">
                <img src="<?php echo BASE_URL; ?>/assets/images/logocliente.png" width="90" height="70" border="0" />
                <div class="company_name">
                <?php echo $viewData['company_name']; ?>
            </div> 
            </div>
            <div class="menuarea">
               <ul>
                   <li><a href="<?php echo BASE_URL; ?>"> &nbsp Home</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/permissions">Permissões</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/users">Usuários</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/clients">Clientes</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/inventory">Estoque</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/sales">Vendas</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/purchases">Compras</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/services">Serviços</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/report">Relatórios</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/analytics">Quadro Analítico</a> </li>
               </ul> 
             </div>
            

        </div>

        </div>
        <div class="container">
        <div class="area">
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        </div>        
        </div>
        <div class="rigthBar">
         </div>
            <div class="fim">
                <img src="<?php echo BASE_URL; ?>/assets/images/logowa.png" width="50" height="50" border="0" /> </br>
            </div>
    </body>
</html>
