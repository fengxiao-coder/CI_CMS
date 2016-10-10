<?php

/**
 * goods
 * @version 1.0
 * @package application
 * @subpackage application/controllers/brand/
 */
class Brand extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("brand_model");
    }

    public function index() {
        $search['attributes'] = $this->input->get();
        if (isset($search['attributes']['operation_time']) && !empty($search['attributes']['operation_time'])) {
            $search['attributes']['operation_time_expertise'] = $search['attributes']['operation_time'];
            unset($search['attributes']['operation_time']);
        }
        $total = $this->brand_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/brand/index"),
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
        $data['brand_data'] = $this->brand_model->all($search);
        $this->load->view('sz_admin/brand/index', $data);
    }

    /**
     * add 添加
     * @author hzf
     */
    public function add() {
        $this->load->model("goods_category_model");
        $this->load->model("brand_category_model");
        $data = array();
        $category = $this->goods_category_model->all();
        $data['goods_category_data'] = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['brand_category'] = $this->three_flow();
        if ($this->input->post('is_submit')) {
            try {
                $brand_data = $this->input->post();
                $data['brand_data'] = $brand_data;
                foreach ($brand_data['cat_id'] as $key => $value) {
                    $data['brand_data']['category'][$key]['cat_id'] = $value;
                }
                //设置验证规则
                $rule_config = array(
                    array('field' => 'brand_name', 'label' => '名称', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //图片上传
                // $filePath = $_SERVER['DOCUMENT_ROOT'] .'/'. APPNAME . '/uploads/';//上传路径
                $filePath = './uploads/'; //上传路径
                $storName = 'brand_logo'; //图片存储的字段名
                $brand_data[$storName] = $this->brand_model->check_upimg($filePath, $storName);
                if (!$brand_data[$storName])
                    throw new Exception("请选择品牌logo!");
                $source_image = $brand_data[$storName];
                $this->brand_model->resize($source_image);
                $data['brand_data'][$storName] = $brand_data[$storName];
                $data['brand_data']['created'] = time();
                $data['brand_data']['modified'] = time();
                unset($data['brand_data']['cat_id']);
                $brand_id = $this->brand_model->insert($data['brand_data']);
                if ($brand_id) {
                    foreach ($brand_data['cat_id'] as $value) {
                        $category['cat_id'] = $value;
                        $category['brand_id'] = $brand_id;
                        $this->brand_category_model->insert($category);
                    }
                }
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/brand/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }

        $this->load->view('sz_admin/brand/form', $data);
    }

    /**
     *   编辑 
     * @param $id 主键值
     * @author hzf
     */
    public function edit($id) {
        $this->load->model("goods_category_model");
        $this->load->model("brand_category_model");
        $data = array();
        $category = $this->goods_category_model->all();
        $data['goods_category_data'] = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['brand_category'] = $this->three_flow();
        $data['brand_data'] = $this->brand_model->get_by_pk($id);
        $data['brand_data']['category'] = $this->brand_category_model->all(array('attributes' => array('brand_id' => $id)));
        if ($this->input->post('is_submit')) {
            try {
                $brand_data = $this->input->post();
                //设置验证规则
                $rule_config = array(
                    array('field' => 'brand_name', 'label' => '名称', 'rules' => 'required'),
                    array('field' => 'site_url', 'label' => '网址', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $brand_data['modified'] = time();
                if (!$_FILES['brand_logo']['error']) {
                    //图片上传
                    $filePath = './uploads/'; //上传路径
                    $storName = 'brand_logo'; //图片存储的字段名
                    $oriPath = $brand_data[$storName]; //图片原来的路径
                    $brand_data[$storName] = $this->brand_model->check_upimg($filePath, $storName, $oriPath);
                    $source_image = $brand_data[$storName];
                    $this->brand_model->resize($source_image);
                    $data['brand_data'] = $brand_data;
                }
                //修改
                unset($data['brand_data']['cat_id']);
                $r = $this->brand_model->update_by_pk($brand_data, $id);
                if ($r) {
                    foreach ($data['brand_data']['category'] as $value) {
                        $sql = "DELETE FROM `brand_category` WHERE id = {$value['id']}";
                        $query = $this->db->query($sql);
                    }
                    foreach ($brand_data['cat_id'] as $value) {
                        $cat['cat_id'] = $value;
                        $cat['brand_id'] = $id;
                        $this->brand_category_model->insert($cat);
                    }
                }
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/brand/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }

        $this->load->view('sz_admin/brand/form', $data);
    }

    /**
     * view 显示详细页
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function view($id) {
        $data['brand_data'] = $this->brand_model->get_by_pk($id);
        $this->load->view('sz_admin/brand/view', $data);
    }

    public function deleted() {
        $field = array('brand_logo');
        $field_s = "brand_desc";
        $this->delete_all($field, $field_s);
    }

    public function all_delete() {
        $t = array();
        $this->load->model("goods_model");
        $ids = $this->input->post('ids');
        foreach ($ids as $v) {
            $t = $this->goods_model->all(array('attributes' => array('brand_id' => $v)));
        }
        if ($t) {
            $str = 1;
        } else {
            foreach ($ids as $value) {
                $this->brand_model->delete_by_pk($value);
            }
            $str = 2;
        }
        echo $str;
    }

    //获取分类的最后一层
    public function three_flow() {
        $search['attributes']['pid'] = 0;
        $goods_category = $this->goods_category_model->all($search);
        foreach ($goods_category as $key => $value) {
            $arr1['attributes']['pid'] = $value['nodepath'];
            $arr2[$key] = $this->goods_category_model->all($arr1); //取出第二层
        }
        foreach ($arr2 as $key => $value) {
            foreach ($value as $k => $val) {
                $arr[] = $val;
            }
        }
        foreach ($arr as $key => $value) {
            $arr3['attributes']['pid'] = $value['cat_id'];
            $arr4[$key] = $this->goods_category_model->all($arr3); //取出第三层
            if ($arr4[$key]) {
                $arr5[$key] = $arr4[$key];
            } else {
                $arr5[$key][] = $value;
            }
        }
        foreach ($arr5 as $key => $value) {
            foreach ($value as $k => $val) {
                $brank_category[] = $val;
            }
        }
        return $brank_category;
    }

}
