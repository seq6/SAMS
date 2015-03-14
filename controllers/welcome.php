<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
		$this->load->model('pjType');
		$obj = new pjType;
		$res = $obj->get_item(null,0,0,true);
		var_dump($res);
		//$res = $this->db->query('select * FROM test1');
		//var_dump($res);
		//foreach($res->result() as $r)
		//{
		//	echo "<br/>";
		//	var_dump($r);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
