<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $said = isset($_SESSION['said']) ? $_SESSION['said'] : FALSE;
        if ($said === FALSE) {
            $this->load->view('login');
        }
        else {
            $this->load->view('help');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
