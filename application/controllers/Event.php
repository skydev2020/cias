<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Event (EventController)
 * Event Class to control all event related operations.
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
        $this->load->model('auth_model');
        $this->load->model('event_model');
        $this->load->model('user_model');
        $this->load->library('mandrill', array(MANDRILL_API_KEY));
                   
        $this->API_KEY = "0fb516885cdd494aa8c70015938f7950";

        if ($this->uri->uri_string() == 'event/search') {
            redirect('search');
            return;
        }
       
        if ($this->uri->uri_string() != ''   && $this->uri->uri_string() != 'search'   && $this->uri->uri_string() != 'event/api_push'
          && $this->isLoggedIn() == false) {
            redirect('login');
            return;
        }  


        if ($this->isLoggedIn() == true) {
            $this->global['logged_in'] = true; 
        }
        else {
            $this->global['logged_in'] = false;
        }
        
        $this->global['uri'] = $this->uri->uri_string();
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
        
        $this->global['pageTitle'] = 'Search - Swimmeetcast';
        
        $q = $this->security->xss_clean($this->input->get_post('q'));         
        $q = trim($q);
        $data['q'] = $q;       

        if ($q == "") {
            $data['eventRecords'] = [];
        }
        else if ($this->global['logged_in'] == true) {
            $data['eventRecords'] = $this->event_model->eventListing($q);
        }
        else {            
            $this->session->set_flashdata('error', 'To search, please log in.');                        
            redirect('login');
        }

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

        $id = $this->security->xss_clean($this->input->get_post('id'));         
        
        $data['event'] = $this->event_model->getEvent($id);
        $data['swimmingData'] = json_decode($data['event']->swimming);

        $this->global['pageTitle'] = 'Meet Score - Swimmeetcast';
        $this->loadViews("events/score", $this->global, $data , NULL);
    }

    

    /**
     * Show Register User Page
     * Register User into DB
     */
    function register(){
        // if Get Request, Load Login Page, if Post Request, Check Login
        if ($this->input->server('REQUEST_METHOD') =='GET') {
            $this->global['pageTitle'] = 'Register User Page';
            $this->loadViews("events/register_user", $this->global, null , NULL);            
        }
        else {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role','Role','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->global['pageTitle'] = 'Register User Page';
                $this->loadViews("events/register_user", $this->global, null , NULL);
            }
            else
            {
                $fname = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('lname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $verification_code = uniqid(rand(), true);
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'fname'=> $fname, 'lname'=> $lname,
                                'roleId'=> 0, 'mobile'=>$mobile, 'createdBy'=> 0, 
                                'verification_code'=>$verification_code, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0){
                    
                    /**
                     * Send a email to a user with a verification code
                     */
                                                           
                    $email_msg = "<p><h3>Please click link to verify your email.</h3></p> \r\n";
                    $email_msg .= "<p><a href=\"".htmlspecialchars(base_url())."verify?email=". $email. "&code=" . $verification_code . "\">Click here to verify</a></p>";
                 
                    $params = array(
                        "html" => $email_msg,
                        "text" => null,
                        "from_email" => EMAIL_FROM,
                        "from_name" => FROM_NAME,
                        "subject" => "User Registration",
                        "to" => array(array("email" => $email)),
                        "track_opens" => true,
                        "track_clicks" => true,
                        "auto_text" => true
                    );
                
                    $mail_sent = $this->mandrill->messages->send($params, true);

                    if (is_array($mail_sent) && count($mail_sent) > 0 && $mail_sent[0]['status']=="sent") {
                        $this->session->set_flashdata('success', 'Email Verification Code Sent');
                        $this->global['pageTitle'] = 'Email Verification Code Sent';
                        $this->loadViews("events/reg_email_sent", $this->global, null , NULL);
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occured. Please contact administrator');
                        $this->global['pageTitle'] = 'User Signup Error';
                        $this->loadViews("events/reg_email_sent", $this->global, null , NULL);
                    }                   
                }
                else{
                    
                    $this->session->set_flashdata('error', 'User creation failed');
                    $this->global['pageTitle'] = 'Register User Page';
                    $this->loadViews("events/register_user", $this->global, null , NULL);
                }
                
                
            }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Swimmeetcast : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * Rest API
     */
    function api_push() {
        $key = $this->security->xss_clean($this->input->post('key'));         
        $data = $this->security->xss_clean($this->input->post('data'));
        
        $key = trim($key);
        $data = trim($data);
        $rtr = "Invalid API";

        if ($key == $this->API_KEY) {
            
            $event_param = json_decode($data, true);
            if ($event_param) {
               
                //Insert Event Table: 
                /**
                 * field:
                 * ID": 29,
                 * "CustomerID": 1,    
                 * "Name": "Test Object",    
                 * "DateStart": "2020-02-01T00:00:00",    
                 * "DateEnd": "2020-02-01T00:00:00",    
                 * "DateAdded": "2020-02-01T09:33:33.0249571-06:00"
                 */
               
                $event = array(
                    'customer_id'=> $event_param['dbEvent']['CustomerID'], 
                    'name'=> $event_param['dbEvent']['Name'] , 
                    'date_start'=> $event_param['dbEvent']['DateStart'], 
                    'date_end'=> $event_param['dbEvent']['DateEnd'], 
                    'date_added'=> $event_param['dbEvent']['DateAdded'],
                    'swimming'=> json_encode($event_param['swimming'])
                );
                
                $result = $this->event_model->addEvent($event);
                
                if($result > 0){
                    $rtr = 'Success';
                }
                else {
                    $rtr = 'DBFail';
                }
            } else {
                $rtr = 'Invalid data format';
            }
        }
        echo $rtr;
    }
    
  
}

?>