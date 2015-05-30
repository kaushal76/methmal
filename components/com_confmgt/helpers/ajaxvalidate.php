<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
defined('_JEXEC') or die;
//Ajaxvalidate helper class for the confmgt. Using a specific validator for inline single field editing in the front end

abstract class AjaxvalidateHelper
{ 

  public function validate ($value, $required=0, $rule=null) {
	  
		  //set the return as an array
		  $return = array();
		  
		  // If the field is empty and not required, the field is valid.
		  $isRequired = ((string) $required == 'true' || (string) $required == 'required' || (string) $required == '1' || (int) $required == 1);
		  
		  // dealing with empty values;
		  if (!$isRequired && empty($value))
		  {
			  $return['status'] = (string)'true';
			  return $return;
		  }
  
		  if ($isRequired && empty($value))
		  {
			  $return['status'] = (string)'false';
			  $return['msg'] = "This field cannot be empty";
			  return $return;
		  }
		  
		  // if a rule is set...
		  if ($rule) {
		  }
  
  }
	
}