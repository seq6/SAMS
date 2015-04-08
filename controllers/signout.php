<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     注销
*/

class Signout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        /* unset session */
        $this->unset_session('login');
        $this->unset_session('project');

        header('location:login');
    }

    private function unset_session($name = null)
    {
        if ($name !== null && isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
}
