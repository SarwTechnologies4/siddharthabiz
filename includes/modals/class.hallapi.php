<?php
class Hallapi extends DatabaseObject {

	protected static $table_name = "tbl_hall";
	protected static $db_fields = array('id', 'hotel_id', 'title', 'slug', 'hall_type', 'seat_a', 'seat_b', 'seat_c', 'seat_d', 'seat_e', 'seat_f', 'max_people', 'max_child', 'no_hall', 'hall_size', 
	'hall_size_label', 'smoking', 'image', 'banner_image', 'currency', 'feature', 'detail', 'content', 'sortorder', 'added_date', 'modified_date', 'status', 'halls_type');
	
	public $id;
	public $hotel_id;
	public $title;
	public $slug;
	public $hall_type;
	public $seat_a;
	public $seat_b;
	public $seat_c;
	public $seat_d;
	public $seat_e;
	public $seat_f;
	public $max_people;
	public $max_child;
	public $no_hall;
	public $hall_size;
	public $hall_size_label;
	public $smoking;
	public $image;
	public $banner_image;
	public $currency;
	public $feature;
	public $detail;
	public $content;
	public $sortorder;
	public $added_date;
	public $modified_date;
	public $status;	

	public $halls_type;

	//FIND THE HIGHEST MAX NUMBER.
	public static function find_maximum($field="sortorder"){
		global $db;
		$result = $db->query("SELECT MAX({$field}) AS maximum FROM ".self::$table_name);
		$return = $db->fetch_array($result);
		return ($return) ? ($return['maximum']+1) : 1 ;
	}
	
	//Find all the rows in the current database table.
	public static function find_all(){
		global $db;
		return self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY sortorder ASC");
	}

	public static function find_by_type($type){
		global $db;
		return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE status='1' and hall_type='$type' ORDER BY sortorder ASC");
	}
	public static function find_by_hotel($packageid)
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " .self::$table_name . " WHERE hotel_id='$packageid' and status='1' ORDER BY sortorder DESC");
    }

	public static function find_by_active_hall($hotel_id){
		global $db;
		return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE status='1' and hotel_id='$hotel_id' ORDER BY id ASC");
	}

	public static function getTotalChild($pid = '')
    {
        global $db;
        $query = "SELECT COUNT(id) AS tot FROM " . self::$table_name . " WHERE hotel_id= $pid ";
        $sql = $db->query($query);
        $ret = $db->fetch_array($sql);
        return $ret['tot'];
    }

	public static function field_by_id($id=0,$fields=""){
		global $db;
		$sql = "SELECT $fields FROM ".self::$table_name." WHERE id={$id} LIMIT 1";
		$result = $db->query($sql);
		$return = $db->fetch_array($result);
		return ($return) ? $return[$fields] : '' ;
	}
	
	//Find a single row in the database where id is provided.
	public static function find_by_id($id=0){
		global $db;
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	public static function find_by_slug($slug=''){
		global $db;
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE slug='{$slug}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function find_by_id_type($hotel_id='',$id=0){
		global $db;
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE hotel_id='$hotel_id' and id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	

	public static function find_by_slug_type($hotel_id='',$slug=''){
		global $db;
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE hotel_id='$hotel_id' and slug='{$slug}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	//Find rows from the database provided the SQL statement.
	public static function find_by_sql($sql=""){
		global $db;
		$result_set = $db->query($sql);
		$object_array = array();
		while($row = $db->fetch_array($result_set)){
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
	
	//Instantiate all the attributes of the Class.
	private static function instantiate($record){
		$object  = new self;
		foreach($record as $attribute=>$value){
			if($object->has_attribute($attribute)){
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	//Check if the attribute exists in the class.
	private function has_attribute($attribute){
		$object_vars = $this->attributes();
		return array_key_exists($attribute, $object_vars);
	}
	
	//Return an array of attribute keys and thier values.
	protected function attributes(){
		$attributes = array();
		foreach(self::$db_fields as $field):
			if(property_exists($this, $field)){
				$attributes[$field] = $this->$field;
			}
		endforeach;
		return $attributes;
	}
	
	//Prepare attributes for database.
	protected function sanitized_attributes(){
		global $db;
		$clean_attributes = array();
		foreach($this->attributes() as $key=>$value):
			$clean_attributes[$key] = $db->escape_value($value);
		endforeach;
		return $clean_attributes;
	}
	
	//Save the changes.
	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	//Add  New Row to the database
	public function create(){
		global $db;
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$table_name."(";
		$sql.= join(", ", array_keys($attributes));
		$sql.= ") VALUES ('";
		$sql.= join("', '", array_values($attributes));
		$sql.= "')";
		if($db->query($sql)){
			$this->id = $db->insert_id();
			return true;
		} else {
			return false;
		}
	}
	
	//Update a row in the database.
	public function update(){
		global $db;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		
		foreach($attributes as $key=>$value):
			$attribute_pairs[] = "{$key}='{$value}'";
		endforeach;
		
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql.= join(", ", array_values($attribute_pairs));
		$sql.= " WHERE id=".$db->escape_value($this->id);
		$db->query($sql);
		return ($db->affected_rows()==1) ? true : false;
		//return true;
	}
}
?>