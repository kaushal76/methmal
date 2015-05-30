<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// No direct access
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Paper controller class.
 */
class ConfmgtControllerPaperForm extends ConfmgtController
{
	/* Methods for saving a single field on the fly using Ajax. 
	 * Implemented for front end inplace editing
	 * Use x-editable plugin as a the framework
	 *
	 */
	
	public function save_ajax(){
		
	$model = $this->getModel('PaperForm', 'ConfmgtModel');
		
 	// get the data 
	$name = JFactory::getApplication()->input->get('name', 0, 'string');
	$value = JFactory::getApplication()->input->get('value', 0, 'string');
	$required = JFactory::getApplication()->input->get('required', 0, 'int');
	$validate = JFactory::getApplication()->input->get('validate', 0, 'string');
	$table = JFactory::getApplication()->input->get('table', 0, 'string');
	
	//create a data array
	$data = array();
	$data [$name] = $value;
	$data['id'] = JFactory::getApplication()->input->get('pk', 0, 'int');

	//$validate = array();
	$validate = AjaxvalidateHelper::validate($value, $required);
	
	//get the status and the msg
	$status = $validate['status'];
	$msg = $validate['msg'];
	
	  if ($status=='false' ) {
	  	$response = array("status"=>"error", "msg"=> $msg); 
	  }else{
		 $return = $model->save_ajax($data); 
		 if (!$return) {
			 $err = $model->getError();
			 $response = array("status"=>"error", "msg"=>$err );
		 }else{	  
	  
	  		$response = array("status"=>"success");
		 }
	  }
	  
	  // Get the document object.
	  $document = JFactory::getDocument();
	  // Set the MIME type for JSON output.
	  $document->setMimeEncoding('application/json');  
	  echo json_encode($response);
	}
}