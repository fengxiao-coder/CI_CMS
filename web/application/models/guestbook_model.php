<?php
/**
 * guestbook模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class Guestbook_Model extends MY_Model
{
	public $list_array=array(
         'id' => 'id' ,
         'guesttype' => 'guesttype' ,
         'guestid' => 'guestid' ,
         'username' => 'username' ,
         'guesttitle' => 'guesttitle' ,
         'guestcontent' => 'guestcontent' ,
         'adminreply' => 'adminreply' ,
         'adminreplyadmin' => 'adminreplyadmin' ,
         'content' => 'content' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $form_array=array(
         'id' => 'id' ,
         'guesttype' => 'guesttype' ,
         'guestid' => 'guestid' ,
         'username' => 'username' ,
         'guesttitle' => 'guesttitle' ,
         'guestcontent' => 'guestcontent' ,
         'adminreply' => 'adminreply' ,
         'adminreplyadmin' => 'adminreplyadmin' ,
         'content' => 'content' ,
         'created' => 'created' ,
         'modified' => 'modified' ,
         'status' => 'status' ,
	);

	public $_rule_config=array(
        array('field' => 'id' , 'label' => 'id' , 'rules' => 'required'),
        array('field' => 'guesttype' , 'label' => 'guesttype' , 'rules' => 'required'),
        array('field' => 'guestid' , 'label' => 'guestid' , 'rules' => 'required'),
        array('field' => 'username' , 'label' => 'username' , 'rules' => 'required'),
        array('field' => 'guesttitle' , 'label' => 'guesttitle' , 'rules' => 'required'),
        array('field' => 'guestcontent' , 'label' => 'guestcontent' , 'rules' => 'required'),
        array('field' => 'adminreply' , 'label' => 'adminreply' , 'rules' => 'required'),
        array('field' => 'adminreplyadmin' , 'label' => 'adminreplyadmin' , 'rules' => 'required'),
        array('field' => 'content' , 'label' => 'content' , 'rules' => 'required'),
        array('field' => 'created' , 'label' => 'created' , 'rules' => 'required'),
        array('field' => 'modified' , 'label' => 'modified' , 'rules' => 'required'),
        array('field' => 'status' , 'label' => 'status' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'id';
		$this->_attributes = array( 
				'id' => '',
				'guesttype' => '',
				'guestid' => '',
				'username' => '',
				'guesttitle' => '',
				'guestcontent' => '',
				'adminreply' => '',
				'adminreplyadmin' => '',
				'content' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
}