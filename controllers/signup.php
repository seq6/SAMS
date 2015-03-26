<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     注册
*/

class Signup extends CI_Controller
{
    private $data;

    private $objProjectModel;

    private $objUserModel;

    function __construct()
    {
        parent::__construct();

        $data = array();

        $this->load->model('project_model');
        $this->objProjectModel = new project_model;

        $this->load->model('user_model');
        $this->objUserModel = new user_model;
    }

    public function index()
    {
        //
        if (!empty($_POST)) {
            $this->form();
        }
        else {
            $thie->data['user'] = $this->objUserModel->get_all_user();
            $this->load->view('signup', $this->data);
        }
    }

    private function form()
    {
        // get post
        $pName     = isset($_POST['pName'])    ? $_POST['pName']     : '';
        $theUser   = isset($_POST['theUser'])  ? $_POST['theUser']   : '';
        $theUserId = isset($_POST['theUserId'])? $_POST['theUserId'] : '';
        $userName  = isset($_POST['userName']) ? $_POST['userName']  : '';
        $email     = isset($_POST['email'])    ? $_POST['email']     : '';
        $password  = isset($_POST['password']) ? $_POST['password']  : '';

        switch ($theUser) {
            case 'oldUser': {
                $pid = $this->objProjectModel->add($pName);
                $this->data['error'] = $this->objUserModel->add_user_pid($theUserId, $pid);
            }
            case 'newUser': {
                $pid = $this->objProjectModel->add($pName);
                $this->data['error'] = $this->add($userName, $email, $password, $pid);
            }
            default: {
                $this->data['error'] = 1;
            }
        }

        $this->view->('signup', $this->data);
    }
}