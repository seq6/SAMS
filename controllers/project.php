<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目列表页面
*/

class Project extends CI_Controller
{

    private $data;

    private $objProjectModel;

    function __construct()
    {
        parent::__construct();

        $data = array();

        $this->load->model('project_model');
        $objProject = new project_model;
    }

    public function index()
    {
        switch ($_SESSION['said']) {
            case 'admin': {

            }
            case 'user': {

            }
            default:
                # code...
                break;
        }
        $this->load->view('project');
    }

}