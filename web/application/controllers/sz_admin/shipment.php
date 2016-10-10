<?php

/**
 * shipment
 * @version 1.0
 * @package application
 * @subpackage application/controllers/shipment/
 */
class Shipment extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model("config_model");
        $this->load->model("shipment_model");
        $this->load->model("goods_model");
    }

    public function index($id) {
        $this->load->model("store_model");
        $this->load->model("goods_category_model");
        $this->load->model("supplier_model");
        $search['attributes'] = $this->input->get();
        $search['attributes']['goods_id'] = $id;
        // 总数与分页
        $total = $this->shipment_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/shipment/index"),
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
        $shipment = $this->shipment_model->all($search);
        $shipment_data = array();
        foreach ($shipment as $key => $value) {
            $shipment_data[$key] = $value;
            $num = $this->goods_model->get_value_by_pk($value['goods_id'], 'num');
            $shipment_data[$key]['num'] = $num;
        }
        $data['category_data'] = $this->goods_category_model->show_category($this->goods_category_model->all(), $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['shipment_data'] = $shipment_data;
        $this->load->view('sz_admin/shipment/index', $data);
    }

    public function add() {
        $data = array();
        $this->load->model("goods_category_model");
        $this->load->model("store_model");
        $this->load->model("brand_model");
        $this->load->model("supplier_model");
        $data['brand_data'] = $this->brand_model->get_appoint_values(array('brand_id', 'brand_name'));
        $data['goods_category_data'] = $this->goods_category_model->show_category($this->goods_category_model->all(), $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        if ($this->input->post('is_submit')) {
            try {
                $shipment_data = $this->input->post();
                //p($shipment_data);
                $shipment_data['created_time'] = $shipment_data['modified'] = time();
                $shipment_data['cat_id'] = $this->goods_model->get_value_by_pk($shipment_data['goods_id'], 'pid');
                $shipment_data['goods_name'] = $this->goods_model->get_value_by_pk($shipment_data['goods_id'], 'name');
                $data['shipment_data'] = $shipment_data;
                $rule_config = array(
                    //array('field' => 'cat_id', 'label' => '商品类型', 'rules' => 'required'),
                    array('field' => 'goods_id', 'label' => '商品名称', 'rules' => 'required'),
                    array('field' => 'amount', 'label' => '出库量', 'rules' => 'required'),
                    array('field' => 'person', 'label' => '出库人', 'rules' => 'required'),
                        //array('field' => 'supplier_id', 'label' => '供应商', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $shipment_id = $this->shipment_model->insert($data['shipment_data']);
                if ($shipment_id) {
                    $total = $this->goods_model->get_value_by_pk($shipment_data['goods_id'], 'num');
                    $num['num'] = $total - $shipment_data['amount'];
                    $this->goods_model->update_by_pk($num, $shipment_data['goods_id']);
                }
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods/index/up'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
            $this->load->view('sz_admin/shipment/form', $data);
    }

    public function view($id) {
        $this->load->model("admin_model");
        $this->load->model("shipment_model");
        $this->load->model("goods_category_model");
        $this->load->model("supplier_model");
        $data['shipment_data'] = $this->shipment_model->get_by_pk($id);
        $data['goods_data'] = $this->goods_model->get_by_pk($data['shipment_data']['goods_id']);
        $data['goods_data']['nodepath'] = $this->goods_category_model->get_value_by_pk($data['goods_data']['pid'], 'nodepath');
        $arr = explode(',', $data['goods_data']['nodepath']);
        $data['shipment_data']['bread'] = $this->goods_category_model->crumbs($arr, $type_name = 'cat_name');
        $this->load->view('sz_admin/shipment/view', $data);
    }

    public function edit($id) {
        $data = array();
        $this->load->model("goods_category_model");
        $this->load->model("store_model");
        $this->load->model("brand_model");
        $this->load->model("supplier_model");
        $data['shipment_data'] = $this->shipment_model->get_by_pk($id);
        $data['goods_data'] = $this->goods_model->all();
        $data['category_data'] = $this->goods_category_model->show_category($this->goods_category_model->all(), $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        $data['supplier_data'] = $this->supplier_model->all();
        if ($this->input->post('is_submit')) {
            try {
                $shipment_data = $this->input->post();
                $shipment_data['modified'] = time();
                $shipment_data['cat_id'] = $this->goods_model->get_value_by_pk($shipment_data['goods_id'], 'pid');
                $shipment_data['goods_name'] = $this->goods_model->get_value_by_pk($shipment_data['goods_id'], 'name');
                $data['shipment_data'] = $shipment_data;
                $rule_config = array(
                    array('field' => 'cat_id', 'label' => '商品类型', 'rules' => 'required'),
                    array('field' => 'goods_id', 'label' => '商品名称', 'rules' => 'required'),
                    //array('field' => 'supplier_id', 'label' => '供应商', 'rules' => 'required'),
                    array('field' => 'amount', 'label' => '出库量', 'rules' => 'required'),
                    array('field' => 'oper', 'label' => '出库人', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run())
                    throw new Exception(validation_errors(), 0);
                $this->shipment_model->update_by_pk($data['shipment_data'], $id);
                //$this->shipment_model->insert($data['shipment_data']);
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods/index/up'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/shipment/form', $data);
    }

    public function stock($id) {
        $shipment_data = $this->shipment_model->get_by_pk($id);
        //更新生产资料库存。。。
        $goods_data = $this->goods_model->get_by_pk($shipment_data['goods_id']);
        $goods_data['num'] = $goods_data['num'] + $shipment_data['amount'];
        $this->goods_model->update_by_pk($goods_data, $shipment_data['goods_id']);
        $shipment_data['status'] = 1;
        $this->shipment_model->update($shipment_data);
        redirect(base_url('sz_admin/shipment/index'));
    }

    public function search_goods() {
        $this->load->model("goods_model");
        $search['attributes'] = $this->input->post();
        $goods = $this->goods_model->all($search);
        $name = "<select name='goods_id' onclick=ajax_select_stock() class='x_inpt_border'>";
        $name.= "<option value='0'>---请选择---</option>";
        foreach ($goods as $v) {
            $name .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
        }
        $name.="</select>";
        echo $name;
    }

    public function get_goods_data() {
        $this->load->model("goods_model");
        $this->load->model("goods_category_model");
        $this->load->model("brand_model");
        $goods_id = $this->input->post('goods_id');
        $goods_data = $this->goods_model->get_by_pk($goods_id);
        $goods_data['goods_category'] = $this->goods_category_model->get_value_by_pk($goods_data['pid'], 'cat_name');
        $goods_data['brand'] = $this->brand_model->get_value_by_pk($goods_data['brand_id'], 'brand_name');
//        $str= "&nbsp;<label id='cun'>";
//        $str.=$goods_data['num'];
//        $str.= "</label>";
//        $str.=$this->config_model->get_value_by_pk($goods_data['item_unit'], 'value');
//        //$str = $goods_data['num'];
        //echo $goods_data;

        $json = json_encode($goods_data);
        echo $json;
    }

}
