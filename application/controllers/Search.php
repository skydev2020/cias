<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Search (SearchController)
 * Search Class to control all event related operations.
 * @author : Sky Dev
 * @version : 1.0
 * @since : 7 Feb 2020
 */
class Search extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Event List';
        
        $this->loadViews("search", $this->global, NULL , NULL);
    }
    
}

?>