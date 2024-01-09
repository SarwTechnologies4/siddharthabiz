<?php

class Generaluser extends DatabaseObject
{

    protected static $table_name = "tbl_users";
    protected static $db_fields = array('id', 'first_name', 'middle_name', 'last_name', 'contact', 'email', 'optional_email','$hotels_no', 'username', 'password', 'accesskey', 'image', 'group_id', 'access_code', 'facebook_uid', 'facebook_accesstoken', 'facebook_tokenexpire', 'sortorder', 'status', 'added_date', 'type','address', 'prop_id', 'user_id', 'dob','gender', 'physicalcard','actual_point','usable_point');

    public $id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $contact;
    public $name;
    public $email;
    public $optional_email;
    public $username;
    public $password;
    public $accesskey;
    public $image;
    public $hotels_no;
    public $group_id;
    public $access_code;
    public $facebook_uid;
    public $facebook_accesstoken;
    public $facebook_tokenexpire;
    public $sortorder;
    public $status;
    public $added_date;
    public $type;

    public $address;
    public $prop_id;
    public $user_id;

    public $dob;
    public $gender;

    public $physicalcard;


    public $actual_point;
    public $usable_point;

    public $expiry_date;




    public static function get_user_option($selId = '')
    {
        global $db;
        $sql = "SELECT * FROM tbl_users WHERE type='general' and status='1' ORDER BY sortorder ASC ";
        $user = self::find_by_sql($sql);
        $result = '';
        if ($user):
            foreach ($user as $Row):
                $sel = ($selId == $Row->id) ? 'selected' : '';
                $result .= '<option value="' . $Row->id . '" ' . $sel . '>' . $Row->first_name . ' ' . $Row->middle_name . ' ' . $Row->last_name . '</option>';
            endforeach;
        endif;
        return $result;
    }



    // get user id by access token
    public static function get_uid_by_accessToken($accTok = '')
    {
        global $db;
        $sql = "SELECT `id` FROM " . self::$table_name . " WHERE `access_code`='" . $accTok . "' LIMIT 1 ";
        $result = self::find_by_sql($sql);
        return !empty($result) ? array_shift($result) : false;
    }

    public static function get_by_accesskey($accesskey = '')
    {
        global $db;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE `accesskey`='" . $accesskey . "' LIMIT 1 ";
        $result = self::find_by_sql($sql);
        return !empty($result) ? array_shift($result) : false;
    }

    // find info by email addtess
    public static function find_by_mail($email = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT `id`,`email`,`first_name`,`middle_name`,`last_name` FROM " . self::$table_name . " WHERE `email`='" . $email . "' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    // get valid email address for new password generate (forget password)
    public static function get_validMember_mail($email = "")
    {
        global $db;
        $query = " SELECT `email` FROM " . self::$table_name . " WHERE `email`='" . $email . "' ";
        $record = $db->query($query);
        $result = $db->num_rows($record);
        return $result;
    }

    // get user email address by user_id
    public static function get_UseremailAddress_byId($id = '')
    {
        global $db;
        $sql = "SELECT email FROM " . self::$table_name . " WHERE id=" . $id;
        $result = $db->query($sql);
        $return = $db->fetch_array($result);
        return ($return) ? $return['email'] : '';
    }

    // get person info by id for question set associate
    public static function get_user_shotInfo_byId($id = "")
    {
        global $db;
        $sql = "SELECT id,first_name,middle_name,last_name FROM " . self::$table_name . " WHERE id=" . $id;
        $result = self::find_by_sql($sql);
        return !empty($result) ? array_shift($result) : false;
    }

    //Authenticate login administratior user access.
    public static function authenticateAdmin($username = "", $password = "")
    {
        global $db;
        $username = $db->escape_value($username);
        $password = $db->escape_value($password);

        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE username='{$username}' ";
        $sql .= "AND password='{$password}' AND (group_id=1 or group_id=2)";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function authenticateAdminId($id = 0)
    {
        global $db;
        $id = $db->escape_value($id);

        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE id='{$id}' ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    //Authenticate login front user access.
    public static function authenticateNormal($username = "", $password = "")
    {
        global $db;
        $username = $db->escape_value($username);
        $password = $db->escape_value($password);

        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE username='{$username}' ";
        $sql .= "AND password='{$password}' AND group_id=3 ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    //-----** COMMON DATABASE METHODS **------\\
    public static function find_maximum($field = "sortorder")
    {
        global $db;
        $result = $db->query("SELECT MAX({$field}) AS maximum FROM " . self::$table_name);
        $return = $db->fetch_array($result);
        return ($return) ? ($return['maximum'] + 1) : 1;
    }

    public static function checkDupliUname($username = '')
    {
        global $db;
        $query = $db->query("SELECT username FROM " . self::$table_name . " WHERE username='$username' LIMIT 1");
        $result = $db->num_rows($query);
        if ($result > 0) {
            return true;
        }

    }

    //Find all the rows in the current database table.
    public static function find_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . "");
    }

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

    public static function by_cash($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET actual_point= actual_point + {$point} , usable_point = usable_point + {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }

    public static function by_point($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET usable_point = usable_point - {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }

    /*add deduct usable point*/

    public static function add_usable_point($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET usable_point = usable_point + {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }
    public static function deduct_usable_point($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET usable_point = usable_point - {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }

    /*add deduct actual point*/
    public static function add_actual_point($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET actual_point = actual_point + {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }
    public static function deduct_actual_point($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET actual_point = actual_point - {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }

    /*coorectcash*/
    public static function correct_cash($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET actual_point= actual_point - {$point} , usable_point = usable_point - {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }

    public static function correct_point($id='',$point = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET usable_point = usable_point + {$point}";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }
    public static function modified_date($id='',$date = 0){
        global $db;
        $sql = "UPDATE " . self::$table_name;
        $sql .= " SET expiry_date= '{$date}' ";
        $sql .= " WHERE id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }
}

?>