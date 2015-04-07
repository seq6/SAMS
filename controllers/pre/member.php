<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Member extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '项目人员';
        $this->data['tag']['content'] = '参与项目的人员情况，便于项目中进行联络和沟通';
    }

    public function index()
    {
        $this->load->view('pre/member', $this->data);
    }

}