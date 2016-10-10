<?php
/**
 * 树操作类
 * @author 咸洪伟
 * @version 0.0
 * @package njsystem
 * @subpackage application/libraries
 */
class Tree
{
	private $_CI;
	function __construct() {
		$this->_CI =& get_instance();
	}
	
	/**
	 * 获得树的路径
	 * @param string $model 模型名称
	 * @param unknown_type $pid
	 */
    public function get_node_path($model,$pid){
    	if($pid==0){
    		return "0";
    	}else{
	    	$model=$model."_model";
	    	$this->_CI->load->model($model);
	    	$str=$this->_CI->$model->get_value_by_pk($pid,'nodepath');
	    	$str=$str.','.$pid;
	    	return $str;
    	}
    }
    /**
     * 获得树的深度
     * @param sting $model 模型名称
     * @param unknown_type $pid
     */
    public function get_depth($model,$pid){
    	if($pid==0){
    		return "0";
    	}else{
	    	$model=$model."_model";
	    	$this->_CI->load->model($model);
	    	$num=$this->_CI->$model->get_value_by_pk($pid,'depth');
	  		$num++;
	    	return $num;
    	}
    }

    /**
     * 获取树的树形的下拉列表数组
     * @param string $model 模型名称
     * @param int $m 点位符数量
     * @param string $pid 父级id
     * @param array field 字段名的数组
     */
    function dropdown_tree($model,$m=0,$pid=0,$field=array('id','sortname','parentid'))
    {	
	    $model=$model."_model";
	    $this->_CI->load->model($model);
	    $class_arr=$this->_CI->$model->all();
	    $return_arr=array();
	    $this->dropdown_array($m,$pid,$class_arr,$return_arr,$field);
	    return $return_arr;
    }

   /**
    * 遍历数组，修改其样式。
    */
    function dropdown_array($m,$pid,$class_arr,&$return_arr,$field){
	    $n = str_pad('',$m,'-',STR_PAD_RIGHT);
	    $n = str_replace("-","&nbsp;&nbsp;",$n);
	    foreach($class_arr as $item){
		    if($item["$field[2]"]==$pid){
			    $return_arr[$item["$field[0]"]]=$n."|--".$item["$field[1]"];
			    $this->dropdown_array($m+1,$item["$field[0]"],$class_arr,$return_arr,$field);
		    }
	    }
    }
}
