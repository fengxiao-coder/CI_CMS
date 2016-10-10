<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

        <tr>
            <td width="12%" class="details_title"><strong>名称</strong></td>
            <td width="88%"><?php echo $news_type_data['type_name']; ?></td>
        </tr>
<!-- 
        <tr>
            <td width="12%" class="details_title"><strong>图片路径</strong></td>
            <td width="88%"><?php echo $news_type_data['imagemark']; ?></td>
        </tr>
-->
        <tr>
            <td width="12%" class="details_title"><strong>上级分类</strong></td>
            <td width="88%"><?php echo $type_name?$type_name:"顶级分类"; ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>描述</strong></td>
            <td width="88%"><?php echo $news_type_data['remark']; ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>创建时间</strong></td>
            <td width="88%" ><?php echo init_date($news_type_data['created']); ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>修改时间</strong></td>
            <td width="88%"><?php echo init_date($news_type_data['modified']); ?></td>
        </tr>

    </table>
</div>
</div>