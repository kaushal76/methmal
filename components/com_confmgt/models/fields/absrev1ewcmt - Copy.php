<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * 
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @link        http://www.w3.org/TR/html-markup/textarea.html#textarea
 * @since       11.1
 */
class  JFormFieldUsers extends JFormField
{
	/**
	 * The form field type.
	 * Extending the TextArea field type
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Users';

	/**
	 * Method to get the textarea field input markup for the abstract reviews with a default email content in the area.
	 * Use the rows and columns attributes to specify the dimensions of the area.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		// Initialize some field attributes.
		if ($this->value =='') {
			
		  //Generating the default email in the form.	  
		  //speficy the name of the email template in the XML file
		  $emailsource = $this->element['msgsource'];
		  $email = emailHelper::getEmailcontent ($emailsource);
		  $rawbody = $email->message;
		  
		  $linkid = ConfmgtHelper::getLinkid();
		  $rev1ews = ConfmgtHelper::getRev1ews($linkid);
		  $paper = ConfmgtHelper::getPaper($linkid);
		  
		  $config = JFactory::getConfig();
		  $sitename = $config->getValue( 'config.sitename' );
		  $site_url=JURI::base();
		  
		  $authorname = JFactory::getUser((int)$paper->created_by)->name;;
		  $title = $paper->title;
		  $theme = $paper->themename;
		  $paperid = $paper->id;
		  $comments = '';
		  $i=1;
		  if ($rev1ews) {
			  foreach ($rev1ews as $rev1ew) {
				  $comments = $comments."\r\n".JText::_('Reviewer '). $i.JText::_('comments: ')."\r\n". $rev1ew->author_comments;
				  $i = $i+1;
			  }
		  }
		  
		  //specify placeholders as an in the xml file e.g. array('ABSTRACT'=>$abstract,'NAME'=>$authorname,'TITLE'=>$title, 'KEYWORDS'=>$keywords,'SITE'=>$sitename, 'SITE_URL'=>$site_url, 'AUTHORS'=>$authordetails);
		  $placeholders = array('NAME'=>$authorname,'TITLE'=>$title, 'SITE'=>$sitename, 'SITE_URL'=>$site_url, 'COMMENTS'=>$comments, 'THEME'=>$theme, 'PAPERID' =>$paperid );
		  $body = emailHelper::replacePlaceholders($placeholders, $rawbody);
		  $this->value = $body; //change this to the $body or the $comment to display the full message or the comments only respectively
			
		}
		
		$class = $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
		$disabled = ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$columns = $this->element['cols'] ? ' cols="' . (int) $this->element['cols'] . '"' : '';
		$rows = $this->element['rows'] ? ' rows="' . (int) $this->element['rows'] . '"' : '';

		// Initialize JavaScript field attributes.
		$onchange = $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

		return '<textarea name="' . $this->name . '" id="' . $this->id . '"' . $columns . $rows . $class . $disabled . $onchange . '>'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '</textarea>';
	}
	
}
