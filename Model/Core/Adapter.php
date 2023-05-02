<?php

/**
 * 
 */
class Model_Core_Adapter 
{
	
public $servername = "localhost";
public $username = "root";
public $password = "";
public $database = "project-anjali-vaghasiya-04-average";

public function connect()
{
	
$conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
	return $conn;
// Check connection
}
public function fetchAll($query)
{
	$connect = $this->connect();
	$result = $connect->query($query);
	if (!$result) {
			return false;
	}
	return $result->fetch_all(MYSQLI_ASSOC);


}

public function fetchRow($query)
{
	$connect = $this->connect();
	$result = $connect->query($query);
	if (!$result) {
			return false;
	}
	return $result->fetch_assoc();
}

public function insert($query)
{
	$connect = $this->connect();
	$result = $connect->query($query);

	if (!$result) {
		return false;
	}
	return $connect->insert_id;
}

public function update($query)
{
	$connect = $this->connect();
	$result = $connect->query($query);
	if (!$result) {
			return false;
	}
	return $result;
}

public function delete($query)
{
	$connect = $this->connect();
	$result = $connect->query($query);

	if (!$result) {
		return false;
	}
	return $result;
}
}


// $con = new Model_Core_Adapter();
// $con->fetchAll();
// print_r($con);