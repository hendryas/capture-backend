<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'third_party/midtrans/midtrans-php/Midtrans.php';

use Midtrans\Config;
use Midtrans\Snap;


class MyMidtrans
{
    private $snap;

    public function __construct()
	{
        $this->CI =& get_instance();

        /** 
         * midtrans config file load
         */
        $this->CI->load->config('midtrans');

        /**
         * Setup
         */
        Config::$serverKey = $this->CI->config->item('MIDTRANS_SERVERKEY');
        Config::$clientKey = $this->CI->config->item('MIDTRANS_CLIENTKEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $this->snap = new Snap();
    }
    
    public function createTransaction($params)
    {
        try {
            // Create the transaction using Midtrans' API
            $transaction = $this->snap->createTransaction($params);
            // Retrieve the token for further processing
            $token = $transaction->token;
            return $token;
        } catch (Exception $e) {
            error_log("Midtrans createTransaction error: " . $e->getMessage());
            return false; 
        }
    }

}