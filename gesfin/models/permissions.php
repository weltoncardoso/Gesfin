<?php
class Permissions extends model {
	private $group;
	private $permissions;

    public function setGroup($id, $id_company) {
    	$this->group= $id;
    	$this->permissions = array();
    	$sql = $this->db->prepare("SELECT params FROM permission_groups WHERE id = :id AND id_company = :id_company ");
    	$sql->bindValue(':id', $id);
    	$sql->bindValue(':id_company', $id_company);
        $sql->execute();

         if ($sql->rowCount() > 0) {
            $row = $sql->fetch();

            if (empty($row['params'])) {
            	$row['params'] = '0';
            }

            $params = $row['params'];

            $sql = $this->db->prepare("SELECT name FROM permission_params WHERE id IN ($params) AND id_company = :id_company ");
	    	$sql->bindValue(':id_company', $id_company);
	        $sql->execute();

	        if ($sql->rowCount() > 0) {
            foreach ($sql->fetchAll() as $item) {
            	$this->permissions[] = $item['name'];
            }
/* todo o codigo acima e para pegar os parametros do 
 * grupo em seguida com os parametros pegamos os nomes
 * das permissoes. para evitar erro na variavel $row
 * linha 17 foi criado uma seguranca em caso de 
 * retornar null sera substituido por uma permissao nao 
 * existente 0. */


/* All the above code and to get the parameters of the
 * Group next with the parameters we get the names
 * Of the permissions. To avoid error in $row variable
 * Line 17 has created a safety in case of
 * Return null will be replaced with a non-permissive
 * Existing 0. */
       }
    }
  }
// verifica se o usuario logado tem permissao.
// check if the logged-in user has permission.
public function hasPermission($name) {
	 if (in_array($name, $this->permissions)) {
	 	return true;
	 }else {
	 	return false;
	 }
}
// lista todas as permissoes. 
// list all permissions.
public function getList($id_company) {
	$array = array();

	 $sql = $this->db->prepare("SELECT * FROM permission_params WHERE id_company = :id_company ");
	    	$sql->bindValue(':id_company', $id_company);
	        $sql->execute();

	        if ($sql->rowCount() > 0) {
	        	$array = $sql->fetchAll();
	        }
	return $array;
}
// lista todos grupos. 
// list all groups.

public function getGroupList($id_company) {
	$array = array();

	 $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id_company = :id_company ");
	    	$sql->bindValue(':id_company', $id_company);
	        $sql->execute();

	        if ($sql->rowCount() > 0) {
	        	$array = $sql->fetchAll();
	        }
	return $array;
}

public function getGroup($id, $id_company) {
$array = array();

	 $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id = :id AND id_company = :id_company");
	        $sql->bindValue(':id', $id);
	    	$sql->bindValue(':id_company', $id_company);
	        $sql->execute();

	        if ($sql->rowCount() > 0) {
	        	$array = $sql->fetch();
	        	$array['params'] = explode(',', $array['params']);
	        }
	return $array;
}

//insere no DB uma nova permissao
// inserts a new permission into DB

public function add($name, $id_company) {
	$sql = $this->db->prepare("INSERT INTO permission_params SET name = :name, id_company = :id_company");
	$sql->bindValue(':name', $name);
	$sql->bindValue(':id_company', $id_company);
	$sql->execute();
}


public function delete($id) {
	$sql = $this->db->prepare("DELETE FROM permission_params WHERE id = :id");
	$sql->bindValue(':id', $id);
	$sql->execute();

}

//insere e deleta no DB um novo grupo
// inserts and delet is new group into DB
public function add_group($name, $plist, $id_company) {
	$params = implode(',', $plist);
	$sql = $this->db->prepare("INSERT INTO permission_groups SET name = :name, id_company = :id_company, params = :params");
	$sql->bindValue(':name', $name);
	$sql->bindValue(':id_company', $id_company);
	$sql->bindValue(':params', $params);
	$sql->execute();
}

public function deleteGroup($id) {
	$u = new Users();

	if ($u->findUserInGroup($id) == false) {

	$sql = $this->db->prepare("DELETE FROM permission_groups WHERE id = :id");
	$sql->bindValue(':id', $id);
	$sql->execute();
}
}
public function editGroup($name, $plist, $id, $id_company) {
	$params = implode(',', $plist);
	$sql = $this->db->prepare("UPDATE permission_groups SET name = :name, id_company = :id_company, params = :params WHERE id = :id");
	$sql->bindValue(':name', $name);
	$sql->bindValue(':id_company', $id_company);
	$sql->bindValue(':params', $params);
	$sql->bindValue(':id', $id);
	$sql->execute();
}
}