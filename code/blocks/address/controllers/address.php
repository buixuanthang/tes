<?php
/*
 * Huy write
 */
include 'blocks/address/models/address.php';

class AddressBControllersAddress {
	function __construct() {
	}
	function display($parameters, $title) {
		$model = new AddressBModelsAddress();
		$list = $model -> get_list();
		if(!$list)
			return;
		$style = $parameters->getParams ( 'style' );
		if($style ==  'regions'){
			$regions = $model -> get_regions();
		}
		include 'blocks/address/views/address/' . $style . '.php';
	}
}
?>