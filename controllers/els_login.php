<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     登陆页面
*/

class Els_login extends CI_Controller {

    public function index() {
        $uid = $this->session->userdata('uid');
        if ($uid === FALSE) {
            //logining
            if (isset($_POST['uid'])) {
                $uid = $_POST['uid'];
                $email = $_POST['email'];
                $pwd = $_POST['pid'];
                $this->load->model('user');
                $objUser = new user;
                if ($objUser->check('', $pwd, TRUE)) {
                    $newdata = array('uid'=>'admin', 'email'=>'', 'pid'=>'');
                    $this->session->set_userdata($newdata);
                    $this->load->view('els_help');
                }
            }
            //no login
            else {
                $this->load->view('els_login');
            }
        }
        else {
            var_dump('sd');
            $this->load->view('els_help');
        }
    }

    private function admin_login($value='')
    {
        # code...
    }

    private function user_login($value='')
    {
        # code...
    }
}
