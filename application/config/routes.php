<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "event";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/

// $route['admin'] = 'admin'; //admin page
$route['admin/users'] = "admin/users";
$route['admin/users/(:num)'] = "admin/users/$1";

$route['search'] = 'event/search';
$route['score'] = 'event/score';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';
$route['verify'] = 'auth/verify';

$route['forgot_password'] = "auth/forgotPassword";
$route['reset_password'] = "auth/resetPassword";
$route['reset_password_confirm'] = "auth/resetPasswordConfirm";
$route['reset_password_confirm/(:any)'] = "auth/resetPasswordConfirm/$1";
$route['reset_password_confirm/(:any)/(:any)'] = "auth/resetPasswordConfirm/$1/$2";
$route['create_new_password'] = "auth/createNewPassword";
$route['checkEmailExists'] = "auth/checkEmailExists";
$route['loginMe'] = 'auth/loginMe';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
