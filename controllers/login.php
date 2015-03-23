<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     登陆
*/

class Login extends CI_Controller {

    public function index() {

        $said = isset($_POST['said']) ? $_POST['said'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $pwd = isset($_POST['password']) ? $_POST['password'] : '';

        $this->load->model('user');
        $objUser = new user;

        $data = array();
        $data['tag'] = array();
        $data['tag']['title'] = '安全风险评估管理系统';
        $data['tag']['content'] = '可以大大提高工作效率，节省工作成本，对风险评估工作具有重要的支撑意义';

        switch ($said) {
            //admin login
            case 'admin': {
                $adminData = $objUser->check('', $pwd, TRUE);
                if ($adminData === FALSE) {
                    $data['pwdError'] = 1;
                    $this->load->view('login', $data);
                }
                else {
                    $_SESSION['said'] = 'admin';
                    $this->load->view('help', $data);
                }
                break;
            }
            //user login
            case 'user': {
                $userData = $objUser->check('', $pwd, TRUE);
                if ($userData === FALSE) {
                    $data['pwdError'] = 1;
                    $this->load->view('login', $data);
                }
                else {
                    $_SESSION['said'] = 'user';
                    $_SESSION['email'] = $email;
                    $this->load->view('help', $data);
                }
                break;
            }
            //error login
            default: {
                $this->load->view('login');
                break;
            }
        }
    }
}
