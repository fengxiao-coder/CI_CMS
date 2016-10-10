<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

        <tr>
            <td width="12%" class="details_title"><strong>名称</strong></td>
            <td width="88%"><?php echo $goods_category_data['cat_name']; ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>所属类别</strong></td>
            <td width="88%">
                <?php foreach ($goods_category as $v) {
                    if ($goods_category_data['pid'] == $v['cat_id']) echo $v['cat_name'];
                } 
                ?>
            </td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>图片</strong></td>
            <td width="88%"><img class="goods_view_img" src="<?php echo site_url($goods_category_data['photo']); ?>" /> </td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>描述</strong></td>
            <td width="88%"><?php echo $goods_category_data['remark']; ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>排序</strong></td>
            <td width="88%"><?php echo $goods_category_data['sort']; ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>创建时间</strong></td>
            <td width="88%" ><?php echo init_date($goods_category_data['created']); ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>修改时间</strong></td>
            <td width="88%"><?php echo init_date($goods_category_data['modified']); ?></td>
        </tr>

    </table>
</div>
</div>