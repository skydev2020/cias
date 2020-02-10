<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Auth (AuthController)
 * Auth class to control to authenticate user credentials and starts user's session.
 * @version : 1.1
 * @since : 5 Feb 2020
 */
class Auth extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('mandrill', array(MANDRILL_API_KEY));
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            // $this->load->view('login');
            redirect('/events');
        }
        else
        {
            // redirect('/dashboard');
            redirect('/events');
        }
    }
    
    
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
                                        'roleText'=>$result->role,
                                        'name'=>$result->name,
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
            

            $this->load->view('includes/header', $data);
            $this->load->view('auth/forgot_password', $data);
            $this->load->view('includes/footer', $data);          
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
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect('forgot_password');
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
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post("email"));
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
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

            redirect("/login");
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
}

?>