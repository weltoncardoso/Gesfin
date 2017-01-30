<?php
class Sales extends model {
 public function getList($offset, $id_company) {
  $array = array();
   $sql = $this->db->prepare("
   	SELECT
   		sales.id,
	   	sales.date_sale,
	   	sales.total_price,
	   	sales.status,
	   	clients.name
   	FROM sales
   	LEFT JOIN clients ON clients.id = sales.id_client
   	WHERE
   		sales.id_company = :id_company
   	ORDER BY sales.date_sale DESC
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
		( select clients.name from clients where clients.id = sales.id_client ) AS client_name
		FROM sales
		WHERE id = :id AND id_company = :id_company");
		   $sql->bindValue(':id', $id);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute();

		   if ($sql->rowCount() > 0) {
	           $array['info'] = $sql->fetch();
              }
              
         $sql = $this->db->prepare("
         	SELECT
	         	sales_products.quant,
	         	sales_products.sale_price,
	         	inventory.name
         	FROM sales_products
         	LEFT JOIN inventory
         	ON inventory.id = sales_products.id_product
         	WHERE
         		sales_products.id_sale = :id_sale AND
         		sales_products.id_company = :id_company");

		   $sql->bindValue(':id_sale', $id);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute(); 

		   if ($sql->rowCount() > 0) {
	           $array['products'] = $sql->fetchAll();
              }    

	return $array;
}

public function addSale($id_company, $id_client, $id_user, $quant, $status) {
	 $i = new Inventory();

   $sql = $this->db->prepare("INSERT INTO sales SET id_company = :id_company, id_client = :id_client, id_user = :id_user, date_sale = NOW(), total_price = :total_price, status = :status");
   $sql->bindValue(':id_company', $id_company);
   $sql->bindValue(':id_client', $id_client);
   $sql->bindValue(':id_user', $id_user);
   $sql->bindValue(':total_price', '0');
   $sql->bindValue(':status', $status);
   $sql->execute();

   $id_sale = $this->db->lastInsertId();

   	$total_price = 0;
	foreach ($quant as $id_prod => $quant_prod) {
		 $sql = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND id_company = :id_company");
		   $sql->bindValue(':id', $id_prod);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute();

	if ($sql->rowCount() > 0) {
	$row = $sql->fetch();
	$price = $row['price'];

		 $sqlp = $this->db->prepare("INSERT INTO sales_products SET id_company = :id_company, id_sale = :id_sale, id_product = :id_product, quant = :quant, sale_price = :sale_price");
	       $sqlp->bindValue(':id_company', $id_company);
		   $sqlp->bindValue(':id_sale', $id_sale);
		   $sqlp->bindValue(':id_product', $id_prod);
		   $sqlp->bindValue(':quant', $quant_prod);
		   $sqlp->bindValue(':sale_price', $price);
		   $sqlp->execute();

		 if ($status == '2') {
		   	$i->decreaseInventory($id_prod, $id_company, $quant_prod, $id_user);
		   }   


	$total_price += $price * $quant_prod;
		}
	  }

	   $sql = $this->db->prepare("UPDATE sales SET total_price = :total_price WHERE id = :id");
	       $sql->bindValue(':total_price', $total_price);
		   $sql->bindValue(':id', $id_sale);
		   $sql->execute();
   }

    public function changeStatus($status, $id, $id_company) {
   		$sql = $this->db->prepare("UPDATE sales SET status = :status WHERE id = :id AND id_company =:id_company");
	       $sql->bindValue(':status', $status);
		   $sql->bindValue(':id', $id);
		   $sql->bindValue(':id_company', $id_company);
		   $sql->execute(); 

   }

   public function getSalesFiltered($client_name, $period1, $period2, $status, $order, $id_company) {
   	$array = array();
   	$sql = "SELECT
	   	clients.name,
	   	sales.date_sale,
	   	sales.status,
	   	sales.total_price
   	FROM sales
   	LEFT JOIN clients ON clients.id = sales.id_client
   	WHERE ";

   	$where = array();
   	$where[] = "sales.id_company = :id_company";

   	 if (!empty($client_name)) {
   	 	$where[] = "clients.name LIKE '%".$client_name."%'";
   	 }

   	 if (!empty($period1) && !empty($period2)) {
   	 	$where[] = "sales.date_sale BETWEEN :period1 AND :period2";
   	 }
   	 if ($status != '') {
   	 	$where[] = "sales.status = :status";
   	 }

   	 $sql .= implode(' AND ', $where);

   	 switch ($order) {
   	 	case 'date_desc':
   	 	default:
   	 		$sql .= " ORDER BY sales.date_sale DESC";
   	 		break;
   	 	case 'date_asc':
   	 		$sql .= " ORDER BY sales.date_sale ASC";
   	 		break;
   	 	case 'status':
   	 		$sql .= " ORDER BY sales.status";
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
}