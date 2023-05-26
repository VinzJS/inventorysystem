<?php
class category{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='finalproject';
	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function new_category($supply_category){

		$data = [
			[$supply_category],
		];
		$stmt = $this->conn->prepare("INSERT INTO categories (supply_category) VALUES (?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
	
		return true;
	}

	public function delete_user($user_id) {
		$sql = "DELETE FROM tbl_users WHERE user_id = :user_id";
		$q = $this->conn->prepare($sql);
		$q->execute(array(':user_id' => $user_id));
		return true;
	}

	public function list_category()
{
    $sql = "SELECT * FROM categories";
    $q = $this->conn->query($sql) or die("Query execution failed!");

    $data = array(); // Initialize the $data array

    while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $r;
    }

    if (empty($data)) {
        return false;
    } else {
        return $data;
    }
}

function get_category_id($supply_category){
	$sql="SELECT category_id FROM categories WHERE supply_category = :supply";    
	$q = $this->conn->prepare($sql);
	$q->execute(['supply' => $supply_category]);
	$category_id = $q->fetchColumn();
	return $category_id ? $category_id : null; // return null if user_id is not found
}


	function get_category($id){
		$sql="SELECT supply_category FROM categories WHERE category_id = :id";    
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$supply_category = $q->fetchColumn();
		return $supply_category ? $supply_category : null; // return null if user_id is not found
	}

	
}
	  

	
	

