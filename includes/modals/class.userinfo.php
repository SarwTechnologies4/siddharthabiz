<?php

class Userinfo extends DatabaseObject
{

    protected static $table_name = "tbl_user_info";
    protected static $db_fields = array('id', 'person_id', 'email2', 'dob', 'zodic_sign', 'current_city', 'education', 'home_town', 'phone_res', 'phone_office',
        'mobile_no', 'mobile_no2', 'children_name', 'pet_name', 'nick_name', 'gender', 'birth_place', 'maritial_status', 'spouse_name',
        'publish_spoush_name', 'publish_children_name', 'career_start_date', 'facebook_link', 'facebook_page', 'twitter_link', 'google_plus',
        'linkedin', 'skpye_address', 'short_desc', 'website', 'other_profession', 'question_set', 'answer_status', 'notification');

    public $id;
    public $person_id;
    public $email2;
    public $dob;
    public $zodic_sign;
    public $current_city;
    public $education;
    public $home_town;
    public $phone_res;
    public $phone_office;
    public $mobile_no;
    public $mobile_no2;
    public $children_name;
    public $pet_name;
    public $nick_name;
    public $gender;
    public $birth_place;
    public $maritial_status;
    public $spouse_name;
    public $publish_spoush_name;
    public $publish_children_name;
    public $career_start_date;
    public $facebook_link;
    public $facebook_page;
    public $twitter_link;
    public $google_plus;
    public $linkedin;
    public $skpye_address;
    public $short_desc;
    public $website;
    public $other_profession;
    public $question_set;
    public $answer_status;
    public $notification;

    public static function find_by_Uid($id = 0)
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE person_id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    // Find maximum
    public static function find_maximum($field = "sortorder")
    {
        global $db;
        $result = $db->query("SELECT MAX({$field}) AS maximum FROM " . self::$table_name);
        $return = $db->fetch_array($result);
        return ($return) ? ($return['maximum'] + 1) : 1;
    }

    //Find all the rows in the current database table.
    public static function find_all($type = '1')
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE status=1 and group_type='$type'");
    }


    //Find a single row in the database where id is provided.
    public static function find_by_id($id = 0)
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
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
    }

    //Delete a row from the database
    public function delete()
    {
        global $db;
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE id=" . $db->escape_value($this->id);
        $sql .= " LIMIT 1";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }
}

?>