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
        if (!empty($_POST)) {
            $this->form();
        }
        
        $this->data['user'] = $this->objUserModel->get_all_user();
        $this->load->view('signup', $this->data);
    }

    private function form()
    {
        // get post
        $pName    = isset($_POST['pName'])    ? $_POST['pName']     : '';
        $theUser  = isset($_POST['theUser'])  ? $_POST['theUser']   : '';
        $uid      = isset($_POST['theUserId'])? $_POST['theUserId'] : '';
        $userName = isset($_POST['userName']) ? $_POST['userName']  : '';
        $email    = isset($_POST['email'])    ? $_POST['email']     : '';
        $password = isset($_POST['password']) ? $_POST['password']  : '';

        $res = false;
        switch ($theUser) {
            case 'oldUser': {
                $pid = $this->objProjectModel->add_project($pName);
                $this->objUserModel->add_user_pid($uid, $pid);
                $res = $this->objProjectModel->update_project($pid, array('uid' => $uid));
                $this->data['error'] = ($res != false) ? 1 : 2;
                break;
            }
            case 'newUser': {
                $pid = $this->objProjectModel->add_projetc($pName);
                $uid = $this->objUserModel->add_user($userName, $email, $password, $pid);
                $res = $this->objProjectModel->update_project($pid, array('uid' => $uid));
                $this->data['error'] = ($res != false) ? 1 : 2;
                break;
            }
            default: {
                $this->data['error'] = 3;
                break;
            }
        }
    }
}