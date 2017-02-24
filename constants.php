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

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('SITE_NAME',                     'dipp_driving');
define('FILE_PATH', 		        '/var/www/html/dipp_driving/doc/');
define('DOCUMENT_ROOT',                 '/var/www/html/dipp_driving/');
define('FRONTEND_URL',              	'http://182.73.137.53/dipp_driving/');
define('FILE_UPLOAD_ABSOLUTE_PATH',     '/var/www/html/dipp_driving/uploads/');
define('FILE_UPLOAD_URL',               'http://182.73.137.53/dipp_driving/uploads/');

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		        'x+b');

define('TABLE_PREFIX','dipp_');
define('STUDENT', TABLE_PREFIX.'student');
define('INSTRUCTOR', TABLE_PREFIX.'instructor');
define('COURSE_MASTER', TABLE_PREFIX.'course_master');
define('STEP_MASTER', TABLE_PREFIX.'step_master');
define('SITESETTINGS', TABLE_PREFIX.'sitesettings');
define('EMAIL_TEMPLATE', TABLE_PREFIX.'email_template');
define('LESSION_MASTER',TABLE_PREFIX.'lesson_master');
define('LESSION_DETAILS',TABLE_PREFIX.'lesson_details');
define('TOPIC_MASTER',TABLE_PREFIX.'topic_master');
define('LESSION_READ',TABLE_PREFIX.'lesson_read');
define('QUESTION_ANSWER_SET',TABLE_PREFIX.'question_answer_set');
define('QUESTION_MASTER',TABLE_PREFIX.'question_master');
define('MODULE_MASTER',TABLE_PREFIX.'module_master');
define('ANSWER_MASTER',TABLE_PREFIX.'answer_master');
define('CMS',TABLE_PREFIX.'cms');
define('MOCK_TEST_RESULT',TABLE_PREFIX.'mock_test_result');
define('MOCK_ANSWER_MASTER',TABLE_PREFIX.'mock_answer_master');
define('MOCK_QUESTION_MASTER',TABLE_PREFIX.'mock_question_master');
define('TESTIMONIAL',TABLE_PREFIX.'testimonial');
define('FAQ',TABLE_PREFIX.'faq');
define('NEWSLETTERS',TABLE_PREFIX.'newsletters');
define('BANNER',TABLE_PREFIX.'banner');
define('ADVERTISEMENT',TABLE_PREFIX.'advertisement');
define('PACKAGE',TABLE_PREFIX.'package');
define('INSTRUCTOR_PAYMENT',TABLE_PREFIX.'instructor_payment');
define('NEWS',TABLE_PREFIX.'news');
define('BOOKING_MASTER',TABLE_PREFIX.'booking_master');
define('TEST_CENTRE',TABLE_PREFIX.'test_centre');
define('PREFFERDATE',TABLE_PREFIX.'prefferdate');

///Paypal info for payment
define('API_USERNAME','sautus_1330033029_biz_api1.gmail.com');
define('API_PASSWORD','1330033065');
define('API_SIGNATURE','AeA7NGb.RVr3ArLxniqlhBfhwZ2tAYeluA6mW3wCercIegtgN8VBSTHt');
define('API_ENV','sandbox');
define('API_VERSION','85.0');


/* End of file constants.php */
/* Location: ./application/config/constants.php */