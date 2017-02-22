<?php
class Services extends model {
 public function getList($offset, $id_company) {
  $array = array();
   $sql = $this->db->prepare("
   	SELECT
   		services.id,
	   	services.date_sale,
	   	services.total_price,
	   	services.status,
      services.nfe_key,
	   	clients.name
   	FROM services
   	LEFT JOIN clients ON clients.id = services.id_client
   	WHERE
   		services.id_company = :id_company
   	ORDER BY services.date_sale DESC
   	LIMIT $offset, 10");
   $sql->bindValue(':id_company', $id_company);
   $sql->execute();
if ($sql->rowCount() > 0) {
	$array = $sql->fetchAll();
}

return $array;
}

public function getInfo($id, $id_company) {
	$array = array();

	$sql = $this->db->prepare("
		SELECT
		*,
		( select clients.name from clients where clients.id = services.id_client ) AS client_name
		FROM services
		WHERE id = :id AND id_company = :id_company");
		   $sql->bindValue(':id', $id);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute();

		   if ($sql->rowCount() > 0) {
	           $array['info'] = $sql->fetch();
              }
              
         $sql = $this->db->prepare("
         	SELECT
	         	services_products.quant,
	         	services_products.sale_price,
	         	inventory_service.name
         	FROM services_products
         	LEFT JOIN inventory_service
         	ON inventory_service.id = services_products.id_product
         	WHERE
         		services_products.id_sale = :id_sale AND
         		services_products.id_company = :id_company");

		   $sql->bindValue(':id_sale', $id);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute(); 

		   if ($sql->rowCount() > 0) {
	           $array['products'] = $sql->fetchAll();
              }    

	return $array;
}

public function addSale($id_company, $id_client, $id_user, $quant, $status) {
	 $i = new InventoryService();

   $sql = $this->db->prepare("INSERT INTO services SET id_company = :id_company, id_client = :id_client, id_user = :id_user, date_sale = NOW(), total_price = :total_price, status = :status");
   $sql->bindValue(':id_company', $id_company);
   $sql->bindValue(':id_client', $id_client);
   $sql->bindValue(':id_user', $id_user);
   $sql->bindValue(':total_price', '0');
   $sql->bindValue(':status', $status);
   $sql->execute();

   $id_sale = $this->db->lastInsertId();

   	$total_price = 0;
	foreach ($quant as $id_prod => $quant_prod) {
		 $sql = $this->db->prepare("SELECT price FROM inventory_service WHERE id = :id AND id_company = :id_company");
		   $sql->bindValue(':id', $id_prod);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute();

	if ($sql->rowCount() > 0) {
	$row = $sql->fetch();
	$price = $row['price'];

		 $sqlp = $this->db->prepare("INSERT INTO services_products SET id_company = :id_company, id_sale = :id_sale, id_product = :id_product, quant = :quant, sale_price = :sale_price");
	       $sqlp->bindValue(':id_company', $id_company);
		   $sqlp->bindValue(':id_sale', $id_sale);
		   $sqlp->bindValue(':id_product', $id_prod);
		   $sqlp->bindValue(':quant', $quant_prod);
		   $sqlp->bindValue(':sale_price', $price);
		   $sqlp->execute();   


	$total_price += $price * $quant_prod;
		}
	  }

	   $sql = $this->db->prepare("UPDATE services SET total_price = :total_price WHERE id = :id");
	       $sql->bindValue(':total_price', $total_price);
		   $sql->bindValue(':id', $id_sale);
		   $sql->execute();
   }

    public function changeStatus($status, $id, $id_company) {
   		$sql = $this->db->prepare("UPDATE services SET status = :status WHERE id = :id AND id_company =:id_company");
	       $sql->bindValue(':status', $status);
		   $sql->bindValue(':id', $id);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute(); 

   }

   public function getSalesFiltered($client_name, $period1, $period2, $status, $order, $id_company) {
   	$array = array();
   	$sql = "SELECT
	   	clients.name,
	   	services.date_sale,
	   	services.status,
	   	services.total_price
   	FROM services
   	LEFT JOIN clients ON clients.id = services.id_client
   	WHERE ";

   	$where = array();
   	$where[] = "services.id_company = :id_company";

   	 if (!empty($client_name)) {
   	 	$where[] = "clients.name LIKE '%".$client_name."%'";
   	 }

   	 if (!empty($period1) && !empty($period2)) {
   	 	$where[] = "services.date_sale BETWEEN :period1 AND :period2";
   	 }
   	 if ($status != '') {
   	 	$where[] = "services.status = :status";
   	 }

   	 $sql .= implode(' AND ', $where);

   	 switch ($order) {
   	 	case 'date_desc':
   	 	default:
   	 		$sql .= " ORDER BY services.date_sale DESC";
   	 		break;
   	 	case 'date_asc':
   	 		$sql .= " ORDER BY services.date_sale ASC";
   	 		break;
   	 	case 'status':
   	 		$sql .= " ORDER BY services.status";
   	 		break;
   	 }
   	 $sql = $this->db->prepare($sql);
   	 $sql->bindValue(':id_company', $id_company);

   	 if (!empty($period1) && !empty($period2)) {
   	 	$sql->bindValue(':period1', $period1);
   	 	$sql->bindValue(':period2', $period2);
   	 }
   	 if ($status != '') {
   	 	$sql->bindValue(':status', $status);
   	 }
   	 $sql->execute();

   	  if ($sql->rowCount() > 0) {
	           $array = $sql->fetchAll();
              } 

    return $array;
   }
   public function getTotalRevenue($period1, $period2, $id_company) {
      $float = 0;

      $sql = "SELECT SUM(total_price) AS total FROM services WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2";
      $sql = $this->db->prepare($sql);
         $sql->bindValue(':id_company', $id_company);
         $sql->bindValue(':period1', $period1);
         $sql->bindValue(':period2', $period2);
         $sql->execute();

              $n = $sql->fetch();
              $float = $n['total'];
              
      return $float;
   }

         public function getSoldServices($period1, $period2, $id_company) {
      $int = 0;

       $sql = "SELECT id FROM services WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2";
      $sql = $this->db->prepare($sql);
         $sql->bindValue(':id_company', $id_company);
         $sql->bindValue(':period1', $period1);
         $sql->bindValue(':period2', $period2);
         $sql->execute();
           if ($sql->rowCount() > 0) {
              $p = array();
              foreach ($sql->fetchAll() as $sale_item) {
                 $p[]=$sale_item['id'];
              }

         $sql = $this->db->query("SELECT COUNT(*) AS total FROM services_products WHERE id_sale IN (".implode(',', $p).")");
         $n = $sql->fetch();
              $int = $n['total'];
         } 
              
      return $int;
   }
public function getRevenueList($period1, $period2, $id_company) {
     $array = array();
     $currentDay = $period1;
     while ($period2 != $currentDay) {
        $array[$currentDay] = 0;
        $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));

     }

      $sql = "SELECT DATE_FORMAT(date_sale,'%Y-%m-%d') AS date_sale, SUM(total_price) AS total FROM services WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_sale,'%Y-%m-%d')";
      $sql = $this->db->prepare($sql);
         $sql->bindValue(':id_company', $id_company);
         $sql->bindValue(':period1', $period1);
         $sql->bindValue(':period2', $period2);
         $sql->execute();

               if($sql->rowCount() > 0) {
              $rows = $sql->fetchAll();

              foreach ($rows as $sale_item) {
                 $array[$sale_item['date_sale']] = $sale_item['total'];
              }
           }
              
      return $array;
 }
public function getStatusList($period1, $period2, $id_company) {
     $array = array('0'=>0,'1'=>0,'2'=>0,'3'=>0);

      $sql = "SELECT COUNT(id) AS total, status FROM services WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY status ORDER BY status ASC";
      $sql = $this->db->prepare($sql);
         $sql->bindValue(':id_company', $id_company);
         $sql->bindValue(':period1', $period1);
         $sql->bindValue(':period2', $period2);
         $sql->execute();

               if($sql->rowCount() > 0) {
              $rows = $sql->fetchAll();

              foreach ($rows as $status_item) {
                 $array[$status_item['status']] = $status_item['total'];
              }
           }
              
      return $array;
 }
 public function getAllInfo($id_sale, $id_company) {
    $array = array();

    $sql = "SELECT * FROM services WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id_sale);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $array['info'] = $sql->fetch();
    }

    $sql = "SELECT id_product, quant, sale_price FROM services_products WHERE id_sale = :id_sale";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id_sale", $id_sale);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $array['products'] = $sql->fetchAll();

      $i = new Inventory();

      foreach($array['products'] as $pkey => $pval) {

        $array['products'][$pkey]['c'] = $i->getInfo($pval['id_product'], $id_company);

      }
    }

    return $array;
  }

  public function setNFEKey($chave, $id_sale) {

    $sql = $this->db->prepare("UPDATE services SET nfe_key = :nfe_key WHERE id = :id");
    $sql->bindValue(":nfe_key", $chave);
    $sql->bindValue(":id", $id_sale);
    $sql->execute();

  }
}








