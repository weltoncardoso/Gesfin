<?php
class InventoryService extends model {

  public function getListService($offset, $id_company) {;
  	$array = array();
   $sql = $this->db->prepare("SELECT * FROM inventory_service WHERE id_company = :id_company LIMIT $offset, 10");
   $sql->bindValue(':id_company', $id_company);
   $sql->execute();
if ($sql->rowCount() > 0) {
	$array = $sql->fetchAll();
}

return $array;
  }

  public function getInfoService($id, $id_company) {
   $array = array();
   $sql = $this->db->prepare("SELECT * FROM inventory_service WHERE id = :id AND id_company = :id_company");
   $sql->bindValue(':id', $id);
   $sql->bindValue(':id_company', $id_company);
   $sql->execute();

   if ($sql->rowCount() > 0) {
	$array = $sql->fetch();
}
return $array;
}

public function setLog($id_service, $id_company, $id_user, $action) {
	 $sql = $this->db->prepare("INSERT INTO inventory_service_history SET id_company = :id_company, id_service = :id_service, id_user = :id_user, action = :action, date_action = NOW()");

  		  $sql->bindValue(':id_company', $id_company);
          $sql->bindValue(':id_service', $id_service);
          $sql->bindValue(':id_user', $id_user);
          $sql->bindValue(':action', $action);
          $sql->execute();
}

public function addService($name, $price, $id_company, $id_user) {
	
   $sql = $this->db->prepare("INSERT INTO inventory_service SET name = :name, price = :price, id_company = :id_company");

          $sql->bindValue(':name', $name);
          $sql->bindValue(':price', $price);
          $sql->bindValue(':id_company', $id_company);
          $sql->execute();

          $id_product = $this->db->lastInsertId();
		  $this->setLog($id_service, $id_company, $id_user, 'add');
}

public function editService($id, $name, $price, $id_company, $id_user) {
	
   $sql = $this->db->prepare("UPDATE inventory_service SET name = :name, price = :price, WHERE id = :id AND id_company = :id_company");

   		    $sql->bindValue(':id', $id);
          $sql->bindValue(':name', $name);
          $sql->bindValue(':price', $price);
          $sql->bindValue(':id_company', $id_company);
          $sql->execute();

          $this->setLog($id, $id_company, $id_user, 'edt');
}
public function deleteService($id, $id_company, $id_user) {
	
   $sql = $this->db->prepare("DELETE FROM inventory_service WHERE id = :id AND id_company = :id_company");

   		  $sql->bindValue(':id', $id);
          $sql->bindValue(':id_company', $id_company);
          $sql->execute();

          $this->setLog($id, $id_company, $id_user, 'del');
}

public function searchServiceByName($name, $id_company) {
    $array = array();

   $sql = $this->db->prepare("SELECT name, price, id FROM inventory_service WHERE name LIKE :name AND id_company = :id_company LIMIT 15");
   $sql->bindValue(':name', '%'.$name.'%');
   $sql->bindValue(':id_company', $id_company);
   $sql->execute();

   if ($sql->rowCount() > 0) {
  $array = $sql->fetchAll();
}

  return $array;
  }

}