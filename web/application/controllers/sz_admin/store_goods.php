<?php
/**
 * store_goods
 * @version 1.0
 * @package application
 * @subpackage application/controllers/store_goods/
 */
class Store_goods extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model("goods_model");
	}
        
        
        
}
