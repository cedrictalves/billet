<?php

	/////////////////////
	///  MAIN VIEW    ///
	/////////////////////
class MainView {

	/////////////////////////////////////////
	/// REPLACE {{ string }} BY TEMPLATE  ///
	/////////////////////////////////////////
	public function mergeWithTemplate($args, $gabarit){
		return str_replace( array_keys($args), $args, file_get_contents("template/$gabarit.html") ); 
	}

	/////////////////////////////////////////
	/// REPLACE {{ string }} BY TEMPLATE  ///
	/////////////////////////////////////////
	public function mergeWithTemplate2($args, $replace, $lenght){
		return substr_replace($args, $replace, $lenght); 
	}
}