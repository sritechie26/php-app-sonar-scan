<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;
jimport( 'joomla.html.html.access' );
/**
 * Form Field class for the Joomla Platform.
 * Supports a nested check box field listing user groups.
 * Multiselect is available by default.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldUsergroup extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Usergroup';

	/**
	 * Method to get the user group field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	 // $temp =1;
	protected function getInput()
	{
		// Initialize variables.
		$options = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$attr .= $this->multiple ? ' multiple="multiple"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

		// Iterate through the children and build an array of options.
		foreach ($this->element->children() as $option)
		{

			// Only add <option /> elements.
			if ($option->getName() != 'option')
			{
				continue;
			}

			// Create a new option object based on the <option /> element.
			$tmp = JHtml::_(
				'select.option', (string) $option['value'], trim((string) $option), 'value', 'text',
				((string) $option['disabled'] == 'true')
			);

			// Set some option attributes.
			$tmp->class = (string) $option['class'];

			// Set some JavaScript option attributes.
			$tmp->onclick = (string) $option['onclick'];

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		
		
		//#############STARTS HERE##############
		
		
		  static $count;
 
        $count++;
 
        $db = &JFactory::getDbo();
        $db->setQuery(
                'SELECT a.*, COUNT(DISTINCT b.id) AS level' .
                ' FROM #__usergroups AS a' .
                ' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
                ' GROUP BY a.id' .
                ' ORDER BY a.lft ASC'
        );
		 // echo '<br/> db    <pre>::::'; print_r($db);
        $groups = $db->loadObjectList();
 
        // Check for a database error.
        if ($db->getErrorNum()) {
                JError::raiseNotice(500, $db->getErrorMsg());
                return null;
        }
				// echo '<br/> group    <pre>::::'; print_r($groups);
				// die;
				// echo '<br/> attributes<<<<????    <pre>::::'; print_r($this->fieldname);
				// echo '<br/> this    <pre>::::'; print_r($this);
  
				  //make select element
				/* echo '<select name="jform[params]['.$this->fieldname.']" size="0">';
				foreach($groups as $group){
				echo '<option value="'.$group->id.'"';
				// if(in_array($this->value, $users_groups_array)){
				if($this->value==$group->id){
					echo ' selected="selected"';
				}
				echo '>'.htmlspecialchars($group->title).'</option>';
				}
				echo '</select>';
				
				 */

				//joomla style dropdown
				echo '<select name="jform[params]['.$this->fieldname.']" size="0">';
				for ($i = 0, $n = count($groups); $i < $n; $i++)
				{
					if($groups[$i]->id == 1 ||$groups[$i]->id == 2 || $groups[$i]->parent_id == 2 || $groups[$i]->parent_id == 3 || $groups[$i]->parent_id == 4){
					
						$groups[$i]->text = str_repeat('- ', $groups[$i]->level) . $groups[$i]->title;
						
						
						echo '<option value="'.$groups[$i]->id.'"';
						// if(in_array($this->value, $users_groups_array)){
						if($this->value==$groups[$i]->id){
							echo ' selected="selected"';
							}
						echo '>'.htmlspecialchars($groups[$i]->text).'</option>';
					}
				}
					
				echo '</select>';
			
  
				//joomla style dropdown ends here
	}

}
// $obj = new JFormField();
// $obj::usergroups();
