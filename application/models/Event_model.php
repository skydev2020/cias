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


    /**
     * 
     * Get Event Info
     */
    function getEvent($id) {
        $this->db->select('*');
        $this->db->from('tbl_events');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
     /**
     * This function is used to add new event
     * @return number $insert_id : This is last inserted id
     */
    function addEvent($obj)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_events', $obj);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}

  