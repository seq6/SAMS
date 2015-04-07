<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Start extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '项目启动';
        $this->data['tag']['content'] = '请确认项目信息后启动项，只有项目启动后才能进入下一阶段的工作';
    }

    public function index()
    {
        $this->load->view('pre/start', $this->data);
    }
}