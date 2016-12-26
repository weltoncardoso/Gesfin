<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
        <title>Painel - <?php echo $viewData['company_name']; ?></title>
    </head>
    <body>
        <?php
        $this->loadViewInTemplate($viewName, $viewData);
        ?>
    </body>
</html>
