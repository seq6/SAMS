<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     登陆
*/

class Login extends CI_Controller {

    private $data;

    function __construct() {
        parent::__construct();
        
        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '安全风险评估管理系统';
        $this->data['tag']['content'] = '可以大大提高工作效率，节省工作成本，对风险评估工作具有重要的支撑意义';
        
    }

    public function index() {

        $said = isset($_POST['said']) ? $_POST['said'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $pwd = isset($_POST['password']) ? $_POST['password'] : '';

        $this->load->model('user_model');
        $objUser = new User_model;

        switch ($said) {
            //admin login
            case 'admin': {
                $adminData = $objUser->check('', $pwd, TRUE);
                if ($adminData === FALSE) {
                    $this->data['pwdError'] = 1;
                    $this->data['said'] = 'admin';
                    $this->load->view('login', $this->data);
                }
                else {
                    $_SESSION['said'] = 'admin';
                    $this->load->view('help', $this->data);
                }
                break;
            }
            //user login
            case 'user': {
                $userData = $objUser->check('', $pwd, TRUE);
                if ($userData === FALSE) {
                    $this->data['pwdError'] = 1;
                    $this->data['said'] = 'user';
                    $this->load->view('login', $this->data);
                }
                else {
                    $_SESSION['said'] = 'user';
                    $_SESSION['email'] = $email;
                    $this->load->view('help', $this->data);
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
