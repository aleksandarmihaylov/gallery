<?php 

class Photo extends Db_object {

	protected static $db_table = "photos";
	protected static $db_table_fields = array('id', 'title','caption', 'description', 'filename', 'alternate_text', 'type', 'size');
	public $id;
	public $title;
	public $caption;
	public $description;
	public $filename;
	public $alternate_text;
	public $type;
	public $size;


	public $tmp_path;
	// we can call it whatever
	//(we call it images because this is a photo gallery and we will be storing images)
	public $upload_directory = "images";
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

// This is passing $_FILES ['uploaded_file'] as an argument

public function set_file($file) {
// error checking 
if(empty($file) || !$file || !is_array($file)) {
	$this->errors[] = "There was no file uploaded here";
	return false;
} elseif($file['error'] !=0) {
	$this->errors[] = $this->upload_errors_array[$file['error']];
	return false;
} else {

	$this->filename = basename($file['name']); //base name returs a string from a path example "/etc/sudoers.d" will be sudoers.d
	$this->tmp_path = $file['tmp_name'];	   // we can use it also basename("/etc/sudoers.d", ".d") this will return only sudoers!!
	$this->type = $file['type'];
	$this->size = $file['size'];

} // end of if/else statement


} // end of set_file method


public function picture_path() {

	return $this->upload_directory.DS.$this->filename;


}


public function save() {

	if($this->id){
	
		$this->update();
	
	} else {

		if(!empty($this->errors)){
			return false;
		}

		if(empty($this->filename) ||empty($this->tmp_path)){

			$this->errors[] = "The file was not available";
			return false;

		}


		$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename; 


		if(file_exists($target_path)) {
			$this->errors[] = "The file {$this->filename} already exists";
			return false;
		}

		if(move_uploaded_file($this->tmp_path, $target_path)) {
			
			if($this->create()){
				
				unset($this->tmp_path);
				return true;

			}
		
		} else {

			$this->errors[] = "The file directory does not have a permission";
			return false;

		} // end of if/else for move_upload_file statement


	} // end of the first if/else statement

} // end of save method 

public function delete_photo(){

	if($this->delete()) {

		$target_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();

		return unlink($target_path) ? true : false; //deletes the file

		
	}	else {

		return false;

	}
}




} //end of photo class



?>