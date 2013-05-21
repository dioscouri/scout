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

class ScoutModelScopes extends ScoutModelBase 
{
    protected function _buildQueryWhere(&$query)
    {
       	$filter     = $this->getState('filter');
        $filter_id_from	= $this->getState('filter_id_from');
        $filter_id_to	= $this->getState('filter_id_to');
        $filter_name	= $this->getState('filter_name');
        $filter_identifier   = $this->getState('filter_identifier');
        $filter_url     = $this->getState('filter_url');
        $filter_client     = $this->getState('filter_client');

       	if ($filter) 
       	{
			$key	= $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');

			$where = array();
			$where[] = 'LOWER(tbl.scope_id) LIKE '.$key;
			$where[] = 'LOWER(tbl.scope_name) LIKE '.$key;
			$where[] = 'LOWER(tbl.scope_identifier) LIKE '.$key;
			$where[] = 'LOWER(tbl.scope_url) LIKE '.$key;
			
			$query->where('('.implode(' OR ', $where).')');
       	}
       	
		if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
        	{
        		$query->where('tbl.scope_id >= '.(int) $filter_id_from);	
        	}
        		else
        	{
        		$query->where('tbl.scope_id = '.(int) $filter_id_from);
        	}
       	}
       	
		if (strlen($filter_id_to))
        {
        	$query->where('tbl.scope_id <= '.(int) $filter_id_to);
       	}
       	
    	if (strlen($filter_name))
        {
        	$key	= $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_name ) ) ).'%');
        	$query->where('LOWER(tbl.scope_name) LIKE '.$key);
       	}

       	if (strlen($filter_identifier))
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_identifier ) ) ).'%');
            $query->where('LOWER(tbl.scope_identifier) LIKE '.$key);
        }
        
        if (strlen($filter_url))
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_url ) ) ).'%');
            $query->where('LOWER(tbl.scope_url) LIKE '.$key);
        }
        
        if (strlen($filter_client))
        {
            $query->where('tbl.client_id = '.(int) $filter_client);
        }
    }
     
  protected function prepareItem( &$item, $key=0, $refresh=false )
    {
      $item->link = 'index.php?option=com_scout&controller=scopes&view=scopes&task=edit&id='.$item->scope_id;
            
            parent::prepareItem($item, $key, $refresh );
        
    }


}
