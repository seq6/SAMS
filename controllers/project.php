<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目列表
*/

class Project extends CI_Controller
{

    private $data;

    private $objProjectModel;

    private $objUserModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();

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
            if (isset($_SESSION['project'])) {
                unset($_SESSION['project']);
            }

            $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
            $limit = 10;
            $offset = ($pageNo - 1) * 10;

            switch ($_SESSION['login']['said']) {
                case 'admin': {
                    $this->data['count'] = $this->objProjectModel->get_project_count();
                    $this->data['project'] = $this->objProjectModel->get_projetcs(null, $limit, $offset);
                    break;
                }
                case 'user': {
                    $uid = $_SESSION['login']['uid'];
                    $this->data['count'] = $this->objProjectModel->get_project_count(array('uid'=>$uid));
                    $this->data['project'] = $this->objProjectModel->get_projetc(array('uid'=>$uid));
                    break;
                }
                default:
                # code...
                break;
            }
            
            $this->data['pageNo'] = $pageNo;
            $this->load->view('project', $this->data);
        }
        
    }

    private function form()
    {
        # code...
    }

}