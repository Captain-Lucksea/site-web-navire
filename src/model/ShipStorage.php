<?php
interface ShipStorage{
	
	function read($id);
	
	function readAll();
	
	function create(Ship $s);
	
	function delete($id);
	
	function modify(Ship $s, $id);
}

?>
