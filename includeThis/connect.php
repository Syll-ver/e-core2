<!-- <?php
/* Database config */
// $db_host		= 'localhost';
// $db_user		= 'postgres';
// $db_pass		= 'postgres';
// $db_database	= 'coursereservation'; 

// /* End config */

// $db = new PDO('pgsql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?> -->

<?php

Class Connection{
 
	private $server = "pgsql:host=localhost;dbname=coursereservation";
	private $username = "postgres";
	private $password = "postgres";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is some problem in connection: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}
 
?>