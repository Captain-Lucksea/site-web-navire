<?php
class ShipStorageStub implements ShipStorage{
	
	private $shipTab;
	
	public function __construct(){
		$this->shipTab = array(
			'Charles-de-gaulle' => new Ship("Charles de Gaulle", "bla bla porte avion", 1994),
			'yamato' => new Ship("Yamato", "bla bla cuirassé japponnais", 1940),
			'bismarck' => new Ship("Bismarck", "bla bla cuirassé Allemand", 1939),
			'HMS-Victory' => new Ship("HMS Victory", "bla bla man'o'war anglais", 1765),
		);
	}
	
	function read($id){
		if(array_key_exists($id, $this->shipTab)){
			return $this->shipTab[$id];
		}
		else{
			return null;
		}
	}
	
	function readAll(){
		return $this->shipTab;
	}
	
	function create(Ship $s){
		$this->shipTab[$s->getName()]=$s;
	}
	
	function delete($id){
		unset($this->shipTab[$id]);
	}
	
	function modify(Ship $s, $id){
		return false;
	}
	
}

?>
