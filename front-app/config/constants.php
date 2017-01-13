<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);



/*
|--------------------------------------------------------------------------
| Define Table Name
|--------------------------------------------------------------------------
|
| 
|
*/
define('TBL_PREFIX', 'ep_');
define('ADMIN', 	TBL_PREFIX . 'admin');
define('STUDENT', 	TBL_PREFIX . 'student');
define('CMS', 		TBL_PREFIX . 'cms');
define('MENU', 		TBL_PREFIX . 'menu');
define('ROLE', 		TBL_PREFIX . 'role');
define('MAPPING', 	TBL_PREFIX . 'user_menu_mapping');
define('SETTINGS', 	TBL_PREFIX . 'sitesettings');
define('SUBJECT', 	TBL_PREFIX . 'subject');
define('QUESTION', 	TBL_PREFIX . 'question');
define('ANSWER', 	TBL_PREFIX . 'answer');
define('BLOG', 	    TBL_PREFIX . 'blog');
define('ADVERTISEMENT',TBL_PREFIX .'advertisement');
define('MEMBERS',TBL_PREFIX .'team_members');

// Records shown in a page
define('PER_PAGE_LISTING',10);


/*
|--------------------------------------------------------------------------
| Define URL
|--------------------------------------------------------------------------
|
| 
|
*/
define('FRONTEND_URL',		    'http://marinelookout.com/');
define('FRONTEND_JS',		    'http://marinelookout.com/js/');
define('FRONTEND_CSS',		    'http://marinelookout.com/css/');
define('FRONTEND_IMAGES',           'http://marinelookout.com/images/');
define('BACKEND_URL', 		    'http://marinelookout.com/admin/');
define('FILE_UPLOAD_ABSOLUTE_PATH', '/home/marinelookout/public_html/upload/');
define('FILE_UPLOAD_URL',           'http://marinelookout.com/upload/');

define('BACKEND_JS_PATH',			'http://marinelookout.com/admin/js/');
define('BACKEND_IMAGE_PATH',		'http://marinelookout.com/upload/');

define('WORKING_KEY',		    '14FED4AD09328DD6AC8A2750D48932C9');
define('ACCESS_CODE',		    'AVNN64DB11BP52NNPB');
define('MERCHANT_DATA',		    '91309');

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */



