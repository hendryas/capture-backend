<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/midtrans/midtrans-php/Midtrans.php';

use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;


class MyMidtrans
{
    private $snap;

    public function __construct()
    {
        $this->CI = &get_instance();

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


    public function notification()
    {
        $this->printExampleWarningMessage();
        try {
            $notif = new Notification();
            $response = $notif->getResponse();
            return $response;
        }
        catch (\Exception $e) {
            error_log("Midtrans createTransaction error: " . $e->getMessage());
            echo $e->getMessage();
            die;
            return false;
        }
    }

    function printExampleWarningMessage()
        {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                echo 'Notification-handler are not meant to be opened via browser / GET HTTP method. It is used to handle Midtrans HTTP POST notification / webhook.';
            }
            if (strpos(Config::$serverKey, 'your ') != false) {
                echo "<code>";
                echo "<h4>Please set your server key from sandbox</h4>";
                echo "In file: " . __FILE__;
                echo "<br>";
                echo "<br>";
                echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
                die();
            }
        }
}
