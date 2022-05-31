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
$route['default_controller'] = 'Home';
$route['404_override'] = 'Home/custom_404';
$route['translate_uri_dashes'] = FALSE;

$route['VerifyLogin/(:any)'] = 'Home';
$route['Accounts/(:any)'] = 'Home';
$route['Status/(:any)'] = 'Home';
$route['Home/(:any)'] = 'Home';
$route['BasicController/(:any)'] = 'Home';
$route['Payments/(:any)'] = 'Home';
$route['Users/(:any)'] = 'Home';

$route['login'] = 'VerifyLogin';
$route['logout'] = 'VerifyLogin/logout';
$route['resetpassword'] = 'VerifyLogin/reset_password';

$route['dashboard'] = 'Home/dashboard';
$route['changepassword'] = 'VerifyLogin/change_password';
$route['userprofile'] = 'VerifyLogin/user_profile_update';
$route['userprofilepic'] = 'VerifyLogin/user_profile_picture_update';

$route['add_user'] = 'Users/add_user';
$route['manage_user'] = 'Users/manage_user';
$route['edit_user'] = 'Users/edit_user';
$route['unlock_user'] = 'Users/unlock_user';

$route['add_account_single'] = 'Accounts/add_account_single';
// $route['add_account_batch'] = 'Accounts/add_account_batch';
$route['edit_account'] = 'Accounts/edit_account';

$route['uploaded_accounts'] = 'Status/uploaded_accounts';
$route['rejected_accounts'] = 'Status/rejected_accounts';

$route['payment_request'] = 'Payments/payment_request';
$route['payment_status'] = 'Payments/payment_status';


$route['ajax-get-sub-category/(:any)'] = 'BasicController/ajaxRequestGetSubCategory/$1';
$route['ajax-get-template-info/(:any)'] = 'BasicController/ajaxRequestGetTemplateInfo/$1';
$route['ajax-get-field-info/(:any)'] = 'BasicController/ajaxRequestGetFieldInfo/$1';
$route['ajax-is-load-email/(:any)'] = 'BasicController/ajaxRequestGetLoadEmail/$1';
$route['ajax-load-email'] = 'BasicController/ajaxRequestGetEmailDetails';

$route['newuser'] = 'VerifyLogin/new_user';