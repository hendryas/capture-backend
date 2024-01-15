<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    // Custom validation rule to check if a value exists in the database
    public function is_unique_user($value, $field) {
        $CI =& get_instance();
        $CI->load->database();

        // Get the table and field from the $field parameter
        list($table, $field) = explode('.', $field);

        // Check if the value already exists in the database
        $query = $CI->db->limit(1)->get_where($table, array($field => $value));
        return $query->num_rows() === 0;
    }
}
