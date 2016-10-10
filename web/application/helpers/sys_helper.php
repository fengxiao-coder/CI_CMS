<?php

/**
 * 系统应用函数库
 * @author 谢峰
 * @version 0.0
 * @package application
 * @subpackage application/helpers
 */


function initState( $type ){
	switch ( $type ) {
		case DRAFT:
			echo '<span class="badge">起草</span>';
			break;
		case APPROVAL:
			echo '<span class="badge badge_inverse">审批</span>';
			break;
		case APPOINT:
			echo '<span class="badge badge_info">指派</span>';
			break;
		case EDIT:
			echo '<span class="badge badge_warning">修改</span>';
			break;
		case REBACK:
			echo '<span class="badge badge_important">退回</span>';
			break;
		case PASS:
			echo '<span class="badge badge_success">通过</span>';
			break;
		case TRASH:
			echo '<span class="badge">废除</span>';
			break;
		case UNPASS:
			echo '<span class="badge badge_important">不通过</span>';
			break;
		case REVIEW:
			echo '<span class="badge badge_inverse">复核</span>';
			break;
		case RECEIVE:
			echo '<span class="badge badge_warning">领取</span>';
			break;
		case DETECT:
			echo '<span class="badge badge_info">检测</span>';
			break;
		case FILLIN:
			echo '<span class="badge badge_info">填写</span>';
			break;
		case SAMPLE:
			echo '<span class="badge badge_info">采样</span>';
			break;
		case ING:
			echo '<span class="badge badge_info">进行中</span>';
			break;
		case DETERMINE:
		case SAMPLE_UNSTART:
			echo '<span class="badge">未开始</span>';
			break;
		case SAMPLE_COLLECTING:
			echo '<span class="badge badge_info">采样中</span>';
			break;
		case SAMPLE_IN:
			echo '<span class="badge badge_success">在库</span>';
			break;
		case SAMPLE_SOMEIN:
			echo '<span class="badge badge_success">部分在库</span>';
			break;
		case SAMPLE_OUT:
			echo '<span class="badge badge_inverse">出库</span>';
			break;
		case SAMPLE_DESTROY:
			echo '<span class="badge badge_warning">销毁</span>';
			break;
		case SAMPLE_FINISH:
			echo '<span class="badge badge_success">完成</span>';
			break;
		case UNAPPOINT:
			echo '<span class="badge badge_success">未指派</span>';
			break;
		case SAMPLE_SURE:
			echo '<span class="badge badge_success">确定任务</span>';
			break;
		case SAMPLE_PRINT:
			echo '<span class="badge badge_success">打印</span>';
			break;
		case 1:
			echo '<span class="badge">新任务</span>';
			break;
		case 2:
			echo '<span class="badge badge_inverse">审批中</span>';
			break;
		case 3:
			echo '<span class="badge badge_info">待采样</span>';
			break;
		case 4:
			echo '<span class="badge badge_warning">已分配</span>';
			break;
		case 5:
			echo '<span class="badge badge_success">已完成</span>';
			break;
		case 6:
			echo '<span class="badge badge_info">采样中</span>';
			break;
		case 7:
			echo '<span class="badge badge_success">已收样</span>';
			break;
		case 8:
			echo '<span class="badge badge_success">已指派</span>';
			break;		
		case 9:
			echo '<span class="badge badge_success">检测中</span>';
			break;
	}

}
