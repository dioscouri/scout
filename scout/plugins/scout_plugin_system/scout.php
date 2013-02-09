<?php
/**
 * @version 1.5
 * @package Scout
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

/** Import library dependencies */
jimport('joomla.plugin.plugin');

class plgSystemScout extends JPlugin 
{
    function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
    }

    /**
     * 
     * @return unknown_type
     */
    function _isInstalled()
    {
        $success = false;
        
        jimport('joomla.filesystem.file');
        if (JFile::exists(JPATH_ADMINISTRATOR.'/components/com_scout/helpers/_base.php')) 
        {
            $success = true;
        }
                
        return $success;
    }
    
    /**
     * 
     * @return unknown_type
     */
    function onAfterInitialise() 
    {
        $success = null;
        if (!$this->_isInstalled()) 
        {
            return $success;
        }
        
        $user_id = JFactory::getUser()->id;
        if (empty($user_id))
        {
            return null;
        }
        
        // get the option variable
        $option = JRequest::getCmd( 'option' );
        
        // does a connector exist for this option?
        if (!$this->connectorExists( $option )) 
        {
            // if not, quietly exit
            return $success;
        }        

        // if connector exists, create its object
		$name = str_replace("_", "", $option);
        $classname = 'plgScout'.$name;
        $object = new $classname( );
        
        // then run ->createLogEntry()
        $object->createLogEntry();
        
        return $success;
    }
    
    /**
     * Checks if a component-specific connector exists 
     * 
     * @return boolean
     */
    function connectorExists( $option )
    {
        $success = false;
        
        jimport('joomla.filesystem.file');
        $file = JPATH_SITE.DS.'plugins/system/scout'.DS.$option.'.php';
        if (JFile::exists( $file )) 
        {
            require_once( $file );
            $success = true;
        }
                
        return $success;
    }
}
