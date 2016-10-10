<?php

class MY_Controller extends CI_Controller {

    public $layout = "layouts/main";
    public $_site_path;
    public $tablename;
    public $modelname;

    public function __construct() {
        //初始化加载类库
        $this->_init_property();
        $this->_site_path = config_item('site_path');
        date_default_timezone_set('PRC');
        parent::__construct();
        //判断用户是否已登陆

        if (!$this->auth->hasLogin()) {
            redirect($this->_site_path . '/login');
        }
        $this->auth->check();
        //获取当前表名
        $this->tablename = $this->get_tablename();
        //获取当前model名
        $this->modelname = $this->get_modelname();
//        if ($this->db->table_exists($this->tablename)) {
//            $this->load->model($this->modelname);
//        }
    }

    /**
     * 初始化加载类库
     */
    protected function _init_property() {
        foreach (is_loaded() as $var => $class) {
            $this->$var = null;
        }
        $this->load = null;
    }

    /**
     * 判断是否模型
     * @param type $name
     * @return boolean
     */
    protected function _is_model($name) {
        if (strpos($name, '_model') !== false) {
            return true;
        }
        return false;
    }

    /**
     * 自动加载类库（model、library）
     * @param type $name
     * @return type
     */
    public function __get($name) {
        if ($this->_is_model($name)) {
            $this->load->model($name);
            return $this->$name;
        } 
//        else {
//            $this->load->library($name);
//        }
//        return $this->$name;
    }

    /**
     * index 显示列表页
     * @param $recycle 1是正常状态，0是删除到回收站的状态
     * @author 刘军
     */
    public function index($recycle = 1) {

        $search['attributes'] = $this->input->get();
        if (isset($search['attributes']['operation_time']) && !empty($search['attributes']['operation_time'])) {
            $search['attributes']['operation_time_expertise'] = $search['attributes']['operation_time'];
            unset($search['attributes']['operation_time']);
        }
        // 获取当前model名
        $modelname = $this->modelname;
        $data['modelname'] = $modelname;
        //$search['orders'] = array('sort'=>'asc','id'=>'asc');
        //$search['attributes']['recycled']=$recycle;
        // 总数与分页
        $total = $this->$modelname->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url($this->_site_path . "/{$this->tablename}/index"),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array(
            'persize' => $per_page,
            'offset' => $this->pagination->get_cur_offset()
        );
        $data[$this->tablename . '_data'] = $this->$modelname->all($search);
        //if($recycle==1){
        $this->load->view($this->_site_path . "/{$this->tablename}/index", $data);
        //}
        //else{
        //	$this->load->view( $this->_site_path . "/{$this->tablename}/recycle", $data );
        //}
    }

    /**
     * add 添加
     * @author 刘军
     */
    public function add() {
        $this->do_operate();
    }

    /**
     * edit 编辑
     * @param $id 主键值
     * @author 刘军
     */
    public function edit($id) {
        $this->do_operate($id);
    }

    /**
     * do_operate 数据操作[增加 修改]
     * @param int $id 主键值
     * @author 刘军
     */
    protected function do_operate($id = 0) {
        $data = array();
        //定义变量，用于模板赋值
        $info_data = $this->tablename . '_data';
        //获取当前model名
        $modelname = $this->modelname;
        $data['modelname'] = $modelname;
        if ($this->input->post('is_submit')) {
            try {
                $post_data = $this->input->post();
                $data[$info_data] = $post_data;
                //设置验证规则
                $this->form_validation->set_rules($this->$modelname->_rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $post_data['modified'] = time();
                $post_data['operation_time'] = strtotime($post_data['operation_time']);
                //修改 edit
                if ($id) {
                    $this->$modelname->update_by_pk($post_data, $id);
                    $msg = '修改成功';
                    //添加 add
                } else {
                    $post_data['created'] = time();
                    //插入
                    $this->$modelname->insert($post_data);
                    $msg = '添加成功';
                }
                init_messagebox($msg, 'success', 1, base_url($this->_site_path . "/{$this->tablename}/index"));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        if ($id) {
            $data[$info_data] = $this->$modelname->get_by_pk($id);
        }
        $this->load->view($this->_site_path . "/{$this->tablename}/form", $data);
    }

    /**
     * view 显示详细页
     * @param $id 主键值
     * @author 刘军
     */
    public function view($id) {
        //获取当前model名
        $modelname = $this->modelname;
        $data['modelname'] = $modelname;
        //定义变量，用于模板赋值
        $info_data = $this->tablename . '_data';
        $data[$info_data] = $this->$modelname->get_by_pk($id);
        $this->load->view($this->_site_path . "/{$this->tablename}/view", $data);
    }

    /**
     * delete 删除
     * @param $id 主键值
     * @param array $field 直接删除字段
     * @parma $field_s 查找图片字段
     * @author 刘军
     */
    public function delete($id, $field, $field_s) {
        $modelname = $this->modelname;
        if ($field)
            $this->delUrlImg($id, $field);
        if ($field_s)
            $this->delFileImg($id, $field_s);
        $this->$modelname->delete_by_pk($id);
    }

    public function delUrlImg($id, $field) {
        $modelname = $this->modelname;
        $arr = $this->$modelname->get_by_pk($id);
        foreach ($field as $v) {
            if ($arr[$v])
                $arrImg[] = $arr[$v];
        }
        if (!empty($arrImg))
            $this->delImg($arrImg);
    }

    public function delFileImg($id, $field_s) {
        $modelname = $this->modelname;
        $arr = $this->$modelname->get_by_pk($id);
        if ($field_s) {
            preg_match_all('/<img(.*?)src=("|\'|\s)?(.*?)(?="|\'|\s)/', $arr[$field_s], $match);
            $match[3] = array_unique($match[3]);
            $match[3] = str_replace("php/../", "", $match[3]);
            $match[3] = str_replace("/demo_cms/", "", $match[3]);
            if (!empty($match[3]))
                $this->delImg($match[3]);
        }
    }

    public function delImg($arr) {
        foreach ($arr as $v) {
            unlink($v);
        }
    }

    /**
     * delete_all 批量删除
     * @param $id 主键值
     * @param array $field 直接删除字段
     * @parma $field_s 查找图片字段
     * @author 刘军
     */
    public function delete_all($field, $field_s) {

        //获取当前model名
        $modelname = $this->modelname;
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->delete($id, $field, $field_s);
        }
        redirect(base_url($this->_site_path . "/{$this->tablename}/index"));
    }

    /**
     * get_tablename 获取当前表名
     * @author 刘军
     */
    protected function get_tablename() {

        //获取由控制器名和方法名组成的数组
        $rsegments = $this->uri->rsegments;
        //获取当前控制器名字，既为当前表名
        return $rsegments[1];
    }

    /**
     * get_modelname 获取当前模型名
     * @author 刘军
     */
    protected function get_modelname() {

        return $this->tablename . '_model';
    }

    /**
     * recovery 从回收站恢复数据
     * @param $id 主键值
     * @author 莫斯树
     */
    public function recovery($id) {

        //获取当前model名
        $modelname = $this->modelname;
        $search['attributes'] = array('recycled' => 1);
        $this->$modelname->update_by_pk($search['attributes'], $id);
        redirect(base_url($this->_site_path . "/{$this->tablename}/index"));
    }

    /**
     * del_recycle 删除到回收站
     * @param $id 主键值
     * @author 莫斯树
     */
    public function del_recycle($id) {
        $this->recycle($id);
        redirect(base_url($this->_site_path . "/{$this->tablename}/index"));
    }

    /**
     * del_recycle_all 批量删除到回收站
     * @param $id 主键值
     * @author 莫斯树
     */
    public function del_recycle_all() {

        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->recycle($id);
        }
        redirect(base_url($this->_site_path . "/{$this->tablename}/index"));
    }

    //删除单条数据到回收站
    public function recycle($id) {
        //获取当前model名
        $modelname = $this->modelname;
        $search['attributes'] = array('recycled' => 0);
        $this->$modelname->update_by_pk($search['attributes'], $id);
    }

}

class Front_Controller extends CI_Controller {

    public $layout = "layouts/front";

    public function __construct() {

        date_default_timezone_set('PRC');
        parent::__construct();
        $this->load->library('page');
        //$this->load->model( 'user_model' );
    }

    /**
     * 用js报错
     * @param string $value 要输出的值
     */
    public function error_js($value) {
        header("Content-type:text/html;charset=utf-8");
        echo "<script>alert('" . $value . "');history.go(-1)</script>";
    }

    /**
     * js提示消息盒子
     * @param type $value  提示的值
     * @param type $url  跳转的路径
     */
    public function message_js($value, $url) {

        header("Content-type:text/html;charset=utf-8");
        echo "<script>alert('" . $value . "');window.location.href='" . $url . "';</script>";
    }

    public function is_login() {
        $user_id = $this->session->userdata('user_id');
        if (empty($user_id) || $user_id == 51) {
            redirect(base_url('sz_front/user/login'));
        }
    }

}

class Membr_Controller extends CI_Controller {

    public $layout = "layouts/member";

    public function __construct() {
        header("Content-type:text/html;charset=utf-8");
        date_default_timezone_set('PRC');
        parent::__construct();
        $this->load->model('unit_model');

        /** 加载验证库 */
        $this->load->library('front_auth');
        /** 检查登陆 */
        if (!$this->front_auth->hasLogin()) {
            alert("请先登录，谢谢!", base_url('front/index'));
            //redirect( 'front/login' );
        }
    }

    /**
     * 用js报错
     * @param string $value 要输出的值
     */
    public function error_js($value) {
        header("Content-type:text/html;charset=utf-8");
        echo "<script>alert('" . $value . "');history.go(-1)</script>";
    }

    /**
     * js提示消息盒子
     * @param type $value  提示的值
     * @param type $url  跳转的路径
     */
    public function message_js($value, $url) {
        header("Content-type:text/html;charset=utf-8");
        echo "<script>alert('" . $value . "');window.location.href='" . $url . "';</script>";
    }

    /**
     * js页面跳转
     * @param  string $url 跳转路径
     * @return null      
     */
    public function redirect_location($url) {
        header("Content-type:text/html;charset=utf-8");
        echo "<script>window.location.href='" . $url . "';</script>";
    }

}
