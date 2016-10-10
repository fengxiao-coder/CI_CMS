<?php
/**
 * brand模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Brand_Model extends MY_Model
{
	public $list_array=array(
         'brand_id' => '品牌id' ,
         'brand_name' => '品牌名称' ,
         'brand_logo' => 'brand_logo' ,
         'brand_desc' => 'brand_desc' ,
         'site_url' => 'site_url' ,
         'sort' => 'sort' ,
         'recycled' => 'recycled' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $form_array=array(
         'brand_id' => '品牌id' ,
         'brand_name' => '品牌名称' ,
         'brand_logo' => 'brand_logo' ,
         'brand_desc' => 'brand_desc' ,
         'site_url' => 'site_url' ,
         'sort' => 'sort' ,
         'recycled' => 'recycled' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $_rule_config=array(
        //array('field' => 'brand_id' , 'label' => '品牌id' , 'rules' => 'required'),
        array('field' => 'brand_name' , 'label' => '品牌名称' , 'rules' => 'required'),
        array('field' => 'brand_logo' , 'label' => 'brand_logo' , 'rules' => 'required'),
        array('field' => 'brand_desc' , 'label' => 'brand_desc' , 'rules' => 'required'),
        array('field' => 'site_url' , 'label' => 'recycled' , 'rules' => 'required'),
        array('field' => 'sort' , 'label' => 'sort' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => 'created' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => 'modified' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'brand_id';
		$this->_attributes = array( 
				'brand_id' => '',
		'cid' => '',
				'brand_name' => '',
				'brand_logo' => '',
				'brand_desc' => '',
                                'site_url' => '',
				'sort' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
        
        public function resize($source_image){
            $config['image_library'] = 'gd2';
            $config['source_image'] =$source_image;
            $config['maintain_ratio'] = TRUE;
            $config['master_dim'] = 'auto';
            $config['width'] = 100;
            $config['height'] = 40;
            $this->load->library('image_lib', $config); 
            $this->image_lib->resize();
        }
}