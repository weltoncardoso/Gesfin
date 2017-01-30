
<?php
class permissionsController extends controller {

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
//verifica se o usuario tem permissao para acessar esta view
// check if the user has permission to access this view
          if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $data['permissions_list'] = $permissions->getList($u->getCompany());
            $data['permissions_group_list'] = $permissions->getGroupList($u->getCompany());

             $this->loadTemplate('permissions', $data);   
           } else {
            header("Location: ".BASE_URL);
           }
      
    }
// Acao para adicionar permissao  
// Action to add permission  
        public function add() {
                   $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
          if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();

              if (isset($_POST['name']) && !empty($_POST['name'])) {
               $pname = addslashes($_POST['name']);
               $permissions->add($pname, $u->getCompany());
               header("Location: ".BASE_URL."/permissions");

              }

             $this->loadTemplate('permissions_add', $data);   
           } else {
            header("Location: ".BASE_URL);
           } 
        }

// Acao para adicionar grupo  
// Action to add group  
    public function add_group() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
          if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();

              if (isset($_POST['name']) && !empty($_POST['name'])) {
               $pname = addslashes($_POST['name']);
               $plist = $_POST['permissions'];
               $permissions->add_group($pname, $plist, $u->getCompany());
               header("Location: ".BASE_URL."/permissions");

              }

               $data['permissions_list'] = $permissions->getList($u->getCompany());

             $this->loadTemplate('permissions_add_group', $data);   
           } else {
            header("Location: ".BASE_URL);
           } 
        }

    public function delete($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
          if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $permissions->delete($id);
            header("Location: ".BASE_URL."/permissions");
           } else {
            header("Location: ".BASE_URL);
           } 
        }

    public function delete_group($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
          if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $permissions->deleteGroup($id);
            header("Location: ".BASE_URL."/permissions");
           } else {
            header("Location: ".BASE_URL);
           } 
        }

    public function edit_group($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
          if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();

              if (isset($_POST['name']) && !empty($_POST['name'])) {
               $pname = addslashes($_POST['name']);
               $plist = $_POST['permissions'];
               $permissions->editGroup($pname, $plist, $id, $u->getCompany());
               header("Location: ".BASE_URL."/permissions");

              }

               $data['permissions_list'] = $permissions->getList($u->getCompany());
               $data['group_info'] = $permissions->getGroup($id, $u->getCompany());

             $this->loadTemplate('permissions_edit_group', $data);   
           } else {
            header("Location: ".BASE_URL);

           } 
        }

}