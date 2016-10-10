<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
        
        <tr>
            <td width="12%" class="details_title"><strong>类型</strong></td>
            <td width="88%"><?php echo $this->news_type_model->get_value_by_pk($news_data['pid'],'type_name'); ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>标题</strong></td>
            <td width="88%"><?php echo $news_data['title']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>作者</strong></td>
            <td width="88%"><?php echo $news_data['author']; ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>关键字</strong></td>
            <td width="88%"><?php echo $news_data['keywords']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>内容</strong></td>
            <td width="88%"><?php echo $news_data['content']; ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>备注</strong></td>
            <td width="88%" ><?php echo $news_data['description']; ?></td>
        </tr>
        
        <tr>
            <td width="12%" class="details_title"><strong>添加时间</strong></td>
            <td width="88%"><?php echo init_date($news_data['created']); ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>修改时间</strong></td>
            <td width="88%"><?php echo init_date($news_data['modified']); ?></td>
        </tr>

    </table>
</div>
</div>