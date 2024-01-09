<?php

class Vehicle extends DatabaseObject
{

    protected static $table_name = "tbl_vehicle";
    protected static $db_fields = array('id', 'parent_id', 'slug', 'title', 'max_pax', 'content', 'status', 'added_by', 'sortorder', 'added_date', 'image',
        'reg_no', 'make_year', 'bill_book_image'
    );

    public $id;
    public $parent_id;
    public $slug;
    public $title;
    public $max_pax;
    public $content;
    public $status;
    public $sortorder;
    public $added_by;
    public $added_date;
    public $image;
    public $reg_no;
    public $make_year;
    public $bill_book_image;


    public static function vehicle_list($parentId = 0)
    {
        global $db;
        return self::find_by_sql("SELECT id, title FROM " . self::$table_name . " WHERE status=1 AND parent_id=$parentId ORDER BY sortorder ASC");
    }

    static function find_all_byparent_by($user_id)
    {
        global $db;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE added_by='" . $user_id . "' ORDER BY sortorder ASC";
        return self::find_by_sql($sql);
    }

    //Find all by parent id the current database table.
    static function find_all_byparent($parent_id = 0)
    {
        global $db;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE parent_id=$parent_id  ORDER BY sortorder ASC";
        return self::find_by_sql($sql);
    }

    static function find_all_child_by($parent_id = 0, $user_id = 0)
    {
        global $db;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE parent_id='" . $parent_id . "' AND added_by='" . $user_id . "' ORDER BY sortorder ASC";
        return self::find_by_sql($sql);
    }

    // Get total Child no.
    public static function getTotalChild($pid = '')
    {
        global $db;
        $query = "SELECT COUNT(id) AS tot FROM " . self::$table_name . " WHERE parent_id= $pid ";
        $sql = $db->query($query);
        $ret = $db->fetch_array($sql);
        return $ret['tot'];
    }

    public static function get_parentList_bylevel($level = 1, $selid = 0)
    {
        global $db;
        $sql1 = "SELECT id,title FROM " . self::$table_name . " WHERE parent_id='0' ORDER BY sortorder ASC";
        $result = '';
        $prodtRec1 = self::find_by_sql($sql1);
        $result .= '<select data-placeholder="None" class="chosen-select" id="parent_id" name="parent_id">';
        $result .= '<option value="0">None</option>';
        /******** First level ********/
        if ($prodtRec1):
            foreach ($prodtRec1 as $prodtRow1):
                $sel1 = ($selid == $prodtRow1->id) ? 'selected' : '';
                $result .= '<option value="' . $prodtRow1->id . '" ' . $sel1 . '>' . $prodtRow1->title . '</option>';
                /******** Second level ********/
                if ($level != 1) {
                    $sql2 = "SELECT id,title FROM " . self::$table_name . " WHERE parent_id='" . $prodtRow1->id . "' ORDER BY sortorder ASC";
                    $prodtRec2 = self::find_by_sql($sql2);
                    if ($prodtRec2):
                        foreach ($prodtRec2 as $prodtRow2):
                            $sel2 = ($selid == $prodtRow2->id) ? 'selected' : '';
                            $result .= '<option value="' . $prodtRow2->id . '" ' . $sel2 . '>&nbsp;&nbsp;- ' . $prodtRow2->title . '</option>';
                            /******** Third level ********/
                            if ($level != 2) {
                                $sql3 = "SELECT id,title FROM " . self::$table_name . " WHERE parent_id='" . $prodtRow2->id . "' ORDER BY sortorder ASC";
                                $prodtRec3 = self::find_by_sql($sql3);
                                if ($prodtRec3):
                                    foreach ($prodtRec3 as $prodtRow3):
                                        $sel3 = ($selid == $prodtRow3->id) ? 'selected' : '';
                                        $result .= '<option value="' . $prodtRow3->id . '" ' . $sel3 . '>&nbsp;&nbsp;&nbsp;&nbsp;- ' . $prodtRow3->title . '</option>';
                                        /******** Fourth level ********/
                                        if ($level != 3) {
                                            $sql4 = "SELECT id,title FROM " . self::$table_name . " WHERE parent_id='" . $prodtRow3->id . "' ORDER BY sortorder ASC";
                                            $prodtRec4 = self::find_by_sql($sql4);
                                            if ($prodtRec4):
                                                foreach ($prodtRec4 as $prodtRow4):
                                                    $sel4 = ($selid == $prodtRow4->id) ? 'selected' : '';
                                                    $result .= '<option value="' . $prodtRow4->id . '" ' . $sel4 . '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $prodtRow4->title . '</option>';
                                                    /******** Fifth level ********/
                                                    if ($level != 4) {
                                                        $sql5 = "SELECT id,title FROM " . self::$table_name . " WHERE parent_id='" . $prodtRow4->id . "' ORDER BY sortorder ASC";
                                                        $prodtRec5 = self::find_by_sql($sql5);
                                                        if ($prodtRec5):
                                                            foreach ($prodtRec5 as $prodtRow5):
                                                                $sel5 = ($selid == $prodtRow5->id) ? 'selected' : '';
                                                                $result .= '<option value="' . $prodtRow5->id . '" ' . $sel5 . '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $prodtRow5->title . '</option>';
                                                            endforeach;
                                                        endif;
                                                    }
                                                endforeach;
                                            endif;
                                        }
                                    endforeach;
                                endif;
                            }
                        endforeach;
                    endif;
                }
            endforeach;
        endif;
        $result .= '</select>';
        return $result;
    }

    //Find a single row in the database where slug is provided.
    static function find_by_slug($slug = '')
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE slug='$slug' AND status='1' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function checkDupliName($title = '')
    {
        global $db;
        $query = $db->query("SELECT title FROM " . self::$table_name . " WHERE title='$title' LIMIT 1");
        $result = $db->num_rows($query);
        if ($result > 0) {
            return true;
        }
    }


    // Vehicle display
    public static function getVehicle($vehicle = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE name='{$vehicle}' AND status=1 LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
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
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " ORDER BY sortorder ASC");
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
        //return true;
    }
}

?>