<?php

/**
 * purchase
 * @version 1.0
 * @package application
 * @subpackage application/controllers/purchase/
 */
class Purchase extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("purchase_model");
        $this->load->model("goods_model");
        $this->load->model('config_model');
    }

    public function index($id) {
        $this->load->model("goods_category_model");
        $this->load->model("store_model");
        $this->load->model("brand_model");
        $this->load->model("supplier_model");
        $search['attributes'] = $this->input->get();
        $search['attributes']['goods_id'] = $id;
        //$search['attributes']['status'] = 0;
        // 总数与分页
        $total = $this->purchase_model->total(null, $search);
        $data['total'] = $total;
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/purchase/index"),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array(
            'persize' => $per_page,
            'offset' => $this->pagination->get_cur_offset(),
            'orders' => array('id' => 'desc')
        );
        $data['category_data'] = $this->goods_category_model->show_category($this->goods_category_model->all(), $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['supplier_data'] = $this->supplier_model->all();
        $data['purchase'] = $this->purchase_model->all($search);
        $this->load->view('sz_admin/purchase/index', $data);
    }

    public function add($id) {
        $this->load->model("goods_category_model");
        $this->load->model("store_model");
        $this->load->model("brand_model");
        $this->load->model("supplier_model");
        $data = array();
        $data['brand_data'] = $this->brand_model->get_appoint_values(array('brand_id', 'brand_name'));
        $category = $this->goods_category_model->all();
        $data['goods_category_data'] = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['purchase_data']['id'] = $id;
        $data['goods_data'] = $this->goods_model->get_by_pk($id);
        $data['purchase_data']['cat_id'] = $data['goods_data']['pid'];
        $data['purchase_data']['goods_id'] = $data['goods_data']['id'];
        //表单提交
        if ($this->input->post('is_submit')) {
            try {
                $purchase_data = $this->input->post();
                $purchase_data['created_time'] = $purchase_data['modified'] = time();
                $purchase_data['goods_name'] = $this->goods_model->get_value_by_pk($purchase_data['goods_id'], 'name');
                $purchase_data['cat_id'] = $this->goods_model->get_value_by_pk($purchase_data['goods_id'], 'pid');
                $purchase_data['brand_id'] = $this->goods_model->get_value_by_pk($purchase_data['goods_id'], 'brand_id');
                $data['purchase_data'] = $purchase_data;
                $rule_config = array(
                    array('field' => 'item_unit', 'label' => '数量单位', 'rules' => 'required'),
                    array('field' => 'coin_unit', 'label' => '货币单位', 'rules' => 'required'),
                    array('field' => 'goods_id', 'label' => '商品名称', 'rules' => 'required'),
                    array('field' => 'supplier_id', 'label' => '供应商', 'rules' => 'required'),
                    array('field' => 'amount', 'label' => '采购量', 'rules' => 'required'),
                    array('field' => 'price', 'label' => '采购价', 'rules' => 'required'),
                    array('field' => 'person', 'label' => '采购人', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run()) {
                    throw new Exception(validation_errors(), 0);
                }
                $purchase_id = $this->purchase_model->insert($data['purchase_data']);
                if ($purchase_id) {
                    $goods['item_unit'] = $data['purchase_data']['item_unit'];
                    $this->goods_model->update_by_pk($goods, $data['purchase_data']['goods_id']);
                }
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods/index/get'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/purchase/form', $data);
    }

    public function view($id) {
        $this->load->model("purchase_model");
        $this->load->model("store_model");
        $this->load->model("goods_category_model");
        $this->load->model("supplier_model");
        $data['purchase_data'] = $this->purchase_model->get_by_pk($id);
        $data['goods_data'] = $this->goods_model->get_by_pk($data['purchase_data']['goods_id']);
        $data['goods_data']['nodepath'] = $this->goods_category_model->get_value_by_pk($data['goods_data']['pid'], 'nodepath');
        $arr = explode(',', $data['goods_data']['nodepath']);
        $data['purchase_data']['bread'] = $this->goods_category_model->crumbs($arr, $type_name = 'cat_name');
        $this->load->view('sz_admin/purchase/view', $data);
    }

    public function edit($id) {
        $data = array();
        $this->load->model("goods_category_model");
        $this->load->model("store_model");
        $this->load->model("brand_model");
        $this->load->model("supplier_model");
        $data['purchase_data']['goods_id'] = $id;
        $data['purchase_data'] = $this->purchase_model->get_by_pk($id);
        $category = $this->goods_category_model->all();
        $data['goods_category_data'] = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['brand_data'] = $this->brand_model->get_appoint_values(array('brand_id', 'brand_name'));
        if ($this->input->post('is_submit')) {
            try {
                $purchase_data = $this->input->post();
                $purchase_data['created_time'] = $purchase_data['modified'] = time();
                $purchase_data['goods_name'] = $this->goods_model->get_value_by_pk($purchase_data['goods_id'], 'name');
                $data['purchase_data'] = $purchase_data;
                $rule_config = array(
                    array('field' => 'item_unit', 'label' => '数量单位', 'rules' => 'required'),
                    array('field' => 'coin_unit', 'label' => '货币单位', 'rules' => 'required'),
                    array('field' => 'goods_id', 'label' => '商品名称', 'rules' => 'required'),
                    array('field' => 'supplier_id', 'label' => '供应商', 'rules' => 'required'),
                    array('field' => 'amount', 'label' => '采购量', 'rules' => 'required'),
                    array('field' => 'price', 'label' => '采购价', 'rules' => 'required'),
                    array('field' => 'buyer_id', 'label' => '入库人', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $purchase_id = $this->purchase_model->update_by_pk($data['purchase_data'], $id);
                if ($purchase_id) {
                    $goods['item_unit'] = $data['purchase_data']['item_unit'];
                    $this->goods_model->update_by_pk($goods, $data['purchase_data']['goods_id']);
                }
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods/index/get'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/purchase/form', $data);
    }

    public function delete_all() {
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->purchase_model->delete_by_pk($id);
        }
        redirect(base_url($this->_site_path . "/goods/index/get"));
    }

    public function stock() {
        $ids = $this->input->get("ids");
        foreach ($ids as $key => $value) {
            $data['purchase_data'][$key] = $this->purchase_model->get_by_pk($value);
        }
        $this->load->view('sz_admin/purchase/stock', $data);
    }

    public function ruku() {
        if ($this->input->post('is_submit')) {
            try {
                $purchase = $this->input->post();
                foreach ($purchase as $k => $v) {
                    foreach ($v as $key => $val) {
                        $res[$key][$k] = $val;
                        $res[$key]['ru_time'] = $purchase['ru_time'][0];
                    }
                }
                foreach ($res as $key => $value) {
                    $purchase_data = $this->purchase_model->get_by_pk($value['id']);
                    $goods_data = $this->goods_model->get_by_pk($purchase_data['goods_id']);
                    $goods_data['num'] = $goods_data['num'] + $value['amount'];
                    $goods_data['item_unit'] = $purchase_data['item_unit'];
                    $this->goods_model->update_by_pk($goods_data, $purchase_data['goods_id']);
                    $purchasedata['amount'] = $purchase_data['amount'] - $value['amount'];
                    $this->purchase_model->update_by_pk($purchasedata, $purchase_data['id']);
                    if ($purchasedata['amount'] == 0) {
                        $this->purchase_model->delete_by_pk($purchase_data['id']);
                    }
                    $ru[$key] = $purchase_data;
                    $ru[$key]['ru_person'] = $value['ru_person'];
                    $ru[$key]['ru_time'] = strtotime($value['ru_time']);
                    $ru[$key]['amount'] = $value['amount'];
                    $ru[$key]['remark'] = $value['remark'];
                    $ru[$key]['status'] = 1;
                    $ru[$key]['created_time'] = $ru[$key]['modified'] = time();
                    unset($ru[$key]['id']);
                }
                //p($ru);
                foreach ($ru as $key => $value) {
                    $this->purchase_model->insert($value);
                }
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods/index/get'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        redirect(base_url($this->_site_path . "/goods/index/get"));
    }

    public function search_goods() {
        $search['attributes'] = $this->input->post();
        $goods = $this->goods_model->all($search);
        foreach ($goods as $v) {
            $name .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
        }
        echo $name;
    }

    public function select_goods() {
        $goods_id = $this->input->post("goods_id");
        $name = $this->goods_model->get_value_by_pk($goods_id[0], 'name');
        echo $name;
    }

    public function search_brand() {
        $this->load->model("brand_model");
        if ($this->input->post('id')) {
            $search['attributes']['cid'] = $this->input->post('id');
        } else {
            $search['attributes']['brand_id'] = $this->input->post('brand_id');
        }
        $brand = $this->brand_model->all($search);
        if ($this->input->post('id')) {
            $name = "<option value=''>---请选择---</option>";
        }
        foreach ($brand as $v) {
            $name .= '<option value="' . $v['brand_id'] . '">' . $v['brand_name'] . '</option>';
        }
        echo $name;
    }

    public function search_category() {
        $this->load->model("goods_category_model");
        $search['attributes']['cat_id'] = $this->input->post('cat_id');
        $goods_catagory = $this->goods_category_model->all($search);
        foreach ($goods_catagory as $v) {
            $name .= '<option value="' . $v['cat_id'] . '">' . $v['cat_name'] . '</option>';
        }
        $category = $this->goods_category_model->all();
        $goods_category = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        foreach ($goods_category as $val) {
            $name .= '<option value="' . $val['cat_id'] . '">' . $val['cat_name'] . '</option>';
        }
        echo $name;
    }

}
