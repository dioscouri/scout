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

if ( !class_exists('Scout') ) 
             JLoader::register( "Scout", JPATH_ADMINISTRATOR."/components/com_scout/defines.php" );
        

Scout::load('ScoutModelBase','models.base');

class ScoutModelConfig extends ScoutModelBase 
{
}
