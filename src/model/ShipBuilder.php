<?php
class ShipBuilder{
	
	private $data;
	private $erreur;
	private $NAME_REF;
	private $DESCRIPTION_REF;
	private $BUILT_REF;
	
	public function __construct($data){
		$this->data = $data;
		$this->erreur = null;
		$this->NAME_REF = $data["nom"];
		$this->DESCRIPTION_REF = $data["description"];
		$this->BUILT_REF = $data["built"];
	}
	
	function getData(){
			return $this->data;
	}
	
	function getError(){
			return $this->erreur;
	}
	
	function getName(){
			return $this->NAME_REF;
	}
	
	function getDescription(){
			return $this->DESCRIPTION_REF;
	}
	
	function getBuilt(){
			return $this->BUILT_REF;
	}
	
	function isValid(){
			if($this->data["nom"]==""){
				$this->erreur = $this->erreur . "le navire doit avoir un nom. \n";
			}
			if($this->data["description"]==""){
				$this->erreur = $this->erreur . "le navire doit avoir une description. \n";
			}
			if($this->data["built"]<0 or $this->data["built"]==""){
				$this->erreur = $this->erreur . "le navire doit avoir pour date de lancement un nombre positif. \n";
			}
			if($this->data["nom"]!="" and $this->data["description"]!="" and $this->data["built"]>=0 and $this->data["built"]!=""){
				return true;
			}
			return false;
	}
	
	function createShip(){
			return new Ship(htmlspecialchars($this->NAME_REF), htmlspecialchars($this->DESCRIPTION_REF), $this->BUILT_REF);

	}

	function modifyShip(){
		return new Ship(htmlspecialchars($this->NAME_REF), htmlspecialchars($this->DESCRIPTION_REF), $this->BUILT_REF);

}
	
}

?>
