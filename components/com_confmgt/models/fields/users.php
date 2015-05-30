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
	 * Extending the Foreign Key field type
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Users';

	/**
	 * Method to get a list of users in a list.
	 * 
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   2.5.6
	 */
	 protected function getInput() {

        switch ($this->input_type) {
            case 'list':
            default:
                $options = array();

                //Iterate through all the results
				$results = ConfmgtHelper::getUsers();
				$options[] = JHTML::_('select.option','',JText::_('Please choose a theme leader'));
                foreach ($results as $result) {
                    $options[] = JHtml::_('select.option', $result->id, $result->name);  
				}
				
                $value = $this->value;
				$input_options = 'class="' . $this->getAttribute('class') . '"';

                $html = JHtml::_('select.genericlist', $options, $this->name, $input_options, 'value', 'text', $value);
                break;
        }
        return $html;
    }

    /**
     * Wrapper method for getting attributes from the form element
     * @param string $attr_name Attribute name
     * @param mixed  $default Optional value to return if attribute not found
     * @return mixed The value of the attribute if it exists, null otherwise
     */
    public function getAttribute($attr_name, $default = null) {
        if(!empty($this->element[$attr_name])){
            return $this->element[$attr_name];
        }
        else{
            return $default;
        }
    }
	
}
