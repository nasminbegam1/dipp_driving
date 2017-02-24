<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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


define('FRONTEND_URL',              'http://182.73.137.53/dipp_driving/');
define('BACKEND_URL',               'http://182.73.137.53/dipp_driving/admin/');
define('DOCUMENT_ROOT',             '/var/www/html/dipp_driving/');
define('FILE_UPLOAD_ABSOLUTE_PATH', '/var/www/html/dipp_driving/uploads/');
define('FILE_UPLOAD_URL',           'http://182.73.137.53/dipp_driving/uploads/');
define('FRONT_JS_PATH',             'http://182.73.137.53/dipp_driving/js/');
define('BACKEND_CSS_PATH',          'http://182.73.137.53/dipp_driving/admin/css/');
define('BACKEND_JS_PATH',           'http://182.73.137.53/dipp_driving/admin/js/');
define('BACKEND_IMAGE_PATH',        'http://182.73.137.53/dipp_driving/admin/images/');

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

define('PER_PAGE_LISTING', 10);


/* End of file constants.php */
/* Location: ./application/config/constants.php */