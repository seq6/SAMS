<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Parts extends CI_Controller
{
    private $data;

    private $objPartsModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '评估双方';
        $this->data['tag']['content'] = '项目启动时必须填写评估方和被评估方的信息，评估双方的信息是风险评估报告中不可缺少的部分';

        $this->load->model('parts_model');
        $this->objPartsModel = new Parts_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }
        else {
            //获取评估方数据
            $Aid = isset($_SESSION['project']['partA']) ? $_SESSION['project']['partA'] : 0;
            if ($Aid != 0) {
                $this->data['partA'] = $this->objPartsModel->get_part($Aid);
            }
            //获取被评估方数据
            $Bid = isset($_SESSION['project']['partB']) ? $_SESSION['project']['partB'] : 0;
            if ($Bid != 0) {
                $this->data['partB'] = $this->objPartsModel->get_part($Bid);
            }

            $this->load->view('pre/parts', $this->data);
        }
    }

    private function form()
    {
        
    }
}