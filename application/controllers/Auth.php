<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Auth (AuthController)
 * Auth class to control to authenticate user credentials and starts user's session.
 * @version : 1.1
 * @since : 5 Feb 2020
 */
class Auth extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('user_model');
        $this->load->library('mandrill', array(MANDRILL_API_KEY));

        if ($this->uri->uri_string() == 'auth/login') {
            redirect('login');
            return;
        }
        
        if ($this->uri->uri_string() == 'register' && $this->isLoggedIn() == true) {            
            redirect('');
            return;           
        } 
        
        if ($this->uri->uri_string() != '' && $this->uri->uri_string() != 'register'  && $this->uri->uri_string() != 'search' 
        && $this->uri->uri_string() != 'login' && $this->uri->uri_string() != 'verify' && $this->uri->uri_string() != 'forgot_password'
        && $this->uri->uri_string() != 'resetPassword' && $this->isLoggedIn() == true) {
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
     * Index Page for this controller.
     */
    public function index()
    {
        // $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    // function isLoggedIn()
    // {
    //     $isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
		
	// 	if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
	// 		return false;
	// 	} else {
	// 		$this->role = $this->session->userdata ( 'role' );
	// 		$this->vendorId = $this->session->userdata ( 'userId' );
	// 		$this->name = $this->session->userdata ( 'name' );
	// 		$this->roleText = $this->session->userdata ( 'roleText' );
	// 		$this->lastLogin = $this->session->userdata ( 'lastLogin' );
			
	// 		$this->global ['name'] = $this->name;
	// 		$this->global ['role'] = $this->role;
	// 		$this->global ['role_text'] = $this->roleText;
	// 		$this->global ['last_login'] = $this->lastLogin;
	// 		return true;
	// 	}
    // }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            
            $result = $this->auth_model->loginMe($email, $password);
            
            if(!empty($result))
            {
                $lastLogin = $this->auth_model->lastLoginInfo($result->userId);

                $sessionArray = array('userId'=>$result->userId,                    
                                        'role'=>$result->roleId,
                                        'fname'=>$result->fname,
                                        'lname'=>$result->lname,
                                        'lastLogin'=> $lastLogin->createdDtm,
                                        'isLoggedIn' => TRUE
                                );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                $this->auth_model->lastLogin($loginInfo);
                
                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                $this->index();
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {             
            $this->global['pageTitle'] = 'Login Page';         
            $data= [
                'pageTitle' => 'Forgot Password',
                'uri'=>  $this->uri->uri_string(),
                'logged_in' => $isLoggedIn
            ];
            
            $this->load->view('auth/forgot_password', $data);                  
        }
        else
        {
            redirect('');
        }
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPassword()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            
            if($this->auth_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->auth_model->resetPassword($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "reset_password_confirm/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->auth_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["fname"] = $userInfo->fname;
                        $data1["lname"] = $userInfo->lname;
                        $data1["email"] = $userInfo->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = $this->resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "success";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "error";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'error';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'error';
                setFlashData($status, "This email is not registered with us.");
            }
            $this->forgotPassword();
        }
    }

    /**
     * This function used to reset the password 
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function resetPasswordConfirm($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->auth_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('auth/new_password', $data);
        }
        else
        {
            redirect('login');
        }
    }
    
    /**
     * This function used to create new password for user
     */
    function createNewPassword() {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post("email"));
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirm($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->auth_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->auth_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password reset successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password reset failed';
            }
            
            setFlashData($status, $message);

            redirect("login");
        }
    }


    function resetPasswordEmail($detail) {
        $email_data["data"] = $detail;
        // pre($detail);
        // die;
 
        $email_msg = $this->load->view('email/resetPassword', $email_data, TRUE); 
        
        $params = array(
            "html" => $email_msg,
            "text" => null,
            "from_email" => EMAIL_FROM,
            "from_name" => FROM_NAME,
            "subject" => "Password Reset",
            "to" => array(array("email" => $detail['email'])),
            "track_opens" => true,
            "track_clicks" => true,
            "auto_text" => true
        );
    
        $mail_sent = $this->mandrill->messages->send($params, true);
        if (is_array($mail_sent) && count($mail_sent) > 0 && $mail_sent[0]['status']=="sent") {
            return true;
        }
        else {
            return false;
        }
        
    }


    function login() {
        // if Get Request, Load Login Page, if Post Request, Check Login
        if ($this->input->server('REQUEST_METHOD') =='GET') {
            $this->global['pageTitle'] = 'Login Page';
            // $this->loadViews("auth/login", $this->global, null , NULL);
            $this->load->view('auth/login', null);          
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
                
                $result = $this->auth_model->loginMe($email, $password, false);
         
                if(!empty($result))
                {
                    $lastLogin = $this->auth_model->lastLoginInfo($result->userId);

                    $sessionArray = array('userId'=>$result->userId,                    
                                            'role'=>$result->roleId,
                                            'fname'=>$result->fname,
                                            'lname'=>$result->lname,
                                            'lastLogin'=> $lastLogin->createdDtm,
                                            'isLoggedIn' => TRUE
                                        );
                

                    $this->session->set_userdata($sessionArray);
                    
                    unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                    $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                    $this->auth_model->lastLogin($loginInfo);
                    
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
            $this->load->view('auth/register_user', null);   
            return;           
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
                $this->load->view('auth/register_user', null);   
                return;           
            }
            else
            {
                $fname = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('lname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));

                if ($this->auth_model->checkEmailExist($email) != null) {
                    // Check whether user already exists 
                    $this->session->set_flashdata('error', 'Same Email is already exists.');
                    $this->global['pageTitle'] = 'User Signup Error';
                    $this->load->view('auth/register_user', null);  
                    return; 
                }

                $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $verification_code = uniqid(rand(), true);
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'fname'=> $fname, 'lname'=> $lname,
                                'roleId'=> 0, 'createdBy'=> 0, 
                                'verification_code'=>$verification_code, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0){
                    
                    /**
                     * Send a email to a user with a verification code
                     */
                                                           
                   
                    $data['verification_link'] = base_url()."verify?email=". $email. "&code=" . $verification_code;
                    $data['fname'] = $fname;
                    $data['lname'] = $lname;
                    $email_msg =  $this->load->view('email/verification_content', $data, true);
                   
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
                        $this->load->view('auth/reg_email_sent', null);   
                        // $this->loadViews("auth/reg_email_sent", $this->global, null , NULL);
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occured. Please contact administrator');
                        $this->global['pageTitle'] = 'User Signup Error';
                        $this->load->view('auth/reg_email_sent', null);   
                        // $this->loadViews("auth/reg_email_sent", $this->global, null , NULL);
                    }                   
                }
                else{
                    
                    $this->session->set_flashdata('error', 'User creation failed');
                    $this->global['pageTitle'] = 'Register User Page';
                    $this->loadViews("auth/register_user", $this->global, null , NULL);
                }
                
                
            }
        }
    }

    function verify() {
        
        $email = $this->security->xss_clean($this->input->get_post('email'));         
        $code = $this->security->xss_clean($this->input->get_post('code'));         
        
        $user = $this->user_model->get_by_email_code($email, $code);


        if ($user == null) {
            $this->load->view("auth/verification_failed", null);
        }
        else {
            //update/verify user object
            $user->isVerified = 1;
            $user->verification_code = '';
            $this->user_model->updateUser($user->userId, $user);
            $this->load->view("auth/verification_success", null);
        }
        
    }
}

?>