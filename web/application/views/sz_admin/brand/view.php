<?php //$this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/brand/add")));
$this->common->show_title_breadcrumb("brand",$button);
?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

        <tr>
            <td width="12%" class="details_title"><strong>名称</strong></td>
            <td width="88%"><?php echo $brand_data['brand_name']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>网址</strong></td>
            <td width="88%"><?php echo $brand_data['site_url']; ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>Logo</strong></td>
            <td width="88%"><img class="goods_view_img" src="<?php echo site_url($brand_data['brand_logo']); ?>"></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>描述</strong></td>
            <td width="88%"><?php echo $brand_data['brand_desc']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>排序</strong></td>
            <td width="88%"><?php echo $brand_data['sort']; ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>创建时间</strong></td>
            <td width="88%" ><?php echo init_date($brand_data['created']); ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>修改时间</strong></td>
            <td width="88%"><?php echo init_date($brand_data['modified']); ?></td>
        </tr>
 
    </table>
</div>
</div>