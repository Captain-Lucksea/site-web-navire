<?php

class Controller{
	
	private $view;
	private $shipStorage;
	
	public function __construct($view, $shipStorage){
		$this->view = $view;
		$this->shipStorage = $shipStorage;
	}
	
	public function showInformation($id) {
		if($this->shipStorage->read($id)!=null){
			$this->view->makeShipPage($this->shipStorage->read($id), $id);
		}
		else{
			$this->view->makeUnknownShipPage();
		}
	}
	public function showHomePage(){
		$this->view->makeHomePage();
	}
	
	public function showList(){
		$this->view->makeListPage($this->shipStorage->readAll());
	}
	
	public function showAPropos(){
		$this->view->makeAProposPage();
	}
	
	public function saveNewShip(array $data){
		$shipBuilder = new ShipBuilder($data);
		if($shipBuilder->isValid()){
			$ship = $shipBuilder->createShip();
			$id = $this->shipStorage->create($ship);
			$_SESSION['currentNewShip'] = null;
			$this->view->displayShipCreationSuccess($id);
		}
		else{
			$_SESSION['currentNewShip'] = $shipBuilder;
			$this->view->displayShipCreationFailure();
		}
	}

	public function newShip(){
		if(key_exists('currentNewShip', $_SESSION) and $_SESSION['currentNewShip']!=null){
			$return = $_SESSION['currentNewShip'];
		}
		else{
			$return = new ShipBuilder(array('nom' => "", 'description' => "", 'built' => ""));
		}
		return $return;
	}
	
	public function askShipDeletion($id){
		if($this->shipStorage->read($id)!=null){
			$this->view->makeShipDeletionPage($id);
		}
		else{
			$this->view->displayShipDeletionFailure();
		}
	}
	
	public function deleteShip($id){
			$this->shipStorage->delete($id);
			$_SESSION['shipToDelete'] = null;
			$this->view->displayShipDeletionSuccess();
	}

	public function modifyShip($id){
		$ship = $this->shipStorage->read($id);
		return new ShipBuilder(array('nom' => $ship->getName(), 'description' => $ship->getDescription(), 'built' => $ship->getBuilt()));
	}

	public function saveModificationShip(array $data){
		$shipBuilder = new ShipBuilder($data);
		if($shipBuilder->isValid()){
			$id = $_SESSION['shipToModify'];
			$ship = $shipBuilder->createShip();
			$this->shipStorage->modify($ship, $id);
			$_SESSION['shipToModify'] = null;
			$this->view->displayShipModificationSuccess($id);
		}
		else{
			$this->view->displayShipModificationFailure($id);
		}
	}
	
	public function searchShip($recherche){
		$allShip = $this->shipStorage->readAll();
		if($recherche == ''){
			$this->view->makeListPage($allShip);
		}
		else{
			$shipList = Array();
			
			foreach($allShip as $key => $ship){
				if(strpos(strtolower($ship->getName()),strtolower($recherche))!==false){
					$shipList[$key] = $ship;
				}
			}
			$this->view->makeSearchPage($shipList);
		}
	}
}

?>
