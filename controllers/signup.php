<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     注册
*/

class Signup extends CI_Controller {

    function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->load->view('signup');
    }

    public function form() {
        // get post
        $pName     = isset($_POST['pName']) ? $_POST['pName'] : '';
        $theUser   = isset($_POST['theUser']) ? $_POST['theUser'] : '';
        $theUserId = isset($_POST['theUserId']) ? $_POST['theUserId'] : '';
        $userName  = isset($_POST['userName']) ? $_POST['userName'] : '';
        $email     = isset($_POST['email']) ? $_POST['email'] : '';
        $password  = isset($_POST['password']) ? $_POST['password'] : '';

        switch ($theUser) {
            case 'oldUser': {
                # code...
            }
            case 'newUser': {
                # code...
            }
            default: {

            }
        }
    }
}