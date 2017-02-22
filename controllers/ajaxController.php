<?php
class ajaxController extends controller {

     public function __construct() {
        parent::__construct();
        $u = new Users();
        if ($u->isLogged() == false) {
        	header("Location: ".BASE_URL."/login");
        }
    }
public function index() {}

  public function get_city_list() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $c = new Cidade();

        if(isset($_GET['state']) && !empty($_GET['state'])) {
            $state = addslashes($_GET['state']);
            $data['cities'] = $c->getCityList($state);
        }

        foreach($data['cities'] as $cityk => $city) {
            $data['cities'][$cityk]['Nome'] = utf8_encode($city['Nome']);
            $data['cities'][$cityk]['0'] = utf8_encode($city['0']);
        }

        $json = json_encode($data);


        echo $json;
    }

public function search_clients() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Clients();

        if (isset($_GET['q']) && !empty($_GET['q'])) {
        	$q = addslashes($_GET['q']);

        	$clients = $c->searchClientsByName($q, $u->getCompany());
    

        	foreach($clients as $citem) {
        		$data[] = array(
					'name'=>$citem['name'],
        			'link'=>BASE_URL.'/clients/edit/'.$citem['id'],
                    'id'=>$citem['id']
        			); 
            }

        }

        echo json_encode($data);
}
public function add_client() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Clients();

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = addslashes($_POST['name']);

            $data['id'] = $c->add($u->getCompany(), $name);
            }

        echo json_encode($data);
}
public function search_users() {
        $data = array();
        $u = new Users();       
        $u->setLoggedUser();
        

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);

            $users = $u->searchUsersByName($q, $u->getCompany());
    

            foreach($users as $uitem) {
                $data[] = array(
                    'name'=>$uitem['email'],
                    'link'=>BASE_URL.'/users/edit/'.$uitem['id'],
                    'id'=>$uitem['id']
                    ); 
            }

        }



        echo json_encode($data);
}
public function add_user() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = addslashes($_POST['email']);

            $data['id'] = $u->add($u->getCompany(), $email);
            }

        echo json_encode($data);
}

public function search_products() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $i = new Inventory();

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);

            $products = $i->searchProductByName($q, $u->getCompany()); 

            foreach($products as $pitem) {
                $data[] = array(
                    'name'=>$pitem['name'],
                    'link'=>BASE_URL.'/inventory/edit/'.$pitem['id'],
                    'id'=>$pitem['id'],
                    'price'=>$pitem['price']
                    ); 
            }
            }
            echo json_encode($data);
}

public function add_product() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $i = new Inventory();

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = addslashes($_POST['name']);

            $data['id'] = $i->add($u->getCompany(), $name);
            }

        echo json_encode($data);
}
public function search_services() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $is = new InventoryService();

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);

            $services = $is->searchServiceByName($q, $u->getCompany()); 


            foreach($services as $sitem) {
                $data[] = array(
                    'name'=>$sitem['name'],
                    'link'=>BASE_URL.'/inventoryService/editService/'.$sitem['id'],
                    'id'=>$sitem['id'],
                    'price'=>$sitem['price']
                    ); 
            }

            }
            echo json_encode($data);
}
public function add_services() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $is = new InventoryService();

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = addslashes($_POST['name']);

            $data['id'] = $is->addService($u->getCompany(), $name);
            }

        echo json_encode($data);
}

 }







