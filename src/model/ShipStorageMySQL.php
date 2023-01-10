<?php
class ShipStorageMySQL implements ShipStorage{
	
	private $PDO;
	
	public function __construct($pdo){
		$this->PDO = $pdo;
		$this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	function read($id){
		$stmt = $this->PDO->query("SELECT id, name, description, built FROM ship");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		while (($ligne = $stmt->fetch()) !== false) {
		  if($ligne->id == $id){
			return new ship($ligne->name, $ligne->description, $ligne->built);
		  }
		}
		return null;
	}
	
	function readAll(){
		$stmt = $this->PDO->query("SELECT id, name, description, built FROM ship");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$tab = array();
		while (($ligne = $stmt->fetch()) !== false) {
		  $tab[$ligne->id] = new ship($ligne->name, $ligne->description, $ligne->built);
		}
		return $tab;
	}
	
	function create(Ship $s){
		$id = $this->PDO->query('SELECT id, name, description, built FROM ship')->rowCount()+1;
		$requete = 'INSERT INTO ship VALUES ('.$id.', "'.$s->getName().'", "'.$s->getDescription().'", '.$s->getBuilt().');';
		$stmt = $this->PDO->query($requete);
		return $id;
	}
	
	function delete($id){
		$requete = 'DELETE FROM ship WHERE id='.$id.';';
		$stmt = $this->PDO->query($requete);
	}
	
	function modify(Ship $s, $id){
		$requete = 'UPDATE ship set name="'.$s->getName().'",description="'.$s->getDescription().'",built="'.$s->getBuilt().'" WHERE id='.$id.';';
		$stmt = $this->PDO->query($requete);
	}
	
}

?>
