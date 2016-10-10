<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/adv/add")));
$this->common->show_title_breadcrumb("adv",$button);
?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

        <tr>
            <td width="12%" class="details_title"><strong>名称</strong></td>
            <td width="88%"><?php echo $adv_data['adv_title']; ?></td>
            
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>内容</strong></td>
            <td width="88%"><?php echo $adv_data['adv_content']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>网址</strong></td>
            <td width="88%"><?php echo $adv_data['adv_url']; ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>图片</strong></td>
            <td width="88%"><img class="goods_view_img" src="<?php echo site_url($adv_data['photo']); ?>"></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>点击量</strong></td>
            <td width="88%"><?php echo $adv_data['click_num']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>排序</strong></td>
            <td width="88%"><?php echo $adv_data['sort']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>创建时间</strong></td>
            <td width="88%" ><?php echo init_date($adv_data['created']); ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>修改时间</strong></td>
            <td width="88%"><?php echo init_date($adv_data['modified']); ?></td>
        </tr>
 
    </table>
</div>