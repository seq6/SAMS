<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     显示项目列表
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
            //更新会话中project信息
            if (isset($_SESSION['project'])) {
                unset($_SESSION['project']);
            }

            //分页
            $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
            $limit = 10;
            $offset = ($pageNo - 1) * 10;

            switch ($_SESSION['login']['said']) {
                //管理员可查看所有项目
                case 'admin': {
                    $this->data['count'] = $this->objProjectModel->get_project_count();
                    $this->data['project'] = $this->objProjectModel->get_projects(null, $limit, $offset);
                    foreach ($this->data['project'] as $key => $p) {
                        $this->data['project'][$key]['uname'] = $this->id2name($p['uid']);
                    }
                    break;
                }
                //用户可查看自己管辖项目
                case 'user': {
                    $uid = $_SESSION['login']['uid'];
                    $this->data['count'] = $this->objProjectModel->get_project_count(array('uid'=>$uid));
                    $this->data['project'] = $this->objProjectModel->get_projects(array('uid'=>$uid), $limit, $offset);
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

    private function id2name($uid = 0)
    {
        return $this->objUserModel->get_user_name($uid);
    }

}