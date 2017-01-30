<?php
class reportController extends controller {

     public function __construct() {
        parent::__construct();
        $u = new Users();
        if ($u->isLogged() == false) {
          header("Location: ".BASE_URL."/login");
          exit;
        }
    }
       public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

          if ($u->hasPermission('report_view')) {
        $this->loadTemplate('report', $data);
     } else {
            header("Location: ".BASE_URL);
           }

    }

    public function sales() {
              $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['statusname'] = array(
          '0'=>'Orçamento',
          '1'=>'Aguardando Pgto.',
          '2'=>'Pago',
          '3'=>'Cancelado'
          );

          if ($u->hasPermission('report_view')) {


        $this->loadTemplate('report_sales', $data);
     } else {
            header("Location: ".BASE_URL);
           }
    }

    public function sales_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $data['statusname'] = array(
          '0'=>'Orçamento',
          '1'=>'Aguardando Pgto.',
          '2'=>'Pago',
          '3'=>'Cancelado'
          );

          if ($u->hasPermission('report_view')) {

            $client_name = addslashes($_GET['client_name']);
            $period1 = addslashes($_GET['period1']);
            $period2 = addslashes($_GET['period2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);

            $s = new Sales();
            $data['sales_list'] = $s->getSalesFiltered($client_name, $period1, $period2, $status, $order, $u->getCompany());

            $data['filters'] = $_GET;
        $this->loadLibrary('mpdf60/mpdf');
//metodo php que pega o html gerado e armazena em um buffer
// php method that takes the generated html and stores it in a buffer
        ob_start();

        $this->loadView('report_sales_pdf', $data);
// pega o buffer que esta armazenado desde o ob e passa para a variavel $html
// get the buffer that is stored from the ob and goes to the $ html variable

        $html = ob_get_contents();
//limpa a area de buffer
// clear the buffer area
        ob_end_clean();

     $mpdf =  new mPDF();//inicia o pdf
     $mpdf->WriteHTML($html);//escreve nele todo html
     $mpdf->Output();//mostrar o pdf
        

     } else {
            header("Location: ".BASE_URL);
           }
    }

    public function inventory() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

          if ($u->hasPermission('report_view')) {


        $this->loadTemplate('report_inventory', $data);
     } else {
            header("Location: ".BASE_URL);
           }
    }

     public function inventory_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

          if ($u->hasPermission('report_view')) {;

            $i = new Inventory();
            $data['inventory_list'] = $i->getInventoryFiltered($u->getCompany());

            $data['filters'] = $_GET;
        $this->loadLibrary('mpdf60/mpdf');
//metodo php que pega o html gerado e armazena em um buffer
// php method that takes the generated html and stores it in a buffer
        ob_start();

        $this->loadView('report_inventory_pdf', $data);
// pega o buffer que esta armazenado desde o ob e passa para a variavel $html
// get the buffer that is stored from the ob and goes to the $ html variable

        $html = ob_get_contents();
//limpa a area de buffer
// clear the buffer area
        ob_end_clean();

     $mpdf =  new mPDF();//inicia o pdf
     $mpdf->WriteHTML($html);//escreve nele todo html
     $mpdf->Output();//mostrar o pdf
        

     } else {
            header("Location: ".BASE_URL);
           }
    }

}