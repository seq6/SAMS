<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目列表页面
*/

class Project extends CI_Controller
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
            $this->load->view('project', $this->data);
        }
        else {
            switch ($_SESSION['said']) {
                case 'admin': {
                    $this->data['count'] = $this->objProjectModel->get_project_count();
                    $this->data['project'] = $this->objProjectModel->get();
                    break;
                }
                case 'user': {
                    $this->data['count'] = $this->objProjectModel->get_project_count(array('uid'=>$_SESSION['uid']));
                    $this->data['project'] = $this->objProjectModel->get(array('uid'=>$_SESSION['uid']));
                    break;
                }
                default:
                # code...
                break;
            }
            $this->load->view('project', $this->data);
        }
        
    }

    private function form()
    {
        # code...
    }

}