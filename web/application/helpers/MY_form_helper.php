<?php
/**
 * Drop-down Menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_dropdown'))
{
	function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '',$first='')
	{
		if ( ! is_array($selected))
		{
			$selected = array($selected);
		}

		// If no selected state was submitted we will attempt to set it automatically
		if (count($selected) === 0)
		{
			// If the form name appears in the $_POST array we have a winner!
			if (isset($_POST[$name]))
			{
				$selected = array($_POST[$name]);
			}
		}

		if ($extra != '') $extra = ' '.$extra;

		$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select name="'.$name.'"'.$extra.$multiple.">\n";
		if($first){
			$form.='<option value="">'.$first.'</option>'."\n";
		}
		foreach ($options as $key => $val)
		{
			$key = (string) $key;
			if (is_array($val) && ! empty($val))
			{
				$form .= '<optgroup label="'.$key.'">'."\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

					$form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
				}

				$form .= '</optgroup>'."\n";
			}
			else
			{
				$sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

				$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
			}
		}

		$form .= '</select>';

		return $form;
	}
}


/**
 * 复选框列表
 * @param string $name 名称
 * @param array $options 值-标签为键值对的数组
 * @param array $selected 被选中值的数组
 * @return string $form 复选框列表
 * @author 咸洪伟
 */
if ( ! function_exists('form_checkbox_list'))
{
	function form_checkbox_list($name = '', $options = array(), $selected = array())
	{
		$form='';
		foreach($options as $value=>$label){
			$checked=in_array($value,$selected)?TRUE:FALSE;
			$form.='<label>';
			$form.=form_checkbox($name.'[]',$value,$checked);
			$form.=$label;
			$form.='</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		return $form;
	}
}

/**
 * 复选框列表
 * @param string $name 名称
 * @param array $options 值-标签为键值对的数组
 * @param array $selected 被选中值的数组
 * @return string $form 复选框列表
 * @author 咸洪伟
 */
if ( ! function_exists('form_checkbox_table'))
{
	function form_checkbox_table($name = '', $options = array(), $selected = array())
	{
		$CI=& get_instance();
		$form='<table>';
		foreach($options as $value=>$label){
			$form.='<tr>';
			$form.='<td>';
			$checked=in_array($value,$selected)?TRUE:FALSE;
			$form.='<label>';
			$form.=form_checkbox($name.'[]',$value,$checked);
			$form.=$label;
			$form.='</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$form.='</td>';
			$form.='<td>';
			$form.=''.$CI->process_item_model->get_stepstr_by_admin($value).'';
			$form.='</td>';
			$form.='</tr>';
		}
		$form.='</table>';
		return $form;
	}
}

/**
 * 复选框列表
 * @param string $name 名称
 * @param array $options 值-标签为键值对的数组
 * @param array $selected 被选中值的数组
 * @return string $form 复选框列表
 * @author 咸洪伟
 */
if ( ! function_exists('form_checkbox_attr'))
{
	function form_checkbox_attr($name = '', $options = array(), $selected = array())
	{
		$CI=& get_instance();
		$form='<table>';
		foreach($options as $value=>$label){
			$form.='<tr>';
			$form.='<td>';
			$form.=''.$value.'. ';
			$form.='</td>';
			$form.='<td>';
			$checked=in_array($value,$selected)?TRUE:FALSE;
			$form.='<label>';
			$form.=form_checkbox($name.'[]',$value,$checked);
			$form.=$label;
			$form.='</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$form.='</td>';
			$form.='</tr>';
		}
		$form.='</table>';
		return $form;
	}
}
