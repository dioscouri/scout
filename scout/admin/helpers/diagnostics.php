<?php
/**
 * @version	1.5
 * @package	Scout
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

class ScoutHelperDiagnostics extends DSCHelperDiagnostics 
{
	/**
	 * Performs basic checks on your Scout installation to ensure it is configured OK
	 * @return unknown_type
	 */
	function checkInstallation() 
	{
		// TODO check all DB tables
		// TODO if no articles associated for site::dashboard, create default articles for dashboard
			// and update config
	}

}