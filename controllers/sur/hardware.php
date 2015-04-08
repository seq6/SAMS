<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Hardware extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '硬件资源';
        $this->data['tag']['content'] = '信息系统运行所依赖的基本设备，如：个人电脑、服务器、交换机、路由器等';
    }

    public function index()
    {
        $this->load->view('sur/hardware', $this->data);
    }

}