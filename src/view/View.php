<?php
class View{
	
	private $title;
	private $content;
	private $built;
	private $routeur;
	private $menu;
	private $feedback;
	
	public function __construct($feedback){
		$this->title = "";
		$this->content = "";
		$this->router = new Router();
		$this->menu = Array('accueil' => $this->router->getShipAccueilURL(), 'Navires' => $this->router->getShipListURL(), 'Nouveau navire' => $this->router->getShipCreationURL(), 'A propos' => $this->router->getAProposURL());
		$this->feedback = $feedback;
	}
	
	function render(){
			require_once 'squelette.php';
	}
	
	function makeTestPage(){
			$this->title = "queen anne's revenge";
			$this->content= "<p>Il s'agissait de l'ex-frégate La Concorde de 300 tonneaux et 40 canons construit en 1710 dans le chantier naval de Rochefort et effectuant la traite négrière pour le compte de l'armateur nantais René Montaudouin1. Barbe-Noire s'en est emparé le 28 novembre 1717. Il l'a utilisé pour faire le blocus de Charleston en Caroline du Sud et il l'a perdu en mai 1718 lors d'un échouement, au large de Beaufort en Caroline du Nord.</p>";
	}
	
	function makeShipPage($ship, $id){
			$this->title = $ship->getName();
			$this->content= "<p>".$ship->getDescription()."</p> <p>mise à l'eau : " . $ship->getBuilt() . '</p> <a href="'. $this->router->getShipAskDeletionURL($id) . '">Supprimer le Navire</a> <br> <a href="'. $this->router->getShipModifyURL($id) . '">modifier le Navire</a>';
	}
	
	function makeAProposPage(){
			$this->title = "A Propos";
			$this->content= "<p>22005759</p><p>les point qui ont été réaliser :</p>";
			$this->content .="<ul><li>affichage de la liste d'objet</li>";
			$this->content .="<li>création d'un objet</li>";
			$this->content .="<li>modification et supression d'un objet</li>";
			$this->content .="<li>base de donnée en MySQL</li>";
			$this->content .="<li>filtrer la liste des objets via un champ de recherche</li>";
			$this->content .= "</ul>";
	}
	
	function makeUnknownShipPage(){
			$this->title = "erreur";
			$this->content= "<p>erreur, navire inconnue</p>";
	}
	
	public function makeHomePage() {
		$this->title = "Bienvenue !";
		$this->content = "<p>Un site sur des Navires.</p>";
	}
	
	public function makeListPage($tab){
		$this->title = "Bienvenue !";
		$this->content = '<form action="'. $this->router->getShipRechercheURL() .'" method="GET">' . '<label> recherche : <input type="text" name="recherche"/></label>' . '<button type="submit">Rechercher</button>' . '</form>';
		$this->content .= "<p>liste des navire :</p> <ul>";
		foreach($tab as $key => $ship){
			$link = $this->router->getShipURL($key);
			$name = $ship->getName();
			$this->content .= "<li><a href=\"$link\" > $name </a></li>";
		}
		$this->content .= "</ul>";
	}
	
	public function makeDebugPage($variable) {
		$this->title = 'Debug';
		$this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
	}
	
	function makeShipCreationPage(ShipBuilder $shipBuilder){
		$this->title = "Création de Page de Navire";
		if($shipBuilder->getError()==null){
			$this->content = '<form action="'. $this->router->getShipSaveURL() .'" method="POST">' . '<label> nom : <input type="text" name="nom"/></label>' . '<label> description : <textarea type="text" name="description"></textarea></label>' . '<label> lancement : <input type="text" pattern="\d*" name="built"/></label>' . '<button type="submit">Valider</button>' . '</form>';
		}
		else{
			$this->content = $shipBuilder->getError() . '<form action="'. $this->router->getShipSaveURL() . '" method="POST">' . '<label> nom : <input type="text" value="' . $shipBuilder->getName() . '" name="nom"/></label>' . '<label> description : <textarea type="text" value="" name="description">' . $shipBuilder->getDescription() . '</textarea></label>' . '<label> lancement : <input type="text" pattern="\d*" value="' . $shipBuilder->getBuilt() . '" name="built"/></label>' . '<button type="submit">Valider</button>' . '</form>';
		}
	}
	
	function makeShipDeletionPage($id){
		$this->title = "Supression de Page de Navire";
		$this->content = '<form action="'. $this->router->getShipDeletionURL($id) . '" method="POST"> <button type="submit">Valider la suppression</button> </form>';
	}

	function makeShipModificationPage(ShipBuilder $shipBuilder, $id){
		$this->title = "Création de Page de Navire";
		if($shipBuilder->getError()==null){
			$this->content = '<form action="'. $this->router->getShipSaveModificationURL($id). '" method="POST">' . '<label> nom : <input type="text" value="' . $shipBuilder->getName() . '" name="nom"/></label>' . '<label> description : <textarea type="text" value="" name="description">' . $shipBuilder->getDescription() . '</textarea></label>' . '<label> lancement : <input type="text" pattern="\d*" value="' . $shipBuilder->getBuilt() . '" name="built"/></label>' . '<button type="submit">Valider modification</button>' . '</form>';
		}
		else{
			$this->content = $shipBuilder->getError() . '<form action="'. $this->router->getShipSaveModificationURL($id) . '" method="POST">' . '<label> nom : <input type="text" value="' . $shipBuilder->getName() . '" name="nom"/></label>' . '<label> description : <textarea type="text" value="" name="description">' . $shipBuilder->getDescription() . '</textarea></label>' . '<label> lancement : <input type="text" pattern="\d*" value="' . $shipBuilder->getBuilt() . '" name="built"/></label>' . '<button type="submit">Valider modification</button>' . '</form>';
		}
	}
	
	public function makeSearchPage($tab){
		$this->title = "Bienvenue !";
		$this->content = '<form action="'. $this->router->getShipRechercheURL() .'" method="GET">' . '<label> recherche : <input type="text" value="'. htmlspecialchars($_GET["recherche"]) .'" name="recherche"/></label>' . '<button type="submit">Rechercher</button>' . '</form>';
		$this->content .= "<p>liste des navire suivant la recherche :</p>";
		if(count($tab)> 0){
			$this->content .= "<ul>";
			foreach($tab as $key => $ship){
				$link = $this->router->getShipURL($key);
				$name = $ship->getName();
				$this->content .= "<li><a href=\"$link\" > $name </a></li>";
			}
		}
		else{
			$this->content .= "Aucun navire ne correspond a votre recherche.";
		}
		$this->content .= "</ul>";
	}
	
	function displayShipCreationSuccess($id){
		$this->router->POSTredirect($this->router->getShipURL($id), "Votre navire a bien été ajouter.");
	}

	function displayShipCreationFailure(){
		$this->router->POSTredirect($this->router->getShipCreationURL(), "Votre navire n'a pas put être ajouter.");
	}
	
	function displayShipDeletionSuccess(){
		$this->router->POSTredirect($this->router->getShipListURL(), "Votre navire a bien été supprimer.");
	}

	function displayShipDeletionFailure(){
		$this->router->POSTredirect($this->router->getShipListURL(), "Votre navire n'a pas put être supprimer.");
	}

	function displayShipModificationSuccess($id){
		$this->router->POSTredirect($this->router->getShipURL($id), "Votre navire a bien été modifier.");
	}

	function displayShipModificationFailure($id){
		$this->router->POSTredirect($this->router->getShipURL($id), "Votre navire n'a pas put être modifier.");
	}
}

?>
