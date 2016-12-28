<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
        <title>Painel - <?php echo $viewData['company_name']; ?> </title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/template.css">
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.0.js"></script>
    </head>
    <body>
        <div class="leftmenu">
            <div class="company_name">
                <?php echo $viewData['company_name']; ?>
            </div>
            <div style="clear:both"></div>
             </br></br></br></br></br></br>
             <div class="menuarea">
               <ul>
                   <li><a href="<?php echo BASE_URL; ?>">Home</a> </li>
                   <li><a href="<?php echo BASE_URL; ?>/permissions">Permissões</a> </li>
               </ul> 
             </div>
        </div>
        <div class="container">
        <div class="top">
        <div class="top_rigth">
           <a href="<?php echo BASE_URL.'/login/logout'; ?>">Sair</a>
        </div>
        <div class="top_rigth">
           <?php echo $viewData['user_email']; ?> 
        </div>      
        </div>
        <div class="area">
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        </div>        
        </div>
    </body>
</html>
