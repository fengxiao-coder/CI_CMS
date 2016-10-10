<?php $this->load->view_part($this->_site_path . "/main/breadcrumb_noadd"); ?>
<?php $this->load->view_part($this->_site_path . "/user/search") ?>
<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path . "/user/delete_all"); ?>">
    <div class="list_box">
        <table id="tb" class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>用户名</th>
                    <th>电话</th>
                    <th>邮箱</th>
                    <th>地址</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($user_data as $single) {
                    $address = $this->user_address_model->get_by_attributes(array('user_id' =>$single['user_id'], 'mark' => 1));
                    $province = $this->user_province_model->get_value_by_pk($address['province'], "province_name");
                    $city = $this->user_city_model->get_value_by_pk($address['city'], "city_name");
                    $area = $this->user_area_model->get_value_by_pk($address['area'], "area_name");
                    ?>
                    <tr>
                        <td>
                            <input name="ids[]" value="<?php echo $single['user_id']; ?>" type="checkbox" />
                        </td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/user/view/{$single['user_id']}"); ?>';"><?php echo $single['user_name']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/user/view/{$single['user_id']}"); ?>';"><?php echo $single['phone']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/user/view/{$single['user_id']}"); ?>';"><?php echo $single['email']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/user/view/{$single['user_id']}"); ?>';"><?php echo $province . $city . $area . $address['address'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 表格底部帮助栏-->
    <div class="tips">
        <!-- 分页开始-->
        <?php echo $pagination; ?>
        <!-- 分页结束-->
    </div>
</form>
