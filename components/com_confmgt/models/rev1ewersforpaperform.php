<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Confmgt model.
 */
class ConfmgtModelRev1ewersforPaperForm extends JModelForm
{
    
    var $_item = null;
	var $_paper_item = null;
    
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('com_confmgt');

		// Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_confmgt.edit.rev1ewersforpaper.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_confmgt.edit.rev1ewersforpaper.id', $id);
        }
		$this->setState('rev1ewersforpaper.id', $id);

		// Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
            $this->setState('rev1ewersforpaper.id', $params_array['item_id']);
        }
		$this->setState('params', $params);

	}
	
	/**
     * Method to get the LinkID set in either the user session data or the fget / post data.
     *
     * @return	linkid
     * 
     */
	public function &getLinkid()
	{
		$linkid = JFactory::getApplication()->getUserStateFromRequest( "com_confmgt.linkid", 'linkid', 0 );
		if ($linkid == 0)
		{
			JError::raiseError('500', JText::_('JERROR_NO_PAPERID'));
			return false;
		}else{		
			return $linkid;
		}		
	}

        

	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id)) {
				$id = $this->getState('rev1ewersforpaper.id');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
                
                $user = JFactory::getUser();
                $id = $table->id;
				
                $canEdit = AclHelper::isThemeleader(0,$table->paperid);
				

                if (!$canEdit) {
                    JError::raiseError('500', JText::_('JERROR_ALERTNOAUTHOR'));
                }
                
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if ($table->state != $published) {
						return $this->_item;
					}
				}

				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');
			} elseif ($error = $table->getError()) {
				$this->setError($error);
			}
		}

		return $this->_item;
	}
	
	public function getPaperData($id = null)
	{
		if ($this->_paper_item === null)
		{
			$this->_paper_item = false;

			if (empty($id)||$id==0) {
				$id = $this->getLinkid();
			}

			// Get a level row instance.
			$table = $this->getTable('Paper','ConfmgtTable',array());

			// Attempt to load the row.
			if ($table->load($id))
			{
                
                $user = JFactory::getUser(); 
                $id = $table->id;
				
                $canEdit = AclHelper::isThemeleader(0,$id);

                if (!$canEdit) {
                    JError::raiseError('500', JText::_('JERROR_ALERTNOAUTHOR'));
                }
				
				$properties = $table->getProperties(1);
				
				$this->_paper_item = JArrayHelper::toObject($properties, 'JObject');
			} elseif ($error = $table->getError()) {
				$this->setError($error);
			}
		}
				
			  //Deal with the abstract review outcome		
			  switch ($this->_paper_item->abstract_review_outcome) {
				  case 1:
					  $this->_paper_item->abstract_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_ABSTRACT_OUTCOME_ACCEPT');
					  if (!empty($this->_paper_item->full_paper)) {
						  $this->_paper_item->full_paper_download = $this->_FullPaperDownloadBtn($this->_paper_item->full_paper);
					  }
						  
				  break;
				  
				  case 2:
					  $this->_paper_item->abstract_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_ABSTRACT_OUTCOME_MINOR_CHANGE');
					  if (!empty($this->_paper_item->full_paper)) {
						  $this->_paper_item->full_paper_download = $this->_FullPaperDownloadBtn($this->_paper_item->full_paper);
					  }	
				  break;
				  
				  case 3:
					  $this->_paper_item->abstract_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_ABSTRACT_OUTCOME_RESUBMIT');
				  break;
				  
				  case 4:
					  $this->_paper_item->abstract_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_ABSTRACT_OUTCOME_REJECT');
				  break;
				  
				  case '':
				  default:
					  $this->_paper_item->abstract_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_ABSTRACT_OUTCOME_PENDING');
					  if (empty($this->_paper_item->abstract_review_comments)) {
						  $this->_paper_item->abstract_review_comments = JText::_('COM_CONFMGT_MODEL_PAPER_ABSTRACT_COMMENTS_PENDING');
					  }
				  break;
			  }
			  
			  //Deal with the full paper review outcome		
			  switch ($this->_paper_item->full_review_outcome) {
				  case 1:
					  $this->_paper_item->full_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_OUTCOME_ACCEPT');
				  break;
				  
				  case 2:
					  $this->_paper_item->full_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_OUTCOME_MINOR_CHANGE');
				  break;
				  
				  case 3:
					  $this->_paper_item->full_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_OUTCOME_RESUBMIT');
				  break;
				  
				  case 4:
					  $this->_paper_item->full_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_OUTCOME_REJECT');
				  break;
				  
				  case '':
				  default:
					  if (empty($this->_paper_item->full_paper)) {
						  $this->_paper_item->full_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_OUTCOME_NA');	
						  $this->_paper_item->full_review_comments = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_COMMENTS_NA');	
					  }else{
						  $this->_paper_item->full_review_outcome_text = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_OUTCOME_PENDING');
						  $this->_paper_item->full_review_comments = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_COMMENTS_PENDING');
					  }
				  break;
			  }
			  
			  //Deal with the camera ready papers
				  if (empty($this->_paper_item->camera_ready)) {
					  if (($this->_paper_item->full_review_outcome ==1) || ($this->_paper_item->full_review_outcome ==2)) {
						  $this->_paper_item->camera_ready = JText::_('COM_CONFMGT_MODEL_PAPER_CAMERA_READY_PENDING');
						  $this->_paper_item->presentation = JText::_('COM_CONFMGT_MODEL_PAPER_PRESENTATION_NA');
					  }else{
						  $this->_paper_item->camera_ready = JText::_('COM_CONFMGT_MODEL_PAPER_CAMERA_READY_NA');
						  $this->_paper_item->presentation = JText::_('COM_CONFMGT_MODEL_PAPER_PRESENTATION_NA');
					  }
				  }
			  
			  //Deal with the presentations
				  if (empty($this->_paper_item->presentation)) {				
					  $this->_paper_item->presentation = JText::_('COM_CONFMGT_MODEL_PAPER_PRESENTATION_PENDING');
				  }
				  
			  //If still the $this->item->full_paper is blank, it must be not due
				  
				  if (empty($this->_paper_item->full_paper)) {
					  if (($this->_paper_item->abstract_review_outcome ==1) || ($this->_paper_item->abstract_review_outcome ==2)){
						  $this->_paper_item->full_paper = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_PENDING');
					  }else{
						  $this->_paper_item->full_paper = JText::_('COM_CONFMGT_MODEL_PAPER_FULLPAPER_NA');
					  }			
				  }
					
		return $this->_paper_item;
	}
	
	 protected function getRev1ewersQuery() {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user = JFactory::getUser();
		
		// get the paper id		
		$linkid = $this->getLinkid();
		 
			
		 // Select the required fields from the table.
        $query->select('a.*');
        $query->from('`#__confmgt_rev1ewers_papers` AS a');
		$query->select(array('b.id AS revid','b.surname AS revsurname', 'b.title as revtitle', 'b.firstname as revfirstname'));
		$query->join('LEFT', '#__confmgt_rev1ewers AS b ON b.id=a.reviewerid');
		if (!$linkid==0) { 
			$query->where('a.paperid ='.$linkid);
		}else{
			JError::raiseError(500, 'No paper id');
			return false;
		}
		$query->order('a.reviewerid ASC');
		return $query;
		
	}
	
	public function &getRev1ewersData()
	{
		$db		= $this->getDbo();
		//Prepare the query
		$db->setQuery($this->getRev1ewersQuery()); 
		
		// Load the row.
		$rows = $db->loadObjectlist();	
		return $rows; 
	}
	
	 protected function getAuthorsQuery() {
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user = JFactory::getUser();
		
		// get the paper id		
		$linkid = $this->getLinkid();
		 
			
		 // Select the required fields from the table.
        $query->select('a.*');
        $query->from('`#__confmgt_authors` AS a');
		
		if (!$linkid==0) { 
			$query->where('linkid ='.$linkid);
		}else{
			JError::raiseError(500, 'No paper id');
			return false;
		}
		$query->order('a.ordering ASC');
		return $query;
		
	}
	
	public function &getAuthorsData()
	{
		$db		= $this->getDbo();
		//Prepare the query
		$db->setQuery($this->getAuthorsQuery()); 
		
		// Load the row.
		$rows = $db->loadObjectlist();	
		return $rows; 
	}
    
    
	public function getTable($type = 'Rev1ewersforpaper', $prefix = 'ConfmgtTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
	}     

    
	/**
	 * Method to check in an item.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkin($id = null)
	{
		// Get the id.
		$id = (!empty($id)) ? $id : (int)$this->getState('rev1ewersforpaper.id');

		if ($id) {
            
			// Initialise the table
			$table = $this->getTable();

			// Attempt to check the row in.
            if (method_exists($table, 'checkin')) {
                if (!$table->checkin($id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}

		return true;
	}

	/**
	 * Method to check out an item for editing.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkout($id = null)
	{
		// Get the user id.
		$id = (!empty($id)) ? $id : (int)$this->getState('rev1ewersforpaper.id');

		if ($id) {
            
			// Initialise the table
			$table = $this->getTable();

			// Get the current user object.
			$user = JFactory::getUser();

			// Attempt to check the row out.
            if (method_exists($table, 'checkout')) {
                if (!$table->checkout($user->get('id'), $id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}

		return true;
	}    
    
	/**
	 * Method to get the profile form.
	 *
	 * The base form is loaded from XML 
     * 
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_confmgt.rev1ewersforpaper', 'rev1ewersforpaperform', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_confmgt.edit.rev1ewersforpaper.data', array());
        if (empty($data)) {
            $data = $this->getData();
        }
        return $data;
	}
	
		protected function checkRev1ewerExists($data)
	{
        if (!($data['reviewerid'] > 0 && $data['paperid'] > 0)) {
            JError::raiseError(500, 'No paper id');
			return false;
        }
        $db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user = JFactory::getUser();
		
		// get the paper id		
		$linkid = $data['paperid'];
		$reviewerid = $data['reviewerid'];
		
			
		 // Select the required fields from the table.
        $query->select('a.*');
        $query->from('`#__confmgt_rev1ewers_papers` AS a');
		$query->where('a.paperid ='.$linkid);
		$query->where('a.reviewerid ='.$reviewerid);
		
		$db->setQuery($query);
		$db->execute();
		$num_rows = $db->getNumRows();
		
		if ($num_rows > 0) {
			JError::raiseWarning(233, 'This Reviewer is already added to this paper. Please select a different reviewer or cancel.');
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function save($data)
	{
	
		$id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('rev1ewersforpaper.id');
		
		if (empty($data['id'])) {
			
			$user = JFactory::getUser();
			$app = JFactory::getApplication();

		}
	
		//Change to Confmgt ACL
		$linkid = $this->getLinkid();
		
		$authorised = AclHelper::isThemeleader(0,$linkid);
		
		 if (!$authorised) {
				JError::raiseError('500', JText::_('JERROR_ALERTNOAUTHOR'));
		  }
		
		$data['paperid'] = $linkid;
		$data['reviewerid'] = $data['rev1ewer'];
		
		$exists = $this->checkRev1ewerExists($data);
		
		if (!$exists) 
		{
			$table = $this->getTable();
			if ($table->save($data) === true) {
				return $id;
			} else {
				return false;
			}
		}else{
			return false;
		}
	}
    
     function delete($data)
    {
        
		$linkid = $this->getLinkid();
		$authorised = AclHelper::isThemeleader(0,$linkid);
		
		 if (!$authorised) {
				JError::raiseError('500', JText::_('JERROR_ALERTNOAUTHOR'));
		  }

        $table = $this->getTable();
        if ($table->delete($data['rev_id']) === true) {
            return $id;
        } else {
            return false;
        }
        
        return true;
    }
	
			//Generate abstract button
	private function _AbstractBtn ($id=0, $mode='change')
	{
		$html =  "<div style=\"display:inline\">";
		$html = $html. "<form id=\"form-abstract-resubmit-". $id."\"";
		$html = $html." action=\"".JRoute::_('index.php')."\" method=\"post\" class=\"form-validate\" enctype=\"multipart/form-data\">";
		$html = $html.JHtml::_('form.token');
  		$html = $html."<input type=\"hidden\" name=\"option\" value=\"com_confmgt\" />";
		$html = $html."<input type=\"hidden\" name=\"jform['linkid']\" value=".$id." />";
		$html = $html."<input type=\"hidden\" name=\"linkid\" value=".$id." />";
		$html = $html."<input type=\"hidden\" name=\"jform['mode']\" value=\"".$mode."\" />";
		if ($mode =='resubmit') {
			$html = $html."<input type=\"hidden\" name=\"view\" value=\"abstractform\" />";
		}else{
			$html = $html."<input type=\"hidden\" name=\"view\" value=\"paperform\" />";
		}
  		$html = $html."<button class=\"btn btn-default\" type=\"submit\">";
		if ($mode =='change') {
			$html =	$html.JText::_("Change the abstract");
		}elseif ($mode =='resubmit') {
			$html =	$html.JText::_("Resubmit the abstract");
		}
		$html = $html."</button></form></div>";
		
	
		return $html;
		
		
	}
	
	//Generate full paper change button
	private function _FullPaperBtn ($id=0, $mode='new')
	{
		$html =  "<div style=\"display:inline\">";
		$html = $html. "<form id=\"form-fullpaper-resubmit-". $id."\"";
		$html = $html." action=\"".JRoute::_('index.php')."\" method=\"post\" class=\"form-validate\" enctype=\"multipart/form-data\">";
		$html = $html.JHtml::_('form.token');
  		$html = $html."<input type=\"hidden\" name=\"option\" value=\"com_confmgt\" />";
  		$html = $html."<input type=\"hidden\" name=\"view\" value=\"fullpaperform\" />";
		$html = $html."<input type=\"hidden\" name=\"jform['linkid']\" value=\"".$id."\" />";
		$html = $html."<input type=\"hidden\" name=\"jform['mode']\" value=\"".$mode."\" />";
  		$html = $html."<button class=\"btn btn-default\" type=\"submit\">";
		if ($mode =='change') {
			$html =	$html.JText::_("Change the full Paper");
		}elseif ($mode =='resubmit') {
			$html =	$html.JText::_("Resubmit the full paper");
		}elseif ($mode == 'new') {
			$html =	$html.JText::_("Upload the full paper");
		}
		$html = $html."</button></form></div>";
		
		return $html;
		
	}
	
	//Generate camera ready paper change button
	private function _CameraReadyPaperBtn ($id=0, $mode = 'new')
	{
		$html =  "<div style=\"display:inline\">";
		$html = $html. "<form id=\"form-camerapaper-resubmit-". $id."\"";
		$html = $html." action=\"".JRoute::_('index.php')."\" method=\"post\" class=\"form-validate\" enctype=\"multipart/form-data\">";
		$html = $html.JHtml::_('form.token');
  		$html = $html."<input type=\"hidden\" name=\"option\" value=\"com_confmgt\" />";
  		$html = $html."<input type=\"hidden\" name=\"view\" value=\"camerareadypaperform\" />";
		$html = $html."<input type=\"hidden\" name=\"jform['linkid']\" value=\"".$id."\" />";
		$html = $html."<input type=\"hidden\" name=\"jform['mode']\" value=\"".$mode."\" />";
  		$html = $html."<button class=\"btn btn-default\" type=\"submit\">";
		if ($mode =='change') {
			$html =	$html.JText::_("Change the Camera Ready paper");
		}elseif ($mode =='resubmit') {
			$html =	$html.JText::_("Resubmit the Camera Ready paper");
		}elseif ($mode == 'new') {
			$html =	$html.JText::_("Upload the Camera Ready paper");
		}
		$html = $html."</button></form></div>";
		
		return $html;
		
	}
	
	//Generate presentation change button
	private function _PresentationBtn ($id=0, $mode = 'new')
	{ 
		$html =  "<div style=\"display:inline\">";
		$html = $html. "<form id=\"form-camerapaper-resubmit-". $id."\"";
		$html = $html." action=\"".JRoute::_('index.php')."\" method=\"post\" class=\"form-validate\" enctype=\"multipart/form-data\">";
		$html = $html.JHtml::_('form.token');
  		$html = $html."<input type=\"hidden\" name=\"option\" value=\"com_confmgt\" />";
  		$html = $html."<input type=\"hidden\" name=\"view\" value=\"presenationform\" />";
		$html = $html."<input type=\"hidden\" name=\"jform['linkid']\" value=\"".$id."\" />";
		$html = $html."<input type=\"hidden\" name=\"jform['mode']\" value=\"".$mode."\" />";
  		$html = $html."<button class=\"btn btn-default\" type=\"submit\">";
		if ($mode =='change') {
			$html =	$html.JText::_("Change presenation");
		}elseif ($mode =='resubmit') {
			$html =	$html.JText::_("Resubmit the presenation");
		}elseif ($mode == 'new') {
			$html =	$html.JText::_("Upload the presenation");
		}
		$html = $html."</button></form></div>";
		
		return $html;
		
	}
	
		//Generate full paper change button
	private function _FullPaperBtnModal ($id=0, $mode='new')
	{

        $html =  "<button data-toggle=\"modal\" class=\"btn btn-default\" style=\"display:inline\" type=\"button\" data-target=\"#FullPaperModal\" data-remote=\"".JRoute::_('index.php?option=com_confmgt&amp;view=fullpaperform&amp;linkid='.$id.'&amp;mode='.$mode.'&amp;tmpl=component')."\">";
		if ($mode =='change') {
			$html =	$html.JText::_("Change the full Paper");
		}elseif ($mode =='resubmit') {
			$html =	$html.JText::_("Resubmit the full paper");
		}elseif ($mode == 'new') {
			$html =	$html.JText::_("Upload the full paper");
		}
		$html = $html."</button>";
		
		return $html;
		
	}
	
		//Generate presentation change button
	private function _FullPaperDownloadBtn ($filename)
	{ 
		$html =  "<div style=\"display:inline\">";
		$html = $html. "<form id=\"form-download\"";
		$html = $html." action=\"".JRoute::_('index.php')."\" method=\"post\" class=\"form-validate\" enctype=\"multipart/form-data\">";
		$html = $html.JHtml::_('form.token');
  		$html = $html."<input type=\"hidden\" name=\"option\" value=\"com_confmgt\" />";
  		$html = $html."<input type=\"hidden\" name=\"task\" value=\"paper.downloadfullpaper\" />";
		$html = $html."<input type=\"hidden\" name=\"filename\" value=\"".$filename."\" />";
  		$html = $html."<button class=\"btn btn-default\" type=\"submit\">";
		$html =	$html.JText::_("Download");
		$html = $html."</button></form></div>";
		return $html;
		
	}
    
}