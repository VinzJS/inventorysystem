<?php
class inventory{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='finalproject';
	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function new_inventory($stock_code,$stock_name,$stock_exp,$stock_category,$stock_count){

		$data = [
			[$stock_code,$stock_name,$stock_exp,$stock_category,$stock_count],
		];
		$stmt = $this->conn->prepare("INSERT INTO stock_inventory (stock_code, stock_name, stock_exp, stock_category, stock_count) VALUES (?,?,?,?,?)");
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

	
	public function list_inventory(){
			 $sql="SELECT * FROM stock_inventory";
			 $q = $this->conn->query($sql) or die("failed!");
			 while($r = $q->fetch(PDO::FETCH_ASSOC)){
			 $data[]=$r;
			 }
			 if(empty($data)){
				return false;
			 }else{
			 	return $data;	
			 }
	}
	function get_stock_id($stock_code) {
		$sql = "SELECT ID FROM stock_inventory WHERE stock_code = :code";
		$q = $this->conn->prepare($sql);
		$q->execute(['code' => $stock_code]);
		$stock_id = $q->fetchColumn();
		return $stock_id ? $stock_id : null;
	}
	
	function get_code($id) {
		$sql = "SELECT stock_code FROM stock_inventory WHERE ID = :id";
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$stock_code = $q->fetchColumn();
		return $stock_code ? $stock_code : null;
	}
	
	function get_name($stock_code) {
		$sql = "SELECT stock_name FROM stock_inventory WHERE stock_code = :code";    
		$q = $this->conn->prepare($sql);
		$q->execute(['code' => $stock_code]);
		$stock_name = $q->fetchColumn();
		return $stock_name ? $stock_name : null;
	}
	function get_exp_date($stock_code){
		$sql="SELECT stock_exp FROM stock_inventory WHERE stock_code = :code";	
		$q = $this->conn->prepare($sql);
		$q->execute(['code' => $stock_code]);
		$stock_exp = $q->fetchColumn();
		return $stock_exp;
	}
	function get_category($id){
		$sql="SELECT stock_category FROM stock_inventory WHERE ID = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$stock_category = $q->fetchColumn();
		return $stock_category;
	}

	function get_count($stock_code){
		$sql="SELECT stock_count FROM stock_inventory WHERE stock_code = :code";	
		$q = $this->conn->prepare($sql);
		$q->execute(['code' => $stock_code]);
		$stock_count = $q->fetchColumn();
		return $stock_count;
	}

}
	  

	
	

