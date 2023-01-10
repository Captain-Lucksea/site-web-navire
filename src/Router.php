<?php

class Router{
	
	function getShipAccueilURL(){
		return "navire.php";
	}
	
	function getShipListURL(){
		return "navire.php?liste";
	}
	
	function getShipURL($id){
		return "navire.php?id=" . $id;
	}
	
	function getShipCreationURL(){
		return "navire.php?action=nouveau";
	}
	
	function getShipSaveURL(){
		return "navire.php?action=sauverNouveau";
	}
	
	function getShipAskDeletionURL($id){
		$_SESSION['shipToDelete'] = $id;
		return "navire.php?action=askDeletion";
	}
	
	function getShipDeletionURL($id){
		$_SESSION['shipToDelete'] = $id;
		return "navire.php?action=deletion";
	}

	function getShipModifyURL($id){
		$_SESSION['shipToModify'] = $id;
		return "navire.php?action=modifier";
	}

	function getShipSaveModificationURL($id){
		$_SESSION['shipToModify'] = $id;
		return "navire.php?action=sauverModification";
	}
	
	function getAProposURL(){
		return "navire.php?aPropos";
	}
	
	function getShipRechercheURL(){
		$r = key_exists('recherche', $_GET) ? $_GET['recherche'] : "";
		return "navire.php?recherche=" . $r;
	}
	
	function POSTredirect($url, $feedback){
		header("Location: " . $url, true, 303);
		$_SESSION['feedback'] = $feedback;
	}
	
	function main($storage){
			session_start();
			$feedback = key_exists('feedback', $_SESSION) ? $_SESSION['feedback'] : null;
			unset($_SESSION['feedback']);
			$view = new View($feedback);
			$controller = new Controller($view, $storage);
			if (array_key_exists("id", $_GET)){
				$controller->showInformation($_GET["id"]);
			}
			elseif (array_key_exists("liste", $_GET)){
				$controller->showList();
			}
			
			elseif (array_key_exists("recherche", $_GET)){
				$controller->searchShip($_GET["recherche"]);
			}
			
			elseif(array_key_exists("action", $_GET)){
				if($_GET["action"]=="nouveau"){
					$shipBuilder = $controller->newship();
					$view->makeShipCreationPage($shipBuilder);
				}
				if($_GET["action"]=="sauverNouveau"){
					$controller->saveNewShip($_POST);
				}
				if($_GET["action"]=="askDeletion"){
					$controller->askShipDeletion($_SESSION['shipToDelete']);
				}
				if($_GET["action"]=="deletion"){
					$controller->deleteShip($_SESSION['shipToDelete']);
				}
				if($_GET["action"]=="modifier"){
					$shipBuilder = $controller->modifyShip($_SESSION['shipToModify']);
					$view->makeShipModificationPage($shipBuilder, $_SESSION['shipToModify']);
				}
				if($_GET["action"]=="sauverModification"){
					$controller->saveModificationShip($_POST);
				}
			}
			elseif (array_key_exists("aPropos", $_GET)){
				$controller->showAPropos();
			}
			else{
				$controller->showHomePage();
			}
			$view->render();
	}
}

?>
