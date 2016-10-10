<?php

/**
 * goods_type
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods_type/
 */
class Goods_type extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("goods_type_model");
        $this->load->model("goods_attribute_model");
    }

    public function index() {
        $this->load->model("goods_category_model");
        $search['attributes'] = $this->input->get();
        // 总数与分页
        $total = $this->goods_type_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/goods_type/index"),
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
        $data['goods_type_data'] = $this->goods_type_model->all($search);
        $this->load->view('sz_admin/goods_type/index', $data);
    }

    /**
     * view 显示详细页
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function view($id) {
        $where['attributes'] = array('type_id' => $id);
        $data['goods_type_data'] = $this->goods_type_model->get_by_pk($id);
        $data['goods_attribute_data'] = $this->goods_attribute_model->all($where);
        $this->load->view('sz_admin/goods_type/view', $data);
    }

    /**
     * add 添加
     * @author 咸洪伟
     */
    public function add() {
        $data = array();
        $this->load->model("goods_category_model");
        $search['attributes'] = array('pid' => 0);
        $data['goods_category_data'] = $this->goods_category_model->all($search);
        $id = $this->input->post('type_name');
        $goods_type = $this->goods_type_model->get_by_attributes(array('type_name' => $id));
        if (!$goods_type) {
            if ($this->input->post('is_submit')) {
                try {

                    $goods_type_data = $this->input->post();
                    $data['goods_type_data'] = $goods_type_data;
                    //设置验证规则
                    $rule_config = array(
                        array('field' => 'type_name', 'label' => '名称', 'rules' => 'required'),
                    );
                    $this->form_validation->set_rules($rule_config);
                    if (!$this->form_validation->run())
                        throw new Exception(validation_errors(), 0);
                    //插入
                    $goods_type_id = $this->goods_type_model->insert($goods_type_data);
                    init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods_type/index'));
                } catch (Exception $e) {
                    init_messagebox($e->getMessage(), 'error', $e->getCode());
                }
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("已添加");
                //window.history.back();
            </script>
            <?php
        }


        $this->load->view('sz_admin/goods_type/form', $data);
    }

    /**
     *   编辑 
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function edit($id) {
        $this->load->model("goods_category_model");
        $data = array();
        $search['attributes'] = array('pid' => 0);
        $data['goods_category_data'] = $this->goods_category_model->all($search);
        $data['goods_type_data'] = $this->goods_type_model->get_by_pk($id);
        if ($this->input->post('is_submit')) {
            try {
                $goods_type_data = $this->input->post();
                $data['goods_type_data'] = $goods_type_data;
                //设置验证规则
                $rule_config = array(
                    array('field' => 'type_name', 'label' => '名称', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                //修改
                p($goods_type_data);
                $this->goods_type_model->update_by_pk($goods_type_data, $id);
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/goods_type/index'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }

        $this->load->view('sz_admin/goods_type/form', $data);
    }

}
