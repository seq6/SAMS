<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     登陆
*/

class Login extends CI_Controller
{
    private $data;

    private $objUserModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();

        $this->load->model('user_model');
        $this->objUserModel = new user_model;
    }

    public function index()
    {

        if (!empty($_POST)) {
            $this->form();
        }
        else {
            $this->load->view('login');
        }
    }

    public function form()
    {
        $said  = isset($_POST['said'])     ? $_POST['said']     : '';
        $email = isset($_POST['email'])    ? $_POST['email']    : '';
        $pwd   = isset($_POST['password']) ? $_POST['password'] : '';

        switch ($said) {
            //admin login
            case 'admin': {
                $adminData = $this->objUserModel->check('', $pwd, true);
                if ($adminData == false) {
                    $this->data['pwdError'] = 1;
                    $this->data['said'] = 'admin';
                    $this->load->view('login', $this->data);
                }
                else {
                    $_SESSION['said'] = 'admin';
                    $_SESSION['name'] = $adminData['name'];
                    header("location:help");
                }
                break;
            }
            //user login
            case 'user': {
                $userData = $this->objUserModel->check($email, $pwd, false);
                if ($userData == false) {
                    $this->data['pwdError'] = 1;
                    $this->data['said'] = 'user';
                    $this->load->view('login', $this->data);
                }
                else {
                    $_SESSION['said'] = 'user';
                    $_SESSION['name'] = $userData['name'];
                    $_SESSION['email'] = $email;
                    header("location:help");
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
