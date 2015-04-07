<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Parts extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '评估双方';
        $this->data['tag']['content'] = '项目启动时必须填写评估方和被评估方的信息，评估双方的信息是风险评估报告中不可缺少的部分';
    }

    public function index()
    {
        $this->load->view('pre/parts', $this->data);
    }

}