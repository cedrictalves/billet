<?php
////////////////////
///  MAIN MODEL  ///
////////////////////
class MainModel{

	protected $db;
	
    ////////////////////
    ///  CONNECT DB  ///
    ////////////////////
	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=billet;charset=utf8','root','');
    	$this->db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$this->db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}

	protected function pInsertFunc($action, $table, $values, $sqlfunctions){


    $value_columns = array_keys($values);
    $sqlfunc_columns = array_keys($sqlfunctions);
    $columns = array_merge($value_columns, $sqlfunc_columns);

    // Only $values become ':paramname' PDO parameters.
    $value_parameters = array_map(function($col) {return (':' . $col);}, $value_columns);
    // SQL functions go straight in as strings.
    $sqlfunc_parameters = array_values($sqlfunctions);
    $parameters = array_merge($value_parameters, $sqlfunc_parameters);

    $column_list = join(', ', $columns);
    $parameter_list = join(', ', $parameters);

    $query = "$action $table ($column_list) VALUES ($parameter_list)";

    $stmt = $this->db->prepare($query);
    $stmt->execute($values);

	}
}
