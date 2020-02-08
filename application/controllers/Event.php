<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Event (EventController)
 * Event Class to control all event related operations.
 * @author : Sky Dev
 * @version : 1.0
 * @since : 5 Feb 2020
 */
class Event extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('event_model');
        // $this->isLoggedIn();
        var_dump($this->uri->uri_string());

        if ($this->uri->uri_string() == 'event/login') {
            redirect('login');
            return;
        }
        
        if ($this->uri->uri_string() == 'event/search') {
            redirect('search');
            return;
        }

        if ($this->uri->uri_string() != 'search' && $this->uri->uri_string() != 'login' && $this->isLoggedIn() == false) {
            redirect('login');
            return;
        }  

        if ($this->uri->uri_string() == 'login' && $this->isLoggedIn() == true) {
            if ($this->isAdmin() ==true) {
                redirect('admin/users');
            }
            else {
                redirect('');
            }
        }        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->search();        
    }
    
    /**
     * This function is used to search the event
     */
    function search()
    {
        $this->global['pageTitle'] = 'Event List';
        
        $q = $this->security->xss_clean($this->input->get_post('q'));          
        $data['eventRecords'] = $this->event_model->eventListing($q);
        $this->loadViews("events/search", $this->global, $data , NULL);
    }

    /**
     * This function is used to show the scores of specific event
     */
    function score()
    {
        if ($this->isLoggedIn() != true) {           
            // show admin login page
            redirect('login');
            return;                
        }

        $this->global['pageTitle'] = 'Event List';
        $this->loadViews("events/score", $this->global, NULL , NULL);
    }

    function login(){
        // if Get Request, Load Login Page, if Post Request, Check Login
        if ($this->input->server('REQUEST_METHOD') =='GET') {
            $this->load->view('events/login');
        }
        else {
            $this->load->library('form_validation');
        
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
            if($this->form_validation->run() == FALSE)
            {
                redirect('login');
            }
            else
            {
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                
                $result = $this->login_model->loginMe($email, $password, false);
               
                if(!empty($result))
                {
                    $lastLogin = $this->login_model->lastLoginInfo($result->userId);

                    $sessionArray = array('userId'=>$result->userId,                    
                                            'role'=>$result->roleId,
                                            'roleText'=>$result->role,
                                            'name'=>$result->name,
                                            'lastLogin'=> $lastLogin->createdDtm,
                                            'isLoggedIn' => TRUE
                                        );
                

                    $this->session->set_userdata($sessionArray);
                    
                    unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                    $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                    $this->login_model->lastLogin($loginInfo);
                    
                    if ($result->roleId == ROLE_ADMIN) {
                        redirect('admin/users');
                    }
                    else {
                        redirect('');
                    }
                }
                else
                {   
                    $this->session->set_flashdata('error', 'Email or password mismatch');
                    
                    redirect('login');
                }
            }
        }
    }
    

   
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

  
}

?>