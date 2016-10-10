<?php

/**
 * goods
 * @version 1.0
 * @package application
 * @subpackage application/controllers/goods/
 */
class Goods extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("goods_model");
        $this->load->model('config_model');
        $this->load->model("goods_category_model");
        $this->load->model("brand_model");
        $this->load->model("stock_model");
        $this->load->model("goods_attr_model");
    }

    public function index($flag = 'up') {
        $this->load->model("purchase_model");
        $this->load->model("goods_evaluation_model");
        $this->load->model("store_model");
        $data['goods_category'] = $this->goods_category_model->get_goods_category_options();
        $data['brand_name'] = $this->brand_model->get_appoint_values(array('brand_id', 'brand_name'));
        $search['attributes'] = $this->input->get();
        $data['current_type'] = $flag;
        if ($flag == "up") {
            //已上架       	
            $search['attributes']["status"] = 0;
            $search['orders'] = array(
                'modified' => 'desc',
                'id' => 'desc'
            );
            $total = $this->goods_model->total(null, $search);
        } elseif ($flag == "down") {
            //已下架
            $search['attributes']["status"] = 1;
            $search['orders'] = array(
                'id' => 'desc'
            );
            $total = $this->goods_model->total(null, $search);
        } elseif ($flag == "remind") {
            //库存告急
            $search['attributes']["status"] = 0;
            $search['attributes']["num_small"] = 10;
            $search['orders'] = array(
                'num' => 'asc'
            );
            $total = $this->goods_model->total(null, $search);
        } elseif ($flag == "get") {
            //已采购
            if ($search['attributes']['pid']) {
                $search['attributes']['cat_id'] = $search['attributes']['pid'];
                unset($search['attributes']['pid']);
            }
            $search['attributes']['goods_name_like'] = $search['attributes']['name_like'];
            unset($search['attributes']['name_like']);
            $search['attributes']["status"] = 0;
            $search['orders'] = array(
                'status' => 'asc',
                'created_time' => 'desc',
                'id' => 'desc',
            );
            $total = $this->purchase_model->total(null, $search);
        } elseif ($flag == "hot") {
            //热卖
            $search['attributes']["status"] = 0;
            $search['orders'] = array(
                'sales' => 'desc'
            );
            $total = $this->goods_model->total(null, $search);
        } elseif ($flag == "special") {
            //特价
            $search['attributes']["is_special"] = 1;
            $search['orders'] = array(
                'id' => 'desc'
            );
            $total = $this->goods_model->total(null, $search);
        }
        // 总数与分页
        $data['total'] = $total;
        //$per_page = config_item('per_page');
        $per_page = 15;
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url('sz_admin/goods/index/' . $flag . '?&'),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
            'page_query_string' => TRUE,
            'enable_query_strings' => TRUE,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array(
            'persize' => $per_page,
            'offset' => $this->pagination->get_cur_offset()
        );
        if ($flag == "get") {
            $this->load->model("goods_category_model");
            $this->load->model("store_model");
            $this->load->model("brand_model");
            $this->load->model("supplier_model");
            $data['purchase'] = $this->purchase_model->all($search);
        } else {
            $data['goods_data'] = $this->goods_model->all($search);
            $data['store_data'] = $this->store_model->all();
        }
        $this->load->view('sz_admin/goods/index', $data);
    }

    public function add() {
        $data = array();
        $this->load->model("goods_service_model");
        $this->load->model("goods_photo_model");
        $this->load->model("goods_type_model");
        $this->load->model("goods_attribute_model");
        $category = $this->goods_category_model->all();
        $data['brand_data'] = $this->brand_model->all();
        $data['goods_category_data'] = $this->goods_category_model->show_category($category, $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        foreach ($this->input->post()['service'] as $key => $value) {
            $data['service'][$value] = $value;
        }
        if ($this->input->post('is_submit')) {
            try {
                $goods_data = $this->input->post();
                $goods_data['nodepath'] = $this->goods_category_model->get_value_by_pk($goods_data['pid'], 'nodepath');
                $goods_data['created'] = $goods_data['modified'] = time();
                if ($goods_data['service']) {
                    $goods_data['service'] = implode(",", array_values($goods_data['service']));
                }
                $data['goods_data'] = $goods_data;
                $res = array();
                foreach ($_FILES['photo'] as $k => $v) {
                    foreach ($v as $key => $val) {
                        $res[$key][$k] = $val;
                    }
                }
                //图片上传
                foreach ($res as $key => $value) {
                    $filePath = './uploads/'; //上传路径
                    $storName = 'photo'; //图片存储的字段名
                    $_FILES['photo'] = $value;
                    $photo[$storName][] = $this->goods_model->check_upimg($filePath, $storName);
                }
                //设置验证规则
                $rule_config = array(
                    array('field' => 'name', 'label' => '商品名称', 'rules' => 'required'),
                    array('field' => 'keyword', 'label' => '搜索关键字', 'rules' => 'required'),
                    array('field' => 'pid', 'label' => '商品类别', 'rules' => 'required'),
                    array('field' => 'brand_id', 'label' => '商品品牌', 'rules' => 'required'),
                    array('field' => 'price', 'label' => '商品售价', 'rules' => 'required'),
                    array('field' => 'original_price', 'label' => '商品原价', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run()) {
                    throw new Exception(validation_errors(), 0);
                }
                //插入商品二维码    
                $data['goods_data']['photo'] = $photo['photo']['0'];
                $goods_id = $this->goods_model->insert($data['goods_data']);
                $prephoto = $this->common->set_core($goods_id);
                $data['prephoto'] = "uploads/goods_core/" . $prephoto;
                $this->goods_model->update_by_pk(array('prephoto' => $data['prephoto']), $goods_id);
                //属性
                foreach ($data['goods_data']['attr_value'] as $key => $v) {
                    foreach ($v as $v1) {
                        $goods_att['attr_input_type'] = $this->goods_attribute_model->get_value_by_pk($key, 'attr_input_type');
                        $goods_att['attr_id'] = $key;
                        $goods_att['goods_id'] = $goods_id;
                        $goods_att['attr_value'] = $v1;
                        $this->goods_attr_model->insert($goods_att);
                    }
                }
                //商品图片批量入库
                foreach ($photo['photo'] as $key => $value) {
                    $photo_date['goods_id'] = $goods_id;
                    $photo_date['photo'] = $value;
                    $this->goods_photo_model->insert($photo_date);
                }
                init_messagebox('添加成功', 'success', 1, base_url('sz_admin/goods/index/down'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods/form', $data);
    }

    public function view($id) {
        $total = 0;
        $num = 0;
        $this->load->model("goods_evaluation_model");
        $this->load->model("purchase_model");
        $data['goods_data'] = $this->goods_model->get_by_pk($id);
        $data['goods_data']['nodepath'] = $this->goods_category_model->get_value_by_pk($data['goods_data']['pid'], 'nodepath');
        $arr = explode(',', $data['goods_data']['nodepath']);
        $data['goods_data']['bread'] = $this->goods_category_model->crumbs($arr, $type_name = 'cat_name');
        $data['brand_name'] = $this->brand_model->get_value_by_pk($data['goods_data']['brand_id'], 'brand_name');
        //求平均价
        $purchase = $this->purchase_model->all(array('attributes' => array('goods_id' => $id, 'status' => 1)));
        foreach ($purchase as $value) {
            $total = $total + ($value['amount'] * $value['price']);
            $num = $value['amount'] + $num;
        }
        $data['average_price'] = round($total / $num, 2);
        $data['goods_evaluation'] = $this->goods_evaluation_model->get_appoint_values(array('id', 'user_id', 'content', 'evaluation', 'created_time'), null, array('attributes' => array('goods_id' => $id, 'status' => 0), 'orders' => array('id' => 'desc', 'created_time' => 'asc')));
        $data['good_evaluation'] = $data['medium_evaluation'] = $data['bad_evaluation'] = 0;
        foreach ($data['goods_evaluation'] as $key => $value) {
            if ($value['evaluation'] == 0) {
                $data['good_evaluation'] = $data['good_evaluation'] + 1;
            } elseif ($value['evaluation'] == 1) {
                $data['medium_evaluation'] = $data['medium_evaluation'] + 1;
            } else {
                $data['bad_evaluation'] = $data['bad_evaluation'] + 1;
            }
        }
        $this->load->view('sz_admin/goods/view', $data);
    }

    public function edit($id) {
        $data = array();
        $this->load->model("goods_service_model");
        $this->load->model("goods_photo_model");
        $this->load->model("goods_type_model");
        $this->load->model("brand_category_model");
        $this->load->model("goods_attribute_model");
        $data['goods_data'] = $this->goods_model->get_by_pk($id);
        $data['brand_data'] = $this->brand_category_model->all(array('attributes' => array('cat_id' => $data['goods_data']['pid'])));
        //服务承诺
        foreach (explode(",", $data['goods_data']['service']) as $key => $value) {
            $data['service'][$value] = $this->goods_service_model->get_value_by_pk($value, 'id');
        }
        //图片
        foreach ($this->goods_photo_model->all(array('attributes' => array('goods_id' => $id))) as $key => $value) {
            $data['goods_photo'][$key] = $value['photo'];
        }
        //分类
        $data['goods_category_data'] = $this->goods_category_model->show_category($this->goods_category_model->all(), $id_name = 'cat_id', $pid_name = 'pid', $type_name = 'cat_name');
        if ($this->input->post('is_submit')) {
            try {
                $goods_data = $this->input->post();
                $goods_data['modified'] = time();
                $goods_data['nodepath'] = $this->goods_category_model->get_value_by_pk($goods_data['pid'], 'nodepath');
                $goods_data['service'] = implode(",", array_values($goods_data['service']));
                $rule_config = array(
                    array('field' => 'name', 'label' => '商品名称', 'rules' => 'required'),
                    array('field' => 'brand_id', 'label' => '商品品牌', 'rules' => 'required'),
                    array('field' => 'price', 'label' => '商品价格', 'rules' => 'required'),
                );
                $this->form_validation->set_rules($rule_config);
                if (!$this->form_validation->run()) {
                    throw new Exception(validation_errors(), 0);
                }
                //图片批量上传
                if ($_FILES['photo']['name'][0]) {
                    $res = array();
                    foreach ($_FILES['photo'] as $k => $v) {
                        foreach ($v as $key => $val) {
                            $res[$key][$k] = $val;
                        }
                    }
                    foreach ($res as $key => $value) {
                        $filePath = './uploads/'; //上传路径
                        $storName = 'photo'; //图片存储的字段名
                        $_FILES['photo'] = $value;
                        $goods_data[$storName][] = $this->goods_model->check_upimg($filePath, $storName);
                    }
                } else {
                    $goods_data['photo'] = $data['goods_photo'];
                }
                $data['goods_data'] = $goods_data;
                $goods_data['photo'] = $goods_data['photo']['0'];
                $this->goods_model->update_by_pk($goods_data, $id);
                $this->goods_photo_model->delete_by_attributes(array('goods_id' => $id), false);
                //处理属性
                if ($goods_data['attr_value']) {
                    $sql = "DELETE FROM `goods_attr` WHERE goods_id = $id";
                    $query = $this->db->query($sql);
                    $attr = $goods_data['attr_value'];
                    foreach ($attr as $key => $v) {
                        foreach ($v as $v1) {
                            $goods_att['attr_input_type'] = $this->goods_attribute_model->get_value_by_pk($key, 'attr_input_type');
                            $goods_att['attr_id'] = $key;
                            $goods_att['goods_id'] = $id;
                            $goods_att['attr_value'] = $v1;
                            $this->goods_attr_model->insert($goods_att);
                        }
                    }
                }
                //图片批量入库
                foreach ($data['goods_data']['photo'] as $key => $value) {
                    $photo_date['goods_id'] = $id;
                    $photo_date['photo'] = $value;
                    $this->goods_photo_model->insert($photo_date);
                }
                init_messagebox('修改成功', 'success', 1, base_url('sz_admin/goods/index/down'));
            } catch (Exception $e) {
                init_messagebox($e->getMessage(), 'error', $e->getCode());
            }
        }
        $this->load->view('sz_admin/goods/form', $data);
    }

    public function evaluation() {
        $data = array();
        $this->load->model('goods_evaluation_model');
        $this->load->model('reply_evaluation_model');
        $search['attributes'] = $this->input->get();
        // 总数与分页
        $data['per'] = 6;
        $data['total'] = $this->goods_evaluation_model->total(null, $search);
        //实例化分页类对象
        $page_obj = new Page($data['total'], $data['per']);
        $sql = "SELECT `id` , `goods_id` ,`user_id`, `evaluation` , `content` , `created_time` FROM `goods_evaluation` where goods_id = {$search['attributes']['goods_id']} and evaluation = {$search['attributes']['evaluation']} " . $page_obj->limit;
        $query = $this->db->query($sql);
        $data['goods_evaluationr'] = $query->result_array();
        foreach ($data['goods_evaluationr'] as $key => $value) {
            $data['goods_evaluationr'][$key]['reply'] = $this->reply_evaluation_model->all(array('attributes' => array('ge_id' => $value['id'])));
        }
        //获得页码列表
        $data['pagelist'] = $page_obj->fpage(array(3, 4, 5, 6, 7, 8));
        $p = isset($_GET['page']) ? $_GET['page'] : 1;
        $data['num'] = ($p - 1) * $data['per'];
        $this->load->view('sz_admin/goods/evaluation', $data);
    }

    public function deleted() {
        $field = array('prephoto', 'photo');
        $field_s = "remark";
        $this->delete_all($field, $field_s);
    }

    public function stock($id) {
        $goods = $this->goods_model->get_by_pk($id);
        if ($goods['status'] == 1) {
            $goods_data['status'] = 0;
        } else {
            $goods_data['status'] = 1;
        }
        $this->goods_model->update_by_pk($goods_data, $goods['id']);
        redirect(base_url('sz_admin/goods/index'));
    }

    public function check_type() {
        $id = $this->input->post('id');
        $data = $this->goods_category_model->get_by_attributes(array('pid' => $id), false);
        if ($data) {
            die(json_encode(array('flag' => 0)));
        } else {
            die(json_encode(array('flag' => 1)));
        }
    }

    public function sale() {
        $this->load->model("store_model");
        $data['goods_category'] = $this->goods_category_model->get_goods_category_options();
        $data['brand_name'] = $this->brand_model->get_appoint_values(array('brand_id', 'brand_name'));
        $search['attributes'] = $this->input->get();
        $data['status'] = $search['attributes'];
        if (!empty($search['attributes']['pid'])) {
            $arr = $this->goods_category_model->get_appoint_values(array('cat_id', 'pid'));
            $ids = $this->goods_category_model->get_category_son_ids($arr, $search['attributes']['pid']);
            $ids[] = $search['attributes']['pid'];
            $search['in'] = array('pid' => $ids);
            unset($search['attributes']['pid']);
        }
        if (isset($search['attributes']['operation_time']) && !empty($search['attributes']['operation_time'])) {
            $search['attributes']['operation_time_expertise'] = $search['attributes']['operation_time'];
            unset($search['attributes']['operation_time']);
        }
        // 总数与分页
        $total = $this->goods_model->total(null, $search);
        $data['total'] = $total;
        // 请使用config_item( 'per_page' )获取全局显示条数
        $per_page = config_item('per_page');
        $this->load->library('pagination');
        $pagination_config = array(
            'base_url' => base_url("sz_admin/goods/index"),
            'total_rows' => $total,
            'per_page' => $per_page,
            'uri_segment' => 4,
        );
        $this->pagination->initialize($pagination_config);
        $data['pagination'] = $this->pagination->create_links();
        $search['limit'] = array(
            'persize' => $per_page,
            'offset' => $this->pagination->get_cur_offset(),
            'orders' => array('id' => 'DESC'),
        );
        $data['goods_data'] = $this->goods_model->all($search);
        $data['store_data'] = $this->store_model->all();
        $this->load->view('sz_admin/goods/sale', $data);
    }

    public function ajax_get_goods_category() {
        $pid = $this->input->get("pid");
        $checked = $this->input->get("checked");
        if (!$pid) {
            exit("0");
        }
        $op_list = $this->goods_category_model->get_values("cat_id", "cat_name", array(), array("in" => array("pid" => $pid)));
        $str = "";
        foreach ($op_list as $cat_id => $value) {
            $ck = ($cat_id == $checked) ? "selected=selected" : "";
            $str .="<option value='{$cat_id}'   $ck  >$value</option>";
        }
        echo $str;
        exit;
    }

    public function select_attr() {
        $this->load->model("goods_attr_model");
        $this->load->model("goods_type_model");
        $this->load->model("goods_attribute_model");
        $id = $this->input->post("type_id");
        if ($this->input->post("goods_id")) {
            $data['goods_attr'] = $this->goods_attr_model->all(array('attributes' => array('goods_id' => $this->input->post("goods_id"))));
        }
        $string = $this->goods_category_model->get_value_by_pk($id, 'nodepath');
        if ($string) {
            $nodepath = \explode(",", $string);
        }
        foreach ($this->goods_attribute_model->all(array('attributes' => array('type_id' => $nodepath[0], 'status' => 0), 'orders' => array('attr_input_type' => 'DESC'))) as $key1 => $value1) {
            $arr[$key1]['attr_id'] = $value1['attr_id'];
            $val = \str_replace('，', ',', $value1['attr_value']);
            $arr[$key1]['attr_value'] = explode(',', $val);
            $arr[$key1]['attr_input_type'] = $value1['attr_input_type'];
        }
        $data['select_item_data'] = $arr;
        $this->load->view('sz_admin/goods/ajax_select_attr', $data);
    }

    public function select_brand() {
        $this->load->model("brand_model");
        $this->load->model("brand_category_model");
        $search['attributes']['cat_id'] = $this->input->post('type_id');
        $brand = $this->brand_category_model->all($search);
        $name = "<option value=''>---请选择---</option>";
        foreach ($brand as $v) {
            if ($this->brand_model->get_value_by_pk($v['brand_id'], 'brand_name')) {
                $name .= '<option value="' . $v['brand_id'] . '">' . $this->brand_model->get_value_by_pk($v['brand_id'], 'brand_name') . '</option>';
            }
        }
        echo $name;
    }

    //下架
    public function down() {
        $ids = $this->input->post("ids");
        $data['status'] = 1;
        foreach ($ids as $value) {
            $this->goods_model->update_by_pk($data, $value);
        }
        redirect(base_url('sz_admin/goods/index'));
    }

    //修改特价
    public function special_edit() {
        $this->load->model("cart_model");
        $ids = $this->input->post();
        $res = array();
        foreach ($ids as $k => $v) {
            foreach ($v as $key => $val) {
                $res[$key][$k] = $val;
            }
        }
        //修改goods表的价格
        foreach ($res as $value) {
            $value['is_special'] = 1;
            $this->goods_model->update_by_pk($value, $value['id']);
        }
        //修改购物车的价格
        foreach ($res as $val) {
            $search['attributes']['goods_id'] = $val['id'];
            $cart = $this->cart_model->all($search);
            foreach ($cart as $key => $v) {
                $v['market_price'] = $val['activity_price'];
                $this->cart_model->update_by_pk($v, $v['cart_id']);
            }
        }
        redirect(base_url('sz_admin/goods/index'));
    }

    //取消特价
    public function cancel_special() {
        $this->load->model("cart_model");
        $ids = $this->input->post('ids');
        foreach ($ids as $value) {
            $val['is_special'] = 0;
            $this->goods_model->update_by_pk($val, $value);
        }
        //修改购物车的价格
        foreach ($ids as $val) {
            $price = $this->goods_model->get_value_by_pk($val, 'price');
            $search['attributes']['goods_id'] = $val;
            $cart = $this->cart_model->all($search);
            foreach ($cart as $key => $v) {
                $v['market_price'] = $price;
                $this->cart_model->update_by_pk($v, $v['cart_id']);
            }
        }
        redirect(base_url('sz_admin/goods/index'));
    }

    //特价
    public function special() {
        $ids = $this->input->get('ids');
        foreach ($ids as $value) {
            $data['goods_data'][] = $this->goods_model->get_by_pk($value);
        }
        $this->load->view('sz_admin/goods/special', $data);
    }

    //上架
    public function up() {
        $ids = $this->input->get('ids');
        foreach ($ids as $value) {
            $data['goods_data'][] = $this->goods_model->get_by_pk($value);
        }
        $this->load->view('sz_admin/goods/up', $data);
    }

//上架修改价格
    public function up_edit($id) {
        $this->load->model("cart_model");
        $ids = $this->input->post();
        if (!$ids) {
            $ids = $id;
        }
        $res = array();
        foreach ($ids as $k => $v) {
            foreach ($v as $key => $val) {
                $res[$key][$k] = $val;
            }
        }
        //修改goods表的价格
        foreach ($res as $value) {
            $value['status'] = 0;
            $value['modified'] = time();
            $this->goods_model->update_by_pk($value, $value['id']);
        }
        //修改购物车的价格
        foreach ($res as $val) {
            $search['attributes']['goods_id'] = $val['id'];
            $cart = $this->cart_model->all($search);
            foreach ($cart as $key => $v) {
                $v['market_price'] = $val['activity_price'];
                $this->cart_model->update_by_pk($v, $v['cart_id']);
            }
        }
        redirect(base_url('sz_admin/goods/index'));
    }

    public function get_stock() {
        $ids = $this->input->post('ids');
        foreach ($ids as $key => $value) {
            if ($this->goods_model->get_value_by_pk($value, "num") == 0) {
                $data[$key] = $this->goods_model->get_value_by_pk($value, "name");
            }
        }
        echo $data;
    }

}
