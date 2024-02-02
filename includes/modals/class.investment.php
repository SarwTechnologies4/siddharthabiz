<?php

class Investment extends DatabaseObject
{

    protected static $table_name = "tbl_investment";
    protected static $db_fields = array('id', 'company_id', 'shareholder_id', 'alloted_quantity', 'price_per_share', 'investment_amount', 'percentage', 'added_date', 'deleted' , 'long_name', 'shareholders_number', 'shareholders_name');// , 'long_name', 'shareholders_number', 'shareholders_name'

    public $id;
    public $company_id;
    public $shareholder_id;
    public $alloted_quantity;
    public $price_per_share;
    public $investment_amount;
    public $percentage;
    public $added_date;
    public $deleted;
    public $long_name;
    public $shareholders_number;
    public $shareholders_name;

    public static function agg_data()
    {
        global $db;
        $sql = "SELECT hotel.id, hotel.long_name, COUNT(inv.id) AS shareholders_number, SUM(inv.alloted_quantity) AS alloted_quantity, SUM(inv.investment_amount) AS investment_amount";
        $sql .= " FROM " . self::$table_name . " AS inv";
        $sql .= " LEFT JOIN tbl_apihotel AS hotel ON hotel.id = inv.company_id";
        $sql .= " WHERE inv.deleted = 0";
        $sql .= " GROUP BY inv.company_id";
        $sql .= " ORDER BY inv.`id` DESC";
        $result = $db->query($sql);
        $object_array = [];
        while ($row = $db->fetch_array($result)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;

    }

    public static function find_by_shareHolder($shareholder_id)
    {
        global $db;
        $sql = "SELECT hotel.long_name, inv.price_per_share, inv.alloted_quantity";
        $sql .= " FROM " . self::$table_name . " AS inv";
        $sql .= " LEFT JOIN tbl_apihotel AS hotel ON hotel.id = inv.company_id";
        $sql .= " WHERE inv.deleted = 0";
        $sql .= " AND inv.shareholder_id = " . $shareholder_id;
        $sql .= " ORDER BY inv.`id` DESC";
        $result = $db->query($sql);
        $object_array = [];
        while ($row = $db->fetch_array($result)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;

    }

    // Investment display
    public static function getInvestmentByCompany($company_id)
    {
        global $db;
        $sql = "SELECT inv.*, shareholder.name as shareholders_name";
        $sql .= " FROM " . self::$table_name . " AS inv";
        $sql .= " LEFT JOIN tbl_shareholders AS shareholder ON shareholder.id = inv.shareholder_id";
        $sql .= " WHERE inv.deleted = 0";
        $sql .= " AND inv.company_id = " . $company_id;
        $sql .= " ORDER BY inv.`id` DESC";
        $result_array = self::find_by_sql($sql);
        return $result_array;
    }

    // Get investment list for filter
    public static function get_investment()
    {
        global $db;
        $sql = "SELECT id FROM " . self::$table_name . " WHERE deleted=0 ORDER BY `id` ASC ";
        return self::find_by_sql($sql);
    }

    // Investment display
    public static function getInvestment($page = "")
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE name='{$page}' AND deleted=0 LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    //Find all the rows in the current database table.
    public static function find_all()
    {
        global $db;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE deleted=0 ORDER BY `id` ASC");
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
        $sql = "SELECT inv.*, shareholder.name as shareholders_name";
        $sql .= " FROM " . self::$table_name . " AS inv";
        $sql .= " LEFT JOIN tbl_shareholders AS shareholder ON shareholder.id = inv.shareholder_id";
        $sql .= " WHERE inv.id = {$id} LIMIT 1";
        $result_array = self::find_by_sql($sql);
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