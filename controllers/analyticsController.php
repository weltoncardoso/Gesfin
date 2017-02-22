<?php
class analyticsController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Users();
        if ($u->isLogged() == false) {
        	header("Location: ".BASE_URL."/login");
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $s = new Sales();
        $se = new Services();
        $p = new Purchases();

        $data['statusname'] = array(
            '0'=>'Orçamento',
            '1'=>'Aguardando Pgto.',
            '2'=>'Pago',
            '3'=>'Cancelado'
            ); 


        $data['products_sold']= $s->getSoldProducts(date('y-m-d', strtotime('-30 days')), date('y-m-d'), $u->getCompany());
        $data['services_sold']= $se->getSoldServices(date('y-m-d', strtotime('-30 days')), date('y-m-d'), $u->getCompany());
        $data['revenue'] = ($s->getTotalRevenue(date('y-m-d', strtotime('-30 days')), date('y-m-d'), $u->getCompany())+ $se->getTotalRevenue(date('y-m-d', strtotime('-30 days')), date('y-m-d'), $u->getCompany()) );
        $data['revenue_service'] = $se->getTotalRevenue(date('y-m-d', strtotime('-30 days')), date('y-m-d'), $u->getCompany());
        $data['expenses'] = $s->getTotalExpenses(date('y-m-d', strtotime('-30 days')), date('y-m-d'), $u->getCompany());  
         $data['days_list'] = array();
         for ($q=30; $q>0 ; $q--) { 
             $data['days_list'][] = date('d/m', strtotime('-'.$q.' days'));
         }

         $data['revenue_list'] = $s->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
         $data['revenue_list_service'] = $se->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
         $data['expenses_list'] = $p->getExpensesList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
         $data['status_list'] = $s->getStatusList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
         $data['status_list_services'] = $se->getStatusList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

          $data['status_list_purchases'] = $p->getStatusListPurchases(date('Y-m-d', strtotime('-7 days')), date('Y-m-d'), $u->getCompany());

          $data['days_list_week'] = array();
         for ($q=7; $q>0 ; $q--) { 
             $data['days_list_week'][] = date('d/m', strtotime('-'.$q.' days'));
         }
         $data['revenue_list_week'] = $s->getRevenueList(date('Y-m-d', strtotime('-7 days')), date('Y-m-d'), $u->getCompany());
         $data['expenses_list_week'] = $p->getExpensesList(date('Y-m-d', strtotime('-7 days')), date('Y-m-d'), $u->getCompany());

        $this->loadTemplate('analytics', $data);
    }

}