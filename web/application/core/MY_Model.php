<?php

/**
 * 继承CI_Model
 * @author 咸洪伟
 * @version 0.0
 * @package application
 * @subpackage application/core
 */
class MY_Model extends CI_Model
{

	protected $_attributes = array( ); // attribute name => ''
	private $_datas = array( ); // attribute name => attribute value
	protected $_pk;   //  primary key

	function __construct() {
		parent::__construct();
		
	}

	/**
	 * 一个标准的search数组在结构的如下
	 * array(
	 * 	'attributes'=>array(
	 * 		'name'=>'Jim',
	 * 		'phone'=>'13300000',
	 * 	),
	 * 	'in'=>array(
	 * 		'id'=>array('1','2','3'),
	 * 	);
	 * 	'orders'=>array(
	 * 		'id'=>'desc',
	 * 	)
	 * 	'limit'=>array(
	 * 		'persize'=>'10'
	 * 		'offset'=>'0'
	 * 	)
	 * )
	 */
	public function search( $search, &$query ) {
		foreach ( $search as $k => $v ) {

			// p($search);
			// exit();
			if ( $k == 'attributes' ) {
				$this->set_datas( $v, TRUE );
				$query->where( $this->get_datas() );
			} elseif ( $k == 'in' ) {
				foreach ( $v as $j => $u ) {
					$query->where_in( $j, $u );
				}
			} elseif ( $k == 'orders' ) {
				foreach ( $v as $j => $u ) {
					$query->order_by( $j, $u );
				}
			} elseif ( $k == 'limit' ) {
				$query->limit( $v['persize'], $v['offset'] );
			}
		}
	}

	/**
	 * 设置属性值
	 * @param array $attributes
	 * @param boolen $tag 如果为true则需要处理查询条件
	 * @return array
	 * @author 咸洪伟
	 */
	public function set_datas( $attributes, $tag = FALSE ) {
		if ( !$attributes ) return array( );
		$this->_datas = array( );
		if ( $tag ) {
			foreach ( $attributes as $key => $value ) {
				$temp_arr = explode( '_', $key );
				$count = count( $temp_arr );
				$search = '';
				if ( in_array( $temp_arr[$count - 1], array( 'like', 'greater', 'less', 'in', 'notequal', 'big', 'small', 'expertise' ) ) ) {
					$search = $temp_arr[$count - 1];
					unset( $temp_arr[$count - 1] );
					$key = implode( '_', $temp_arr );
				}
				if ( array_key_exists( $key, $this->_attributes ) && $value !== '' ) {
					if ( $search == 'like' ) {
						$key.=' like';
						$this->_datas[$key] = '%' . $value . '%';
					} elseif ( $search == 'greater' ) {
						$key.=' >=';
						$value = strtotime( $value );
						$this->_datas[$key] = $value;
					} elseif ( $search == 'less' ) {
						$key.=' <=';
						$value = strtotime( $value . " +1 day" );
						$this->_datas[$key] = $value;
					} elseif ( $search == 'notequal' ) {
						$key.=' <>';
						$this->_datas[$key] = $value;
					} elseif ( $search == 'big' ) {
						$key.=' >=';
						$this->_datas[$key] = $value;
					} elseif ( $search == 'small' ) {
						$key.=' <=';
						$this->_datas[$key] = $value;
					} elseif ( $search == 'expertise' ) {  //精准查询(2013-5-17日内的任何时间[指的是时分秒]可以查出)
						$key_one = $key;
						$key.=' >=';
						$value = strtotime( $value );
						$this->_datas[$key] = $value;
						$addtime = $value + 86400;
						$key_one.=' <';
						$this->_datas[$key_one] = $addtime;
					} else {
						$this->_datas[$key] = $value;
					}
				}
			}
		} else {
			foreach ( $attributes as $key => $value ) {
				if ( array_key_exists( $key, $this->_attributes )&& $value !== ''  ) {
					$this->_datas[$key] = $value;
				}
			}
		}
	}

	/**
	 * 获得属性值
	 * @return array
	 * @author 咸洪伟
	 */
	public function get_datas() {
		return $this->_datas;
	}

	/**
	 * 获得属性值
	 * @return array
	 * @author 咸洪伟
	 */
	public function get_datas_str() {
		foreach ( $this->_attributes as $key => $value ) {
			$arr[] = $key;
		}
		$str = implode( ',', $arr );
		return $str;
	}

	/**
	 * 获得表名
	 * @return string
	 * @author 咸洪伟
	 */
	public function table_name() {
		$table_name = get_class( $this );
		$table_name = str_replace( '_model', '', $table_name );
		$table_name = str_replace( '_Model', '', $table_name );
		return $table_name;
	}

	/**
	 * 获得主键的名称
	 * @return  string
	 * @author 咸洪伟
	 */
	public function primary_key() {
		return $this->_pk;
	}

	/**
	 * 插入数据库
	 * @param array $attributes
	 * @return int
	 * @author 咸洪伟
	 */
	public function insert( $attributes = null ) {
		$this->set_datas( $attributes );
		$this->db->insert( $this->table_name(), $this->get_datas() );
		return $this->db->insert_id();
	}


	/**
	 * 更新数据库($attributes中存在主键的key=>value)
	 * @param array $attributes
	 * @return bool
	 * @author 咸洪伟
	 */
	public function update( $attributes = null ) {
		$pk = $attributes[$this->primary_key()];
		$this->update_by_pk( $attributes, $pk );
	}

	/**
	 * 通过主键更新数据
	 * @param array $attributes
	 * @param int $pk
	 * @return bool
	 * @author 咸洪伟
	 */
	public function update_by_pk( $attributes = null, $pk ) {
		$this->set_datas( $attributes );
		$tag = $this->db
				->where( $this->primary_key(), $pk )
				->update( $this->table_name(), $this->get_datas() );
		return $tag;
	}

	/**
	 * 通过条件更新数据
	 * @param array $attributes 更新的属性
	 * @param array $search 更新条件
	 * @return bool
	 * @author 咸洪伟
	 */
	public function update_by_attributes( $attributes = null, $search = null ) {
		$this->set_datas( $attributes );
		$tag = $this->db
				->where( $search )
				->update( $this->table_name(), $this->get_datas() );
		return $tag;
	}

	/**
	 * 通过主键删除数据
	 * @param int $pk
	 * @return bool
	 * @author 咸洪伟
	 */
	public function delete_by_pk( $pk ) {
		return $this->db->delete( $this->table_name(), array( $this->primary_key() => $pk ) );
	}

	/**
	 * 根据自己的需求删除数据
	 * @attributes 属性值的键值对
	 * @return type
	 * @author 咸洪伟
	 */
	public function delete_by_attributes( $attributes = null ,$flag=false) {
		$this->set_datas( $attributes ,$flag);
		return $this->db->delete( $this->table_name(), $this->get_datas() );
	}

	/**
	 * 通过主键获得数据
	 * @param int $pk
	 * @return array
	 * @author 咸洪伟
	 */
	public function get_by_pk( $pk ) {
		$query = $this->db->select( $this->get_datas_str() )->from( $this->table_name() )
				->where( $this->primary_key(), $pk );
		return $query->get()->row_array();
	}

	/**
	 * 通过属性获取数据
	 * @param  array $attributes 属性的键值对
	 * @return array
	 */
	public function get_by_attributes($attributes = null)
	{
		$query=$this->db->select($this->get_datas_str())->from($this->table_name());
		if($attributes)
		{
			$this->set_datas($attributes,TRUE);
			$query->where($this->get_datas());
		}
		return $query->get()->row_array();
	}

	/**
	 * 通过获得limit行数据按主键降序
	 * @param int $limit 每页显示条数
	 * @param int $offset 游标
	 * @param array $attributes  属性值列表
	 * @return array
	 * @author 咸洪伟
	 */
	public function all( $search = null ) {
		$query = $this->db->select( $this->get_datas_str() )->from( $this->table_name() );
		if ( $search ) {
			$this->search( $search, $query );
		}
		return $query->get()->result_array();
	}


	/**
	 * 获得总数
	 * @param array $attributes  属性值列表
	 * @return int 总数
	 * @author 咸洪伟
	 */
	public function total( $attributes = null, $search = null, $in = null ) {
		$query = $this->db->from( $this->table_name() );
		if ( $attributes ) {
			$this->set_datas( $attributes, TRUE );
			$query->where( $this->get_datas() );
		}
		if ( $search ) {
			$this->search( $search, $query );
		}
		if ( $in ) {
			foreach ( $in as $key => $value ) {
				$query->where_in( $key, $value );
			}
		}
		return $query->count_all_results();
	}


	/**
	 * 通过主键获得指定字段的值
	 * @param int $pk 主键值
	 * @param string $field_name 指定字段名称
	 * @return string
	 * @author 咸洪伟
	 */
	public function get_value_by_pk( $pk, $field_name ) {
		$query = $this->db->select( $field_name )->from( $this->table_name() )
				->where( $this->primary_key(), $pk );
		$arr = $query->get()->row_array();
		if ( $arr ) {
			return $arr[$field_name];
		}
		return FALSE;
	}
	
	/**
	 * 通过非主键获得指定字段的值
	 * @param int $pk 主键值
	 * @param string $field_name 指定字段名称
	 * @return string
	 * @author 刘军
	 */
	public function get_value_by_notpk( $field_name=null, $attributes = null ) {
		$query = $this->db->select( $this->get_datas_str() )->from( $this->table_name() );
		if ( $attributes ) {
			$this->set_datas( $attributes, TRUE );
			$query->where( $this->get_datas() );
		}
		$arr = $query->get()->row_array();
		if(!$arr) return false;
		return $field_name ? $arr[$field_name] : $arr;
	}

	/**
	 * 获得指定字段组成的键值对数组
	 * @param array $value_field 字段名称构成的数组
	 * @param array $attributes 查询条件
	 * @param array $search 搜索条件
	 * @author 刘军
	 */
	public function get_appoint_values($value_field, $attributes = null, $search = null ) {
		if(!is_array($value_field)) return false;
		$fields = implode(',', $value_field);
		$rearr = array( );
		$query = $this->db->select( "$fields" )->from( $this->table_name() );
		if ( $attributes ) {
			$this->set_datas( $attributes, TRUE );
			$query->where( $this->get_datas() );
		}
		if ( $search ) {
			$this->search( $search, $query );
		}
		$arr = $query->get()->result_array();
		if ( $arr) {
			return $arr;
		}
		return false;
	}
	
	/**
	 * 获得指定字段组成的数组
	 * @param string $key_field 键的名称
	 * @param string $value_field 值的名称
	 * @param array $attributes 查询条件
	 * @author 咸洪伟
	 */
	public function get_values( $key_field, $value_field, $attributes = null, $search = null ) {
		$rearr = array( );
		$query = $this->db->select( "$key_field,$value_field" )->from( $this->table_name() );
		if ( $attributes ) {
			$this->set_datas( $attributes, TRUE );
			$query->where( $this->get_datas() );
		}
		if ( $search ) {
			$this->search( $search, $query );
		}
		$arr = $query->get()->result_array();
		foreach ( $arr as $value ) {
			$rearr[$value[$key_field]] = $value[$value_field];
		}
		return $rearr;
	}
        /*
     * 处理图片上传
     * 参数--
     * 上传图片的路径$filePath
     * 图片存储的字段名$storName
     * 图片原来的路径$oriPath
     */
    public function check_upimg($filePath,$storName,$config,$oriPath = null){
        //上传图片时，为避免重复命名，新建文件夹
        $nowFile = $filePath;
        //判断目录是否存在
        if (is_dir($nowFile . date('Ymd', time()))) {
            //存在则程序继续执行
        } else {
            //不存在则创建该目录
            mkdir($nowFile . date('Ymd', time()));
        }
        $config['upload_path'] = './uploads/' . date('Ymd', time()) . '/';
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
            $goods_data[$storName] = 'uploads/' . date('Ymd', time()) . '/' . $upload_data['file_name']; //图片路径
        } else {
            $goods_data[$storName] = $oriPath; //为空时，默认使用原来的图片路径
        }
        return $goods_data[$storName];
    }
    
    /**
	 * 分类显示
	 * @param array $data  传入的数组
	 * @param string $id_name  ID字段名称
	 * @param string $pid_name  父ID字段名称
	 * @param string $type_name  种类字段名称
	 * @param string $splite  分隔符
	 * @param string $pid_value  父ID值
	 * @param string $level  分隔符数
	 * @author 刘军
	 */
	private $tree = array();
	public function show_category($data, $id_name='id', $pid_name='pid', $type_name='type_name', $splite='　', $pid_value=0, $level=0) {
		
		if(!$data || !is_array($data)) return false;
		foreach ($data as $key => $value){
			if($value[$pid_name] == $pid_value){
				$row[$id_name] = $value[$id_name];
				$row[$type_name] = str_repeat($splite, $level) . $value[$type_name];
				$this->tree[] = $row;
				unset($data[$key]);
				$this->show_category($data, $id_name, $pid_name, $type_name, $splite, $value[$id_name], $level+1);
			}
		}
		return $this->tree;
	}
	
	/**
	 * 分类序列化
	 * @param array $arr  传入的数组
	 * @param string $type_name  传入的字段名称
	 * @param string $id_name  ID字段名称
	 * @author 刘军
	 */
	public function category_init($arr, $id_name='id', $type_name='type_name'){
		
		$options = array();
		foreach ($arr as $value){
			$options[$value[$id_name]] = $value[$type_name];
		}
		unset($arr); return $options;
	}
	
	/**
	 * 分类序列化显示
	 * @param array $fields 字段名称构成的数组
	 * @param array $attributes 查询条件
	 * @param array $search 搜索条件
	 * @param string $id_name  ID字段名称
	 * @param string $pid_name  父ID字段名称
	 * @param string $type_name  种类字段名称
	 * @param string $splite  分隔符
	 * @param string $pid_value  父ID值
	 * @param string $level  分隔符数
	 * @author 刘军
	 */
	public function show_init_category($fields, $attributes=null, $search=null, $id_name='id', $pid_name='pid', $type_name='type_name', $splite='　', $pid_value=0, $level=0){
		
		if(!$fields || !is_array($fields)) return false;
		$arr = $this->get_appoint_values($fields, $attributes, $search);
		$trees =$this->show_category($arr, $id_name, $pid_name, $type_name, $splite, $pid_value, $level);
		$options = $this->category_init($trees, $id_name, $type_name);
		unset($arr, $trees); return $options;
	}

	/**
	 * 查找子孙树
	 * @param array $arr 被操作数组
	 * @param string $k  ID字段名称
	 * @param string $pk  父ID字段名称
	 * @param int $id  要查找的id值
	 * @param int $level  级别
	 * @author hzf
	 */
	public function subTree($arr,$k='id',$pk='parent',$id=0,$lev=1) { 
	    $sons = array(); 
	    foreach($arr as $v) { 
	        if($v[$pk] == $id) { 
	        	$v['lev']=$lev;
	            $sons[] = $v; 
	            $sons=array_merge($sons,$this->subTree($arr,$k,$pk,$v[$k],$lev+1));
	        } 
	    } 
	    return $sons; 
	} 

	/**
	 * 查找家谱树
	 * @param array $arr 被操作数组
	 * @param string $k  ID字段名称
	 * @param string $pk  父ID字段名称
	 * @param int $id  要查找的id值
	 * @param int $level  级别
	 * @author hzf
	 */
	public function familytree($arr,$id,$k='id',$pk='parent',$lev=1) { 
	    $tree = array(); 
	     
	    foreach($arr as $v) { 
	        if($v[$k] == $id) { 
	            if($v[$pk] > 0) { 
	                $tree = array_merge($tree,$this->familytree($arr,$v[$pk])); 
	            } 
	            $tree[] = $v; 
	        } 
	    } 
	    return $tree; 
	} 

	/**
	 * 获取面包屑
	 * @param array $arr 被操作数组
	 * @param string $type_name  键名称
	 * @author hzf
	 */
    public function crumbs($arr,$type_name){
            $bread='';
            foreach ($arr as $v) {
                    $cate=$this->get_by_pk($v);
                    $bread.=$cate[$type_name].'>';
            }
            return rtrim($bread,'>');
    }	

}

