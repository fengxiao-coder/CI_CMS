<?php
/**
 * news_sort模型
 * @author 咸洪伟
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class News_sort_Model extends MY_Model
{
 
	public function __construct(){
		parent::__construct();
		$this->_pk='id';
		$this->_attributes=array( 
				'id'=>'',
				'parentid'=>'',
				'nodepath'=>'',
				'sortname'=>'',
				'imagemark'=>'',
				'comment'=>'',
				'depth'=>'',
				'recycled'=>'',
				'created'=>'',
				'modified'=>'',
				'status'=>'',
		);
	}
}