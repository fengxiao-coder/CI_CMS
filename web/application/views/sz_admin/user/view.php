<?php $this->load->view_part($this->_site_path . "/main/breadcrumb_noadd"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
        <?php
        $address = $this->user_address_model->get_by_attributes(array('user_id' => $user_data['user_id'], 'mark' => 1));
        $province = $this->user_province_model->get_value_by_pk($address['province'], "province_name");
        $city = $this->user_city_model->get_value_by_pk($address['city'], "city_name");
        $area = $this->user_area_model->get_value_by_pk($address['area'], "area_name");
        ?>
        <tr>
            <td class="details_title" width="12%">用户名</td>
            <td width="88%"colspan="3"><?php echo $user_data['user_name']; ?></td>
        </tr> 
        <tr>
            <td  width="12%"class="details_title">图像</td>
            <td width="38%"  colspan="3"><img class="goods_view_img" src="<?php echo site_url($user_data['avatar']); ?>" /></td>
        </tr>

        <tr>
            <td class="details_title" width="12%">地址</td>
            <td width="88%"colspan="3"><?php echo $province . $city . $area . $address['address'] ?></td>
        </tr>  
        <tr>
            <td width="12%" class="details_title">电话</td>
            <td width="38%"><?php echo $user_data['phone']; ?> </td>
            <td width="12%" class="details_title">Email</td>
            <td width="38%" ><?php echo $user_data['email']; ?> </td>
        </tr>
        <tr>
            <td width="12%" class="details_title">创建时间</td>
            <td width="38%"> <?php echo init_date($user_data['created']); ?> </td>
            <td width="12%" class="details_title">修改时间</td>
            <td width="38%"><?php echo init_date($user_data['modified']); ?></td>
        </tr>

    </table>
</div>
