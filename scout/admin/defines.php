<?php
/**
* @version		0.1.0
* @package		Scout
* @copyright	Copyright (C) 2009 DT Design Inc. All rights reserved.
* @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link 		http://www.dioscouri.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class Scout extends DSC
{
    protected $_version 		= '0.1.0';
    protected $_versiontype    = 'community';
    protected $_copyrightyear 	= '2010';
    protected $_name 			= 'scout';
    protected $_min_php		= '5.3';

    public $show_linkback						= '1';
	public $page_tooltip_dashboard_disabled	= '0';
	public $page_tooltip_config_disabled		= '0';
	public $page_tooltip_tools_disabled		= '0';
    
    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    public function _buildQuery()
    {
        $query = "SELECT * FROM #__scout_config";
        return $query;
    }
    
    /**
     * Retrieves the data, using a cached set if possible
     *
     * @return array Array of objects containing the data from the database
     */
    public function getData()
    {
        $cache = JFactory::getCache('com_scout.defines');
        $cache->setCaching(true);
        $cache->setLifeTime('86400');
        $data = $cache->call( array($this, 'loadData') );
        return $data;
    }
    
    /**
     * Loads the data from the database
     */
    public function loadData()
    {
        $data = array();
    
        $database = JFactory::getDBO();
        if ($query = $this->_buildQuery())
        {
            $database->setQuery( $query );
            $data = $database->loadObjectList();
        }
    
        return $data;
    }
    
    /**
     * Get component config
     *
     * @acces   public
     * @return  object
     */
    public static function getInstance()
    {
        static $instance;
    
        if (!is_object($instance)) {
            $instance = new Scout();
        }
    
        return $instance;
    }
	

	/**
     * Intelligently loads instances of classes in framework
     *
     * Usage: $object = BIllets::getClass( 'BIlletsHelperCarts', 'helpers.carts' );
     * Usage: $suffix = BIllets::getClass( 'BIlletsHelperCarts', 'helpers.carts' )->getSuffix();
     * Usage: $categories = BIllets::getClass( 'BIlletsSelect', 'select' )->category( $selected );
     *
     * @param string $classname   The class name
     * @param string $filepath    The filepath ( dot notation )
     * @param array  $options
     * @return object of requested class (if possible), else a new JObject
     */
    public static function getClass( $classname, $filepath='controller', $options=array( 'site'=>'admin', 'type'=>'components', 'ext'=>'com_scout' )  )
    {
        return parent::getClass( $classname, $filepath, $options  );
    }
    
    /**
     * Method to intelligently load class files in the framework
     *
     * @param string $classname   The class name
     * @param string $filepath    The filepath ( dot notation )
     * @param array  $options
     * @return boolean
     */
    public static function load( $classname, $filepath='controller', $options=array( 'site'=>'admin', 'type'=>'components', 'ext'=>'com_scout' ) )
    {
        return parent::load( $classname, $filepath, $options  );
    }
	
}

class ScoutConfig extends Scout {}

?>