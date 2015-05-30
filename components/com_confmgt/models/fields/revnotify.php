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
class  JFormFieldRevnotify extends JFormField
{
	/**
	 * The form field type.
	 * Extending the TextArea field type
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Revnotify';

	/**
	 * Method to get the textarea field input markup for the reviewer notificationfghj80 with a default email content in the area.
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
		 
		  $revid = JFactory::getApplication()->getUserState('com_confmgt.notify.rev.id');
          if ( $revid == 0 ) {
            JError::raiseError( '500', JText::_( 'JERROR_NO_REVID' ) );
            return false;
          }
		  
		  $rev1ewer = ConfmgtHelper::getRev1ewer($revid);
		  $rev1ewername = $rev1ewer->title.' '.$rev1ewer->firstname.' '.$rev1ewer->surname;
		  $papers = $rev1ewer->papers;
		  $config = JFactory::getConfig();
		  $sitename = $config->getValue( 'config.sitename' );
		  $site_url=JURI::base();
		  $login_url = JURI::base()."index.php/component/confmgt/";
		  $directlinktoken = $rev1ewer->token;
		  $user = JFactory::getUser($rev1ewer->userid);
		  $username = $user->username;
		  $forgotpw = "index.php/component/users/?view=reset";
		  //specify placeholders as an in the xml file e.g. array('ABSTRACT'=>$abstract,'NAME'=>$authorname,'TITLE'=>$title, 'KEYWORDS'=>$keywords,'SITE'=>$sitename, 'SITE_URL'=>$site_url, 'AUTHORS'=>$authordetails);
		  $placeholders = array('NAME'=>$rev1ewername, 'SITE'=>$sitename, 'SITE_URL'=>$site_url, 'TOKEN'=>$directlinktoken, 'PAPERS'=>$papers, 'USERNAME'=>$username, 'FORGOTPW' => $forgotpw, 'LOGINURL'=>$login_url);
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
