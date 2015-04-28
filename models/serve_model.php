<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     serve表
*/

class Serve_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'serve';
    }
}