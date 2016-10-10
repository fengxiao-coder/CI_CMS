<?php 

/**
 * goods
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_cat/
 */
class Goods_cat extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model("goods_cat_model");
	}

	public function index(){
		echo '111111111';
	}


}







?>