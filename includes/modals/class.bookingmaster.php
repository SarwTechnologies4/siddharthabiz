<?php

class Bookingmaster extends DatabaseObject
{

    protected static $table_name = "tbl_apibooking";
    protected static $db_fields = array('id', 'user_id', 'hotel_code', 'booking_code', 'checkin_date', 'checkout_date', 'nights', 'first_name', 'last_name', 'address', 'city', 'zipcode', 'country', 'country_code', 'email', 'contact_no', 'flightname', 'arrivaltime', 'personal_request', 'booking_date', 'pay_type', 'pay_invoice', 'pay_code', 'pay_pan', 'transaction_id', 'has_payment', 'payment_date', 'currency', 'currency_symbol', 'subtotal', 'grand_total', 'tax_amount', 'service_charge', 'approved', 'approved_by', 'approved_date', 'status', 'nabil_orderid', 'nabil_sessionid', 'nabil_prn', 'nabil_pan', 'nabil_card', 'nabil_cardholder', 'nabil_order_status', 'nabil_response_desc', 'nabil_marchant_id', 'nabil_order_desc', 'nabil_approved_id', 'nabil_approved_amt', 'nabil_approved_currency', 'nabil_approved_datetime');

    public $id;
    public $user_id;
    public $hotel_code;
    public $booking_code;
    public $checkin_date;
    public $checkout_date;
    public $nights;
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $zipcode;
    public $country;
    public $country_code;
    public $email;
    public $contact_no;
    public $flightname;
    public $arrivaltime;
    public $personal_request;
    public $booking_date;
    public $pay_type;
    public $pay_invoice;
    public $pay_code;
    public $pay_pan;
    public $transaction_id;
    public $has_payment;
    public $payment_date;
    public $currency;
    public $currency_symbol;
    public $subtotal;
    public $grand_total;
    public $tax_amount;
    public $service_charge;
    public $approved;
    public $approved_by;
    public $approved_date;
    public $status;
    public $nabil_orderid;
    public $nabil_sessionid;
    public $nabil_prn;
    public $nabil_pan;
    public $nabil_card;
    public $nabil_cardholder;
    public $nabil_order_status;
    public $nabil_response_desc;
    public $nabil_marchant_id;
    public $nabil_order_desc;
    public $nabil_approved_id;
    public $nabil_approved_amt;
    public $nabil_approved_currency;
    public $nabil_approved_datetime;

    //Find a single row in the database where id is provided.
    public static function find_by_token($booking_code = 0)
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE booking_code='$booking_code' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_id($id = 0)
    {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id='{$id}' LIMIT 1");
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

    public static function check_booked_room($code, $room, $checkin, $checkout)
    {
        global $db;
        $num = 0;
        /*
        eg.      checkin 2016-04-18      checkout 2016-04-22
        condition1       2016-04-15               2016-04-20
        condition2       2016-04-18               2016-04-20
        condition3       2016-04-20               2016-04-25
        Now add 3 condition and return sum of room 
        */

        //condition 1
        $sql = "SELECT sum(tbc.no_of_room) as total_room 
        FROM " . self::$table_name . " tb INNER JOIN
        tbl_apibooking_child tbc
        ON tb.id=tbc.master_id
        WHERE tb.hotel_code='$code'
        AND room_type='$room'
        AND approved='1'
        AND ( (tb.checkin_date<'$checkin' and tb.checkout_date>='$checkin')
             OR (tb.checkin_date='$checkin') 
             OR (tb.checkin_date<='$checkout' and tb.checkout_date>='$checkout')
            )";
        $result = $db->query($sql);
        $row = $db->fetch_array($result);
        $num = $row['total_room'];
        return $num;
    }

    public static function cond_booked_room($code, $room, $date)
    {
        global $db;
        $num = 0;
        $sql = "SELECT sum(tbc.no_of_room) AS total_room 
        FROM " . self::$table_name . " tb INNER JOIN
        tbl_apibooking_child tbc
        ON tb.id=tbc.master_id
        WHERE tb.hotel_code='$code'
        AND room_type='$room'
        AND approved='1'
        AND '$date' BETWEEN tb.checkin_date AND tb.checkout_date";
        $result = $db->query($sql);
        $row = $db->fetch_array($result);
        $num = $row['total_room'];
        return $num;
    }
}

?>