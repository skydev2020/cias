<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Event_model (Event Model)
 * Event model class to get to handle user related data 
 * @version : 1.0
 * @since : 09 Feb 2020
 */
class Event_model extends CI_Model
{
    
    /**
     * This function is used to get the event listings
     * @param string $query : This is optional search text
     * @return array $result : This is result
     */
    function eventListing($q = '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_events as BaseTbl');
        if(!empty($q)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%".$q."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
}

  