<?php
class Ship{
	
	private $name;
	private $description;
	private $built;
	
	public function __construct($name, $description, $built){
		$this->name = $name;
		$this->description = $description;
		$this->built = $built;
	}
	
	function getName(){
			return $this->name;
	}
	
	function getDescription(){
			return $this->description;
	}
	
	function getBuilt(){
			return $this->built;
	}
	
}

?>
