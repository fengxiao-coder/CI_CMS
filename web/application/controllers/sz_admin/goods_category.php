<?php

/**
 * goods_category
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_category/
 */
class goods_category extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("goods_category_model");
    }

    public function index() {
        $search['attributes'] = $this->input->get();
        if (isset($search['attributes']['operation_time']) && !empty($search['attributes']['operation_time'])) {
            $search['attributes']['operation_time_expertise'] = $search['attributes']['operation_time'];
            unset($search['attributes']['operation_time']);
        }
        // 总数与分页
        $total = $this->goods_category_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/goods_category/index"),
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
        $search['orders'] = array(
            'sort' => ''
        );
        $arr = $this->goods_category_model->all($search);
        if (empty($search['attributes']['cat_name_like'])) {
            $data['goods_category_data'] = $this->goods_category_model->subTree($arr, $k = 'cat_id', $pk = 'pid', $id = 0, $lev = 0);
        } else {
            $data['goods_category_data'] = $arr;
        }
        $this->load->view('sz_admin/goods_category/index', $data);
    }

    /**
     * view 显示详细页
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function view($id) {
        $data['goods_category'] = $this->goods_category_model->all();
        $data['goods_category_data'] = $this->goods_category_model->get_by_pk($id);
        $this->load->view('sz_admin/goods_category/view', $data);
    }

    /**
     * add 添加
     * @author 咸洪伟
     */
    public function add() {
        $this->load->model("goods_model");
        $data = array();
        $category = $this->goods_category_model->all();
        $data['category_data'] = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        if ($this->input->post('is_submit')) {
            try {
                $goods_category = $this->input->post();
                $goods_category['created'] = time();
                $goods_category['modified'] = time();
                $data['goods_category'] = $goods_category;
                $filePath = './uploads/'; //上传路径
                $storName = 'photo'; //图片存储的字段名
                $data['goods_category'][$storName] = $this->goods_category_model->check_upimg($filePath, $storName);
                if (!$data['goods_category'][$storName])
                    throw new Exception("请选择品牌logo!");
                //设置验证规则
                $rule_config = array(
                    array('field' => 'cat_name', 'label' => '名称', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //插入
                $id = $this->goods_category_model->insert($data['goods_category']);
                $pc_data = $this->goods_category_model->get_by_pk($data['goods_category']['pid']);
                if ($pc_data) {
                    $nodepath = $pc_data['nodepath'] . ',' . $id;
                    $data['goods_category']['nodepath'] = ltrim($nodepath, ',');
                } else {
                    $data['goods_category']['nodepath'] = $id;
                }
                $this->goods_category_model->update_by_pk($data['goods_category'], $id);

                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods_category/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods_category/form', $data);
    }

    /**
     *   编辑 
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function edit($id) {
        $data = array();
        $category = $this->goods_category_model->all();
        $data['category_data'] = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['goods_category'] = $this->goods_category_model->get_by_pk($id);
        if ($this->input->post('is_submit')) {
            try {
                $goods_category = $this->input->post();
                $rule_config = array(
                    array('field' => 'cat_name', 'label' => '名称', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $goods_category['modified'] = time();
                if (!$_FILES['photo']['error']) {
                    //图片上传
                    $filePath = './uploads/'; //上传路径
                    $storName = 'photo'; //图片存储的字段名
                    $oriPath = $goods_category[$storName]; //图片原来的路径
                    $goods_category[$storName] = $this->goods_category_model->check_upimg($filePath, $storName, $oriPath);
                    $source_image = $goods_category[$storName];
                    $this->goods_category_model->resize($source_image);
                }
                $pc_data = $this->goods_category_model->get_by_pk($goods_category['pid']);
                if ($pc_data) {
                    $nodepath = $pc_data['nodepath'] . ',' . $id;
                    $goods_category['nodepath'] = ltrim($nodepath, ',');
                } else {
                    $goods_category['nodepath'] = $id;
                }
                $data['goods_category'] = $goods_category;
                $this->goods_category_model->update_by_pk($data['goods_category'], $id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/goods_category/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }

        $this->load->view('sz_admin/goods_category/form', $data);
    }

    public function ajax_get_tree() {
        $id = $_GET['id'] + 0;
        $pid = $_GET['pid'] + 0;

        $category = $this->goods_category_model->all();
        $arr = $this->goods_category_model->subTree($category, $k = 'cat_id', $pk = 'pid', $id, $lev = 1);
        $ids[0] = $id;
        foreach ($arr as $v) {
            array_push($ids, $v['cat_id']);
        }
        if (in_array($pid, $ids)) {
            return false;
        } else {
            echo 'ok';
        }
    }

    public function ajax_select_category() {
        $type_id = $this->input->post('type_id');
        $string = $this->goods_category_model->get_value_by_pk($type_id, 'nodepath');
        $nodepath = \explode(",", $string);
        $t = count($nodepath);
        echo $t;
    }

    public function all_delete() {
        $t = array();
        $this->load->model("goods_model");
        $ids = $this->input->post('ids');
        foreach ($ids as $v) {
            $t = $this->goods_model->all(array('attributes' => array('pid' => $v)));
        }
        if ($t) {
            $str = 1;
        } else {
            foreach ($ids as $value) {
                $this->goods_category_model->delete_by_pk($value);
            }
            $str = 2;
        }
        echo $str;
    }

}
