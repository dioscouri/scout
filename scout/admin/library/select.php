<?php
/**
* @version		0.1.0
* @package		Scout
* @copyright	Copyright (C) 2009 DT Design Inc. All rights reserved.
* @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link 		http://www.dioscouri.com
*/

require_once( JPATH_SITE.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'html'.DS.'select.php' );

class ScoutSelect extends JHTMLSelect
{
	/**
	* Generates a yes/no radio list
	*
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the radio list
	*/
	public static function booleans( $selected, $name = 'filter_enabled', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title='Select State', $yes = 'Enabled', $no = 'Disabled' )
	{
	    $list = array();
		if($allowAny) {
			$list[] =  self::option('', "- ".JText::_( $title )." -" );
		}

		$list[] = JHTML::_('select.option',  '0', JText::_( $no ) );
		$list[] = JHTML::_('select.option',  '1', JText::_( $yes ) );

		return self::genericlist($list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}

	/**
	* Generates range list
	*
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the radio list
	*/
	public static function range( $selected, $name = 'filter_range', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Range' )
	{
	    $list = array();
		if($allowAny) {
			$list[] =  self::option('', "- ".JText::_( $title )." -" );
		}

		$list[] = JHTML::_('select.option',  'today', JText::_( "Today" ) );
		$list[] = JHTML::_('select.option',  'yesterday', JText::_( "Yesterday" ) );
		$list[] = JHTML::_('select.option',  'last_seven', JText::_( "Last Seven Days" ) );
		$list[] = JHTML::_('select.option',  'last_thirty', JText::_( "Last Thirty Days" ) );
		$list[] = JHTML::_('select.option',  'ytd', JText::_( "Year to Date" ) );

		return self::genericlist($list, $name, $attribs, 'value', 'text', $selected, $idtag );
	}

    /**
    * Generates a created/modified select list
    *
    * @param string The value of the HTML name attribute
    * @param string Additional HTML attributes for the <select> tag
    * @param mixed The key that is selected
    * @returns string HTML for the radio list
    */
    public static function datetype( $selected, $name = 'filter_datetype', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title='Select Type' )
    {
        $list = array();
        if($allowAny) {
            $list[] =  self::option('', "- ".JText::_( $title )." -" );
        }

        $list[] = JHTML::_('select.option',  'created', JText::_( "Created" ) );
        $list[] = JHTML::_('select.option',  'modified', JText::_( "Modified" ) );
        
        return self::genericlist($list, $name, $attribs, 'value', 'text', $selected, $idtag );
    }
}
