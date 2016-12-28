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

            $sql = $this->db->prepare("SELECT name FROM permission_params WHERE id IN (:id) AND id_company = :id_company ");
            $sql->bindValue(':id', $row['params']);
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

public function hasPermission($name) {
	 if (in_array($name, $this->permissions)) {
	 	return true;
	 }else {
	 	return false;
	 }
}

}