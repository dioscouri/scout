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

// Check the registry to see if our Scout class has been overridden
if ( !class_exists('Scout') ) 
    JLoader::register( "Scout", JPATH_ADMINISTRATOR."/components/com_scout/defines.php" );

// before executing any tasks, check the integrity of the installation
Scout::getClass( 'ScoutHelperDiagnostics', 'helpers.diagnostics' )->checkInstallation();

// Require the base controller
Scout::load( 'ScoutController', 'controller' );

// Require specific controller if requested
$controller = JRequest::getWord('controller', JRequest::getVar( 'view' ) );
if (!Scout::load( 'ScoutController'.$controller, "controllers.$controller" ))
    $controller = '';

if (empty($controller))
{
    // redirect to default
	$default_controller = new ScoutController();
	$redirect = "index.php?option=com_scout&view=" . $default_controller->default_view;
    $redirect = JRoute::_( $redirect, false );
    JFactory::getApplication()->redirect( $redirect );
}

DSC::loadBootstrap();

JHTML::_('stylesheet', 'common.css', 'media/dioscouri/css/');
JHTML::_('stylesheet', 'admin.css', 'media/com_scout/css/');

$doc = JFactory::getDocument();
$uri = JURI::getInstance();
$js = "var com_scout = {};\n";
$js.= "com_scout.jbase = '".$uri->root()."';\n";
$doc->addScriptDeclaration($js);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_scout/helpers';
DSCLoader::discover('ScoutHelper', $parentPath, true);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_scout/library';
DSCLoader::discover('Scout', $parentPath, true);

// load the plugins
JPluginHelper::importPlugin( 'scout' );

// Create the controller
$classname = 'ScoutController'.$controller;
$controller = Scout::getClass( $classname );
    
// ensure a valid task exists
$task = JRequest::getVar('task');
if (empty($task))
{
    $task = 'display';
    JRequest::setVar( 'layout', 'default' );
}
JRequest::setVar( 'task', $task );

// Perform the requested task
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();

?>