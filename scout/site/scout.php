<?php
/**
 * @version	0.1
 * @package	Scout
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

// Require the defines
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'defines.php' );

// Require the base controller
require_once( JPATH_COMPONENT_SITE.DS.'controller.php' );

// Require specific controller if requested
if ($controller = JRequest::getWord('controller', JRequest::getVar( 'view' ) )) 
{
	$path = JPATH_COMPONENT_SITE.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}

// load the plugins
JPluginHelper::importPlugin( 'scout' );

// Create the controller
$classname    = 'ScoutController'.$controller;
$controller   = new $classname( );

// ensure a valid task exists
$task = JRequest::getVar('task');
if (empty($task))
{
    $task = 'display';	
}
JRequest::setVar( 'task', $task );

// Perform the requested task
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();

?>