<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuthenticationJWT
{
    private $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->controller->load->library('Authorization_Token'); // Load the library here
    }

    public function authenticateUser()
    {
        $headers = $this->controller->input->request_headers();
        $authToken = $headers['Authorization'] ??  $headers['authorization'];
        if (isset($authToken)) {
            $decodedToken = $this->controller->authorization_token->validateToken($authToken);

            if ($decodedToken['status']) {
                // Set user data to be used across the controller
                $data = $this->controller->userModel->getDataUserById($decodedToken['data']->id_user)->row_array();
                $this->controller->userData  = $data;
            } else {
                $this->controller->response($decodedToken, 401);
            }
        } else {
            $this->controller->response(['status' => false, 'message' => 'Authentication failed'], 401);
        }
    }
}
