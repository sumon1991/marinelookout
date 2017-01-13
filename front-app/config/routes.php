<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']            = "home";
$route['sign_up']      					= 'home/sign_up';
$route['login']      					= 'home/sign_up';
$route['home/sign_up']      			= 'home/redirect';
$route['logout']      					= 'home/logout';
$route['home/general_login'] 			= 'home/general_login';
$route['home/subscribe']		 		= 'home/subscribe';
$route['examination/index/(:any)']      = 'examination/index/$1';
$route['examination/complete_exam']    	= 'examination/complete_exam';
$route['examination/show_details']    	= 'examination/show_details';
$route['examination/update_balance']    = 'examination/update_balance';
$route['my_account/(:any)']             = 'my_account/index/$1';
$route['notice-board/(:any)']           = 'notice_board/index/$1';
$route['home/check_email_availablity']	= 'home/check_email_availablity';
$route['home/forgotpassword'] 			= 'home/forgotpassword';
$route['home/do_forgotpassword'] 		= 'home/do_forgotpassword';
$route['home/activate/(:any)']          = 'home/activate/$1';
$route['payment']           			= 'payment/index';
$route['payment/store_temp_data'] 		= 'payment/store_temp_data';
$route['payment/proceed'] 				= 'payment/proceed';
$route['payment/success']           	= 'payment/success';
$route['payment/cancel']           		= 'payment/cancel';
$route['passage-planning'] 				= 'passage_planning/index';
$route['passage-planning/(:num)'] 		= 'passage_planning/index/$1';
$route['passage-planning/download/(:num)'] = 'passage_planning/payment/$1';
$route['passage-planning/payment-proceed/(:num)'] = 'passage_planning/payment_proceed/$1';
$route['passage_planning/payed-doc/(:num)/(:any)/(:any)'] = 'passage_planning/payed_doc/$1/$2/$3';
$route['passage_planning/store_temp_data/(:num)'] = 'passage_planning/store_temp_data/$1';
$route['passage-planning/search/(:any)'] = 'passage_planning/search/$1';
$route['passage-planning/search/(:any)/(:num)'] = 'passage_planning/search/$1/$2';
// $route['passage_planning/success'] = 'passage_planning/success';
// $route['passage_planning/cancel'] = 'passage_planning/cancel';

$route['coming-soon'] 		= 'home/comingsoon';
// CMS Routes
$route['about-us'] 			= "cms/index/about-us/";
$route['refund-policy'] 		= "cms/index/refund-policy/";
$route['cms/contactus'] 		= "cms/contactus";
$route['contact-us'] 			= "cms/contactus/";
$route['terms-and-conditions'] 	        = "cms/index/terms-and-conditions/";
$route['(:any)/(:num)']      			= 'category/paginate/$1';
$route['(:any)']      					= 'category/index/$1';



$route['404_override']         	        = "error404";









/* End of file routes.php */
/* Location: ./application/config/routes.php */