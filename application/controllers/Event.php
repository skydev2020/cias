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
        $this->load->model('login_model');
        $this->load->model('event_model');
        $this->load->model('user_model');
                
        if ($this->uri->uri_string() == 'event/login') {
            redirect('login');
            return;
        }
        
        if ($this->uri->uri_string() == 'event/search') {
            redirect('search');
            return;
        }
        
        if ($this->uri->uri_string() == 'register' && $this->isLoggedIn() == true) {            
            redirect('');
            return;           
        } 
        
        if ($this->uri->uri_string() != '' && $this->uri->uri_string() != 'register'  && $this->uri->uri_string() != 'search' 
        && $this->uri->uri_string() != 'login' && $this->uri->uri_string() != 'verify' && $this->isLoggedIn() == false) {
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
        $this->global['pageTitle'] = 'Event List';
        
        $q = $this->security->xss_clean($this->input->get_post('q'));         
        $data['q'] = $q; 
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

        $id = $this->security->xss_clean($this->input->get_post('id'));         
        
        $data['event'] = $this->event_model->getEvent($id);
        $data['swimmingData'] = json_decode($data['event']->swimming);

        $this->global['pageTitle'] = 'Score Page';
        $this->loadViews("events/score", $this->global, $data , NULL);
    }

    function login(){
        // if Get Request, Load Login Page, if Post Request, Check Login
        if ($this->input->server('REQUEST_METHOD') =='GET') {
            $this->global['pageTitle'] = 'Login Page';
            $this->loadViews("events/login", $this->global, null , NULL);            
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
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->global['pageTitle'] = 'Register User Page';
                $this->loadViews("events/register_user", $this->global, null , NULL);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $verification_code = uniqid(rand(), true);
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'name'=> $name, 'roleId'=> 0,
                                    'mobile'=>$mobile, 'createdBy'=> 0, 
                                    'verification_code'=>$verification_code, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0){
                    
                    /**
                     * Send a email to a user with a verification code
                     */

                    // $config = Array(
                    //     'protocol' => 'smtp',
                    //     'smtp_host' => 'ssl://stmp.googlemail.com',
                    //     'smtp_port' => 465,
                    //     'smtp_user' => 'newcaesar628@gmail.com', // change it to yours
                    //     'smtp_pass' => 'Top12345', // change it to yours
                    //     'mailtype' => 'html',
                    //     'charset' => 'iso-8859-1',
                    //     'newline' => '\r\n',
                    //     'wordwrap' => TRUE
                    //   );
                      
                    
                    // $this->load->library('email', $config);
        

                    // $this->email->from('admin@cias.com', 'Admin User in CIAS');
                    // $this->email->to($email);
                    
                    // $this->email->subject('User Signup');
                    // $email_msg = "Please click link to verify your email. <br/>";
                    // $email_msg .= "<a href='".base_url()."verify?email=". $email. "code=" . $verification_code . "></a>";
                    // $this->email->message($email_msg);
                    $this->load->library('phpmailer_lib');
                    // PHPMailer object
                    $mail = $this->phpmailer_lib->load();

                    $to = $email;
                    $from = "admin@cias.com";
                    $name = "Administrator";
                    $subject = "User Signup";
                    // $number = $_REQUEST['number'];
                    $cmessage = "Please click link to verify your email. <br/>";
                    $cmessage .= "<a href='".base_url()."verify?email=". $email. "&code=" . $verification_code . "></a>";
                    
                    $headers = "From: $from";
                    $headers = "From: " . $from . "\r\n";
                    $headers .= "Reply-To: ". $from . "\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    
                    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
                    $body .= $cmessage;
                    $body .= "</body></html>";
                    
                    $mail->IsSMTP();
                    $mail->CharSet = 'UTF-8';
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'newcaesar628@gmail.com';
                    $mail->Password   = 'Top12345';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port       = 465;

                    //Recipients
                    $mail->From = $from;
                    $mail->FromName= $name;
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $body;
                    $mail->addAddress($to);

                    var_dump($cmessage);
                    die();

                    if ($mail->send()==true) {
                        $this->session->set_flashdata('success', 'Email Verification Code Sent');
                        $this->global['pageTitle'] = 'Email Verification Code Sent';
                        $this->loadViews("events/reg_email_sent", $this->global, null , NULL);
                    }
                    else {
                        var_dump($mail);
                        die();
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
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * Page not found : error 404
     */
    function verify() {
        
        $email = $this->security->xss_clean($this->input->get_post('email'));         
        $code = $this->security->xss_clean($this->input->get_post('code'));         
        
        $user = $this->user_model->get_by_email_code($email, $code);


        if ($user == null) {
            $this->load->view("events/verification_failed", null);
        }
        else {
            //update/verify user object
            $user->isVerified = 1;
            $user->verification_code = '';
            $this->user_model->updateUser($user->userId, $user);
            $this->load->view("events/verification_success", null);
        }
        
    }
  
}

?>