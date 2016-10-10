<?php
/**
 * user模型
 * @version 1.0
 * @package application
 * @subpackage application/models
 */

class User_Model extends MY_Model
{
	public $list_array=array(
         'user_name' => '用户名' ,
         'phone' => '电话' ,
         'email' => '邮箱' ,
         'address' => '地址' ,
         //'user_rank' => '会员等级' ,
         //'status' => '状态' ,
	);

	public $search_array=array(
         'user_name' => '用户名' ,
         'phone' => '电话' ,
         'qq' => 'QQ' ,  
         'email' => '邮箱' ,
         'address' => '地址' ,
	);
	public $form_array=array(
         'email' => '邮箱' ,
         'user_name' => '用户名' ,
         'name' => '姓名' ,
         'avatar' => '头像' ,
         //'user_rank' => '会员等级' ,
         'phone' => '电话' ,
         'address' => '地址' ,
         'country_id' => '国家' ,
         'city_id' => '城市' ,
         'city' => '城市' ,
         'province_id' => '省份' ,
         'province' => '省份' ,
         'qq' => 'QQ' ,
         'created' => '创建日期' ,
         'modified' => '修改日期' ,
        // 'status' => '状态' ,
	);

	public $_rule_config=array(
        array('field' => 'user_id' , 'label' => 'user_id' , 'rules' => 'required'),
        array('field' => 'email' , 'label' => '邮箱' , 'rules' => 'required'),
        array('field' => 'user_name' , 'label' => '用户名' , 'rules' => 'required'),
        array('field' => 'password' , 'label' => '密码' , 'rules' => 'required'),
        array('field' => 'name' , 'label' => '姓名' , 'rules' => 'required'),
//        array('field' => 'avatar' , 'label' => '头像' , 'rules' => 'required'),
//        array('field' => 'user_rank' , 'label' => '会员等级' , 'rules' => 'required'),
//        array('field' => 'phone' , 'label' => '电话' , 'rules' => 'required'),
//        array('field' => 'address' , 'label' => '地址' , 'rules' => 'required'),
//        array('field' => 'country_id' , 'label' => '国家' , 'rules' => 'required'),
//        array('field' => 'city_id' , 'label' => '城市' , 'rules' => 'required'),
//        array('field' => 'city' , 'label' => '城市' , 'rules' => 'required'),
//        array('field' => 'province_id' , 'label' => '省份' , 'rules' => 'required'),
//        array('field' => 'province' , 'label' => '省份' , 'rules' => 'required'),
//        array('field' => 'postcode' , 'label' => '邮编' , 'rules' => 'required'),
//        array('field' => 'qq' , 'label' => 'QQ' , 'rules' => 'required'),
//        array('field' => 'created' , 'label' => '创建日期' , 'rules' => 'required'),
//        array('field' => 'modified' , 'label' => '修改日期' , 'rules' => 'required'),
//        array('field' => 'status' , 'label' => '状态' , 'rules' => 'required'),
	);

	public function __construct(){
		parent::__construct();
		$this->_pk = 'user_id';
		$this->_attributes = array( 
				'user_id' => '',
				'store_id' => '',
				'email' => '',
				'user_name' => '',
				'password' => '',
				'name' => '',
				'avatar' => '',
				'user_rank' => '',
				'phone' => '',
				'address' => '',
				'country_id' => '',
				'city_id' => '',
				'city' => '',
				'province_id' => '',
				'province' => '',
				'postcode' => '',
				'qq' => '',
				'created' => '',
				'modified' => '',
				'status' => '',
		);
	}
	public function add_user($data){
		return $this->db->insert("user",$data);
	}
	public function update_info($arr,$id){
		$this->db->where(user_id,$id); //uid 数据库中自增id ，$id 控制器中传入id
		return $this->db->update("user",$arr);//表名字 传入数组
	}
	
   	 /*
     * 处理图片上传
     * 参数--
     * 上传图片的路径$filePath
     * 图片存储的字段名$storName
     * 图片原来的路径$oriPath
     */
    public function check_img($filePath,$storName,$config,$oriPath = null){
        //上传图片时，为避免重复命名，新建文件夹
        $nowFile = $filePath;
        //判断目录是否存在
        if (is_dir($nowFile)) {
            //存在则程序继续执行
        } else {
            //不存在则创建该目录
            mkdir($nowFile);
        }
        if(is_dir($nowFile.date('Ymd', time()))){
        	//存在则程序继续执行
        }else{
        	//不存在则创建该目录
        	mkdir($nowFile.date('Ymd', time()));
        }
        
        $config['upload_path'] = './uploads/users/' . date('Ymd', time()) . '/';
        $config['allowed_types'] = "gif|jpg|png|jpeg|bmp";
        $config['file_name'] = time();
        $config['max_size'] = '200000';
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($storName)) {
            //图片为非必须字段，这里就不抛出异常，程序继续执行
            throw new Exception($this->upload->display_errors());
        } else {
            $upload_data = $this->upload->data();
        }

        //添加时，$goods_data['photo']为空，那么图片的路径就是上传图片的路径
        //如果没有上传图片，那么保存到数据库的图片路径也为空
        if (!empty($_FILES[$storName]['name'])) {
            $data[$storName] = 'uploads/users/' . date('Ymd', time()) . '/' . $upload_data['file_name']; //图片路径
        } else {
            $data[$storName] = $oriPath; //为空时，默认使用原来的图片路径
        }
        return $data[$storName];
    }
    
}