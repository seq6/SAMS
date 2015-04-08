<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Environment extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '物理环境';
        $this->data['tag']['content'] = '硬件、软件等信息资产所存放的物理区域';
    }

    public function index()
    {
        $this->load->view('sur/environment', $this->data);
    }

}