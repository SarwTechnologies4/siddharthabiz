<?php

class Hotelapi extends DatabaseObject
{

    protected static $table_name = "tbl_apihotel";
    protected static $db_fields = array(
        'id', 'user_id', 'star', 'hotel_type', 'map', 'map_embed', 'policy', 'faq', 'title', 'long_name', 'slug', 'code', 'logo', 'image', 'home_image', 'banner_image', 'detail_image', 'contact_no',
        'email','meet_email', 'res_email', 'res_contact_no', 'meet_contact_no', 'inquiry_email', 'inquiry_type', 'street', 'city', 'district', 'zone', 'contact_person', 'contact_person_contact_no',
        'contact_person_email', 'website', 'detail', 'restaurant', 'cuisine', 'breads','whyus', 'cakes', 'beverages',  'content', 'added_date', 'payment_type',
        'status', 'featured', 'homepage','sortorder', 'meta_keywords', 'meta_description',
        'merchant_id', 'merchant_key', 'nabil_mode', 'twpg_cert_file', 'twpg_key_file',
        'destinationId', 'feature', 'hotel_rooms', 'customers_per_year', 'distance_to_center', 'rest', 'brief', 'cleaning', 'about_property',
        'note', 'imp_info', 'nearby_attractions', 'weddinghall', 'ota_booking_com', 'ota_trip_advisor', 'ota_expedia', 'social_facebook', 'social_instagram', 'social_tiktok','prop_code', 'hotel_code'
    );

    public $id;
    public $user_id;
    public $title;
    public $long_name;
    public $slug;
    public $code;
    public $logo;
    public $star;
    public $hotel_type;
    public $map;
    public $map_embed;
    public $policy;
    public $faq;
    public $image;
    public $home_image;
    public $banner_image;
    public $contact_no;
    public $res_contact_no;
    public $meet_contact_no;
    public $email;
    public $res_email;
    public $meet_email;
    public $inquiry_email;
    public $inquiry_type;
    public $street;
    public $city;
    public $zone;
    public $district;
    public $contact_person;
    public $contact_person_contact_no;
    public $contact_person_email;
    public $website;
    public $detail;
    public $content;
    public $restaurant;
    public $cuisine;
    public $breads;
    public $cakes;
    public $beverages;
    public $whyus;
    public $added_date;
    public $status;
    public $payment_type;
    public $featured;
    public $homepage;
    public $meta_keywords;
    public $meta_description;
    public $merchant_id;
    public $merchant_key;
    public $nabil_mode;
    public $twpg_cert_file;
    public $twpg_key_file;
    public $destinationId;
    public $feature;
    public $hotel_rooms;
    public $customers_per_year;
    public $distance_to_center;
    public $rest;
    public $brief;
    public $sortorder;
    
    public $cleaning;
    public $about_property;
    public $note;
    public $imp_info;
    public $nearby_attractions;
    public $weddinghall;
    public $ota_booking_com, $ota_trip_advisor, $ota_expedia, $social_facebook, $social_instagram, $social_tiktok;

    public $prop_code;
    public $hotel_code;

    public $detail_image;





    //Find all the rows in the current database table.
	public static function find_all_active(){
		global $db;
		return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE status=1 ORDER BY sortorder DESC");
	}


    public static function checkDupliName($prop_code='',$user_id=1)
	{
		global $db;
        

		$query = $db->query("SELECT prop_code FROM ".self::$table_name." WHERE prop_code='".$prop_code."' AND user_id!=".$user_id." LIMIT 1");
		$result= $db->num_rows($query);
		if($result>0) {return true;}
	}

    public static function get_user_option($selId = '')
    {
        global $db;
        $sql = "SELECT * FROM tbl_apihotel ORDER BY title ASC";
        $hotel = self::find_by_sql($sql);
        $result = '';
        if ($hotel):
            foreach ($hotel as $Row):
                $sel = ($selId == $Row->id) ? 'selected' : '';
                $result .= '<option value="' . $Row->id . '" ' . $sel . '>' . $Row->title . '</option>';
            endforeach;
        endif;
        return $result;
    }
    public static function get_user_prop($selId = '')
    {
        global $db;
        $sql = "SELECT * FROM tbl_apihotel ORDER BY title ASC";
        $hotel = self::find_by_sql($sql);
        $result = '';
        if ($hotel):
            foreach ($hotel as $Row):
                $result = $Row->title ;
            endforeach;
        endif;
        return $result;
    }
    

    public static function get_hotel_by_destid($destid = "")
    {
        global $db;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE destinationId='$destid'";
        return self::find_by_sql($sql);
    }

    public static function get_relatedpkg($destid = '', $notid = '', $limit = '')
    {
        global $db;
        $cond = !empty($destid) ? ' AND destinationId=' . $destid : '';
        $cond2 = !empty($notid) ? ' AND id<>' . $notid : '';
        $cond3 = !empty($limit) ? ' LIMIT ' . $limit : '';
        $sql = "SELECT * FROM " . self::$table_name . " WHERE status=1 $cond $cond2 ORDER BY id DESC " . $cond3;
        return self::find_by_sql($sql);
    }

    //FIND THE HIGHEST MAX NUMBER.
    public static function find_maximum($field = "sortorder")
    {
        global $db;
        $result = $db->query("SELECT MAX({$field}) AS maximum FROM " . self::$table_name);
        $return = $db->fetch_array($result);
        return ($return) ? ($return['maximum'] + 1) : 1;
    }

    //Find all the rows in the current database table.
    public static function find_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " ORDER BY sortorder DESC");
    }
    public static function home_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE status='1' AND featured='1'  ORDER BY sortorder DESC LIMIT 6");
    }
    public static function hotel_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE status='1' AND hotel_type='Hotel & Resort' ORDER BY sortorder DESC LIMIT 6");
    }
    public static function cafe_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE status='1' AND hotel_type='Cafe' ORDER BY sortorder DESC LIMIT 6");
    }
    public static function restaurant_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE status='1' AND hotel_type='Restaurant' ORDER BY sortorder DESC LIMIT 6");
    }
    /************************** Page menu link  by me ***************************/
	public static function get_internal_link($Lsel='',$LType=0)
	{
		global $db;		
		$sql = "SELECT slug, title FROM ".self::$table_name." WHERE status='1' ORDER BY sortorder ASC";
		$pages = Hotelapi::find_by_sql($sql);		
		$linkpageDis = ($Lsel==1)?'hide':'';
		
		$result='';		
		if($pages):
		$result.='<optgroup label="property">';
			foreach($pages as $pageRow):
				$sel = ($Lsel==("hotel/".$pageRow->slug)) ?'selected':'';
				$result.='<option value="hotel/'.$pageRow->slug.'" '.$sel.'>&nbsp;&nbsp;'.$pageRow->title.'</option>';
			endforeach;
		$result.='</optgroup>';	
		endif;
		return $result;
	}
    

    public static function find_all_by_user_id($id)
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE user_id='$id' ORDER BY id ASC");
    }
    public static function find_all_by_id($id)
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id='$id' ORDER BY id ASC");
    }

    //Get sortorder by id
    public static function field_by_id($id = 0, $fields = "")
    {
        global $db;
        $sql = "SELECT $fields FROM " . self::$table_name . " WHERE id={$id} LIMIT 1";
        $result = $db->query($sql);
        $return = $db->fetch_array($result);
        return ($return) ? $return[$fields] : '';
    }

    //Find a single row in the database where id is provided.
    public static function find_by_id($id = 0)
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id='{$id}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_hotel($packageid)
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " .self::$table_name . " WHERE id='$packageid' and status='1' ORDER BY sortorder DESC");
    }


    public static function find_by_userid($id = 0)
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE user_id={$id}");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    //Find a single row in the database where slug is provided.
    static function find_by_slug($slug = '')
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE slug='$slug' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_code($code = '')
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE code='{$code}' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function count_hotel_by_id($id = "")
    {
        global $db;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE user_id='$id'";
        $records = $db->query($sql);
        $num_records = $db->num_rows($records);
        return $num_records;
    }

    public static function count_hotel_by_destid($destid = "")
    {
        global $db;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE destinationId='$destid'";
        $records = $db->query($sql);
        $num_records = $db->num_rows($records);
        return $num_records;
    }

    public static function get_field_by_user_id($user_id = 0, $fields = "")
    {
        global $db;
        $sql = "SELECT $fields FROM " . self::$table_name . " WHERE user_id={$user_id} LIMIT 1";
        $result = $db->query($sql);
        $return = $db->fetch_array($result);
        return ($return) ? $return[$fields] : '';
    }


    //Find rows from the database provided the SQL statement.
    public static function find_by_sql($sql = "")
    {
        global $db;
        $result_set = $db->query($sql);
        $object_array = array();
        while ($row = $db->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    //Instantiate all the attributes of the Class.
    private static function instantiate($record)
    {
        $object = new self;
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    //Check if the attribute exists in the class.
    private function has_attribute($attribute)
    {
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars);
    }

    //Return an array of attribute keys and thier values.
    protected function attributes()
    {
        $attributes = array();
        foreach (self::$db_fields as $field):
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        endforeach;
        return $attributes;
    }

    //Prepare attributes for database.
    protected function sanitized_attributes()
    {
        global $db;
        $clean_attributes = array();
        foreach ($this->attributes() as $key => $value):
            $clean_attributes[$key] = $db->escape_value($value);
        endforeach;
        return $clean_attributes;
    }

    //Save the changes.
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    //Add  New Row to the database
    public function create()
    {
        global $db;
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . self::$table_name . "(";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($db->query($sql)) {
            $this->id = $db->insert_id();
            return true;
        } else {
            return false;
        }
    }

    //Update a row in the database.
    public function update()
    {
        global $db;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value):
            $attribute_pairs[] = "{$key}='{$value}'";
        endforeach;

        $sql = "UPDATE " . self::$table_name . " SET ";
        $sql .= join(", ", array_values($attribute_pairs));
        $sql .= " WHERE id=" . $db->escape_value($this->id);
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
        //return true;
    }
}

?>
