<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Business extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '业务系统';
        $this->data['tag']['content'] = '硬评估范围内的业务系统';
    }

    public function index()
    {
        $this->load->view('sur/business', $this->data);
    }

}