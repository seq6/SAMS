<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     已登录进入项目页面
*           未登录进入登陆页面
*/

class Welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $said = isset($_SESSION['said']) ? $_SESSION['said'] : false;
        if ($said === false || ($said != 'admin' && $said != 'user')) {
            $this->load->view('login');
        }
        else {
            $this->load->view('project');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
