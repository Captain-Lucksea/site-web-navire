<?php
class ShipStorageFile implements ShipStorage{
	
	private $shipTab;
	private $db;
	
	public function __construct($file){
		$this->db = new ObjectFileDB($file);
		$this->shipTab = array(
			'Charles-de-gaulle' => new Ship("Charles de Gaulle", "bla bla porte avion", 1994),
			'yamato' => new Ship("Yamato", "bla bla cuirassé japponnais", 1940),
			'bismarck' => new Ship("Bismarck", "bla bla cuirassé Allemand", 1939),
			'HMS-Victory' => new Ship("HMS Victory", "bla bla man'o'war anglais", 1765),
		);
	}
	
	function read($id){
		if (!$this->db->exists($id)){
			return null;
		}
		return $this->db->fetch($id);
	}
	
	function readAll(){
		return $this->db->fetchAll();
	}
	
	function reinit(){
		$this->db->deleteAll();
		foreach($this->shipTab as $key => $ship){
			$this->db->insert($ship);
		}
	}
	
	function create(Ship $s){
		return $this->db->insert($s);
	}
	
	function delete($id){
		$this->db->delete($id);
	}
	
	function modify(Ship $s, $id){
		$this->db->update($id,$s);
	}
	
}

?>
