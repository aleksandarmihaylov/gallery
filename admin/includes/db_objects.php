<?php 

class Db_object {
public $errors = array();
public $upload_errors_array = array(
// this is an associative array 
// first are the keys which are the file errors
// and then are the valuse which we set whatever we like 
UPLOAD_ERR_OK			=> "There is no error!",
UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directory ",
UPLOAD_ERR_FORM_SIZE	=> "The uploaded file exceeds the MAX_FILE_SIZE directory",
UPLOAD_ERR_PARTIAL		=> "The uploaded file was only partially uploaded.",
UPLOAD_ERR_NO_FILE		=> "No file was uploaded.",
UPLOAD_ERR_NO_TMP_DIR	=> "Missing a temporary folder.",
UPLOAD_ERR_CANT_WRITE	=> "Failed to write file to the disk.",
UPLOAD_ERR_EXTENSION	=> "A PhP extension stopped the file upload"
);





public function set_file($file) {
// error checking 
	//var_dump($file);
	// to do case file NULL
if(empty($file) || !$file || !is_array($file)) {
	$this->errors[] = "There was no file uploaded here";
	return false;
} elseif($file['error'] !=0) {
	$this->errors[] = $this->upload_errors_array[$file['error']];
	return false;
} else {

	$this->user_image = basename($file['name']); //base name returs a string from a path example "/etc/sudoers.d" will be sudoers.d
	$this->tmp_path = $file['tmp_name'];	   // we can use it also basename("/etc/sudoers.d", ".d") this will return only sudoers!!
	$this->type = $file['type'];
	$this->size = $file['size'];

} // end of if/else statement


} // end of set_file method






protected static $db_table = "users";

public static function find_all() {

return static::find_by_query("SELECT * FROM ". static::$db_table ." ");

} //end of find_all method

public static function find_by_id($id) {
$the_result_array = static::find_by_query("SELECT * FROM ". static::$db_table ." WHERE id = $id LIMIT 1");


// ternary php (the same as the if/else statement bellow)
// return !empty($the_result_array) ? array_shift($the_result_array) : false;

if(!empty($the_result_array)) {

	$first_item = array_shift($the_result_array);
	return $first_item;

} else {


	return false;

}


} //end of find_by_id method





public static function find_by_query($sql){
global $database;
$result_set = $database -> query($sql);
$the_object_array = array();

while($row = mysqli_fetch_array($result_set)) {

$the_object_array[] = static::instantation($row);

}

return $the_object_array;


} //end of find_by_query method

public static function instantation($the_record) {

		$calling_class = get_called_class();

		 $the_object = new $calling_class;

		// $the_object -> id = $found_user['id'];
		// $the_object -> username = $found_user['username'];
		// $the_object -> password = $found_user['password'];
		// $the_object -> first_name = $found_user['first_name'];
		// $the_object -> last_name = $found_user['last_name'];

foreach ($the_record as $the_attribute => $value) {
	
	if($the_object -> has_the_attribute($the_attribute)) {

		$the_object ->$the_attribute = $value;
}

}

		return $the_object;
} //end of instantation method


private function has_the_attribute($the_attribute){

$object_properties = get_object_vars($this);

return array_key_exists($the_attribute, $object_properties);


} // end of has_the_attribute method




protected function properties() {

	// return get_object_vars($this);

	$properties = array();

	foreach (static::$db_table_fields as $db_field) {
		
		if(property_exists($this, $db_field)) {

			$properties[$db_field] = $this->$db_field;

		}

}
		return $properties;

} // end of properties method




protected function clean_properties(){

	global $database;

	$clean_properties = array();

	foreach ($this->properties() as $key => $value) {
		$clean_properties[$key] = $database->escape_string($value);
	}

	return $clean_properties;

} //end of clean_properties method 



//checking if the user is there and if it is there
//it will update it if not it will create new
// for creating we only need to add $user = new User;
 	
 	public function save(){

 		return isset($this->id) ? $this->update() : $this->create();

 	} // end of save method 




	public function create() {
	global $database;

	$properties = $this->clean_properties();
	// the old way of doing it down we make an abstraction
	//$sql = "INSERT INTO ". static::$db_table ." (username, password, first_name, last_name)";
	// $sql .= "VALUES ('";
	// $sql .= $database->escape_string($this->username) . "', '";
	// $sql .= $database->escape_string($this->password) . "', '";
	// $sql .= $database->escape_string($this->first_name) . "', '";
	// $sql .= $database->escape_string($this->last_name) . "')";
	$sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
	$sql .= "VALUES ('". implode("', '", array_values($properties)) ."')";


	if($database->query($sql)) {

		$this->id = $database->the_insert_id();

		return true;

	} else {

	return false;

	}

	} //end of create method 






public function update() {
	global $database;

	$properties = $this->clean_properties();

	$properties_pairs = array();

	foreach ($properties as $key => $value) {
		$properties_pairs[] = "{$key}='{$value}'";
	}


	$sql = "UPDATE ". static::$db_table ." SET ";
	$sql .= implode(", ", $properties_pairs);
	$sql .= " WHERE id= " . $database->escape_string($this->id);
		// THE SPACE before WHERE AND AFTER SET!!! MATTERS A LOT !!!!!
	$database->query($sql);

	return (mysqli_affected_rows($database->connection) == 1) ? true : false; //ternary way

} // end of update method 

public function delete() {
	global $database;
	
	$sql = "DELETE FROM ". static::$db_table ." ";
	$sql .= " WHERE id= " . $database->escape_string($this->id);
	$sql .= " LIMIT 1";
	// again carefull WITH the spaces !!! 
	$database->query($sql);
	
	return (mysqli_affected_rows($database->connection) == 1) ? true : false; //ternary way
}// end of delete method 



	public static function count_all() {
		global $database;

		$sql = "SELECT COUNT(*) FROM " . static::$db_table;
		$result_set = $database->query($sql);
		$row = mysqli_fetch_array($result_set);
		
		return array_shift($row);
		
	}





} // end of class






?>