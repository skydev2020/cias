<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Admin (AdminController)
 * Admin Class to control all Admin related operations.
 * @author : Sky Dev
 * @version : 1.0
 * @since : 2 Feb 2020
 */
class Admin extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('auth_model');  

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
        if ($this->isLoggedInAsAdmin()){
            redirect('admin/users');
        }
        else if ($this->isLoggedIn() == true) {           
            // show admin login page
            redirect('');
            // $this->load->view("admin\login", $this->global);                
        }
        else {
            redirect('login');
        }
       
    }

    /**
     * This function used to load the first screen of the user
     */
    public function getUser($userId = null)
    {

        if (!$this->isLoggedInAsAdmin()) {
            redirect('');
            return;
        }
        $data['admin_name'] = "Admin";
        if ($userId==null) {
            redirect('admin/users');
            return;
        }
       
        if ($userId!=null && $this->input->server('REQUEST_METHOD') =='GET') {
                        
            $data['userInfo'] = $this->user_model->getUserInfo($userId);

            if ($data['userInfo'] == null) {
                
                $this->global['pageTitle'] = '404 Error';
                $data['module'] = $this->load->view('admin/404', null, true);            
                $this->loadViews("admin/tmpl", $this->global, $data, NULL);
            }
            else {
                if ($data['userInfo']->roleId == 1) {
                    $this->global['pageTitle'] = 'Administrator : Edit User';    
                }
                else  {
                    $this->global['pageTitle'] = 'Swimmeetcast : Edit User';
                }
                    
                //Prepare the User Edit
                $data['module'] = $this->load->view('admin/user_edit', $data, true);
            
                $this->loadViews("admin/tmpl", $this->global, $data, NULL);
            }
            
        }
    }

   
    /**
     * This function used to load the first screen of the user
     */
    public function users()
    {
    
        if (!$this->isLoggedInAsAdmin()) {
            redirect('');
            return;
        }
        
        $q = $this->security->xss_clean($this->input->post('q'));
        var_dump($q);
        $q = trim($q);
        $data['q'] = $q;

        $this->load->library('pagination');
     
        $count = $this->user_model->userListingCount($q);
        $returns = $this->paginationCompress ( "admin/users/", $count, 10, 3 );            
        $data['userRecords'] = $this->user_model->userListing($q, $returns["page"], $returns["segment"]);
        
        $this->global['pageTitle'] = 'Swimmeetcast : User Listing'; 
        
        //Prepare the User search
        $data['module'] = $this->load->view('admin/user_list', $data, true);
        
        $this->loadViews("admin/tmpl", $this->global, $data, NULL);
        
    }

     /**
     * This function used to lock/unlock user
     */
    public function lock($userId = null) {

        if (!$this->isLoggedInAsAdmin()) {
            redirect('admin');
            return;
        }
       
        if ($userId==null || $this->input->server('REQUEST_METHOD') =='POST') {
            redirect("admin/users");
            return;
        }
        
        $user = $this->user_model->getUserInfo($userId);

        if ($user == null) {
            $this->session->set_flashdata('error', 'User Object does not exist');
            redirect("admin/users");
            return;
        }

        $userInfo = array('updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
        
        if ($user->isLocked == 1) {
            $userInfo['isLocked'] = 0;
        }
        else {
            $userInfo['isLocked'] = 1;
        }
        
        $result = $this->user_model->editUser($userInfo, $userId);
        $this->session->set_flashdata('success', 'User details successfully updated');
        redirect("admin/users");
    
    }
    

    /**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedInAsAdmin() {
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
        $this->role = $this->session->userdata ( 'role' );
        if ($isLoggedIn == true && $this->role == ROLE_ADMIN) {
            
            $this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'userId' );
            $this->fname = $this->session->userdata ( 'fname' );
            $this->lname = $this->session->userdata ( 'lname' );
			$this->roleText = $this->session->userdata ( 'roleText' );
            $this->lastLogin = $this->session->userdata ( 'lastLogin' );

            $this->global ['fname'] = $this->fname;
            $this->global ['lname'] = $this->lname;
            $this->global ['role'] = $this->role;
            $this->global ['role_text'] = $this->roleText;
            $this->global ['last_login'] = $this->lastLogin;

            return true;
        }
        return false;
	}
    
   

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if (!$this->isLoggedInAsAdmin()) {
            redirect('admin');
            return;
        }

    
        $this->load->model('user_model');
        $data = [];
        // $data['roles'] = $this->user_model->getUserRoles();
        
        $this->global['pageTitle'] = 'Swimmeetcast : Add New User';

        //Prepare the User Edit
        $data['module'] = $this->load->view('admin/user_new', $data, true);
    
        $this->loadViews("admin/tmpl", $this->global, $data, NULL);
        
    }

    
    /**
     * This function is used to edit the user information
     */
    function editUser($userId = NULL)
    {
        
        if (!$this->isLoggedInAsAdmin()) {
            redirect('admin');
            return;
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','First Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('lname','Last Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role','Role','trim|required|numeric');
            // $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                redirect('admin');
                return;
            }
            else
            {
                $fname = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('lname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $fname = trim($fname);
                $lname = trim($lname);
                $email = trim($email);
                $password = trim($password);
                // $roleId = $this->input->post('role');    
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'fname'=>$fname, 'lname'=>$lname,
                                    'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'fname'=>ucwords($fname),
                        'lname'=>ucwords($lname),  'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('admin');
                return;
            }
        }
    }

    /**
     * This function is used to add new user to the system in Admin Panel
     */
    function newUser()
    {
        if (!$this->isLoggedInAsAdmin()) {
            redirect('admin');
            return;
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','First Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('lname','Last Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $fname = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('lname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                
                $fname = trim($fname);
                $lname = trim($lname);
                $email = trim($email);
                $password = trim($password);

                
                if ($this->auth_model->checkEmailExist($email) != null) {
                    // Check whether user already exists 
                    $this->session->set_flashdata('error', 'Same Email is already exists.');
                    redirect('admin');
                }

                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'fname'=> $fname, 'lname'=> $lname,
                                    'createdBy'=> 1, 'isVerified'=> 1, 
                                    'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('admin');
            }
        }
    }

  
    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function user_del()
    {
        if (!$this->isLoggedInAsAdmin()) {
            echo(json_encode(array('status'=>'access')));
            return;
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
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
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }
}

?>