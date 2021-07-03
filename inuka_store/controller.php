<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $pass = "admin";
	private $db = "toy_comp_db";
	private $con;
	
	function __construct() {
		$this->con = $this->connectDB();
		if(!$this->con) {
			die("Connection failed:" . mysqli_connect_error());
		}
	}
	
	function connectDB() {
		$con = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
		return $con;
	}
	
	function getQuery($q) {
		$res = mysqli_query($this->con,$q);
		while($row=mysqli_fetch_assoc($res)) {
			$res_set[] = $row;
		}		
		if(!empty($res_set))
			return $res_set;
	}

	function giveQuery($q) {
		mysqli_query($this->con, $q);
	}
	
	function numRows($q) {
		$res  = mysqli_query($this->con,$q);
		$rowcount = mysqli_num_rows($res);
		return $rowcount;	
	}
}
