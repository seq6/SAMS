<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Software extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '软件资源';
        $this->data['tag']['content'] = '信息系统运行所依赖的基本软件，如：个人操作系统、服务办公软件、业务软件等';
    }

    public function index()
    {
        $this->load->view('sur/software', $this->data);
    }

}