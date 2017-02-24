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

$route['default_controller'] = "home";
$route['404_override'] = '';


$modules_path = APPPATH.'modules_core/';     
$modules = scandir($modules_path);

foreach($modules as $module)
{
    if($module === '.' || $module === '..') continue;
    if(is_dir($modules_path) . '/' . $module)
    {
        $routes_path = $modules_path . $module . '/config/routes.php';
        if(file_exists($routes_path))
        {
            require($routes_path);
        }
        else
        {
            continue;
        }
    }
}

$route['terms-and-conditions']          = "cms/index";
$route['about']                         = "cms/index";
$route['motorcycle-theory-details']     = "home/motorcycle_theory";
$route['car-theory-details']            = "home/car_theory";
$route['how-it-works']                  = "cms/how_it_workes";

$route['(:any)/download']               = 'instructor/download';
$route['download_file/(:any)/(:any)']   = 'instructor/download_file';
$route['(:any)/dashboard']              = 'instructor/dashboard';
$route['(:any)/dashboard/(:num)']       = 'instructor/dashboard';
$route['(:any)/active_users']           = 'student/active_users';
$route['(:any)/active_users/(:num)']    = 'student/active_users';
$route['(:any)/past_users']             = 'student/past_users';
$route['(:any)/past_users/(:num)']      = 'student/past_users';
$route['(:any)/all_list']               = 'student/all_list';
$route['(:any)/all_list/(:num)']        = 'student/all_list';
$route['(:any)/edit/(:num)/(:num)']     = 'student/edit';
$route['(:any)/cancel/(:num)/(:num)']   = 'student/cancel';
$route['(:any)/add']                    = 'student/add';
$route['(:any)/edit-profile']           = 'instructor/editProfile';
$route['(:any)/change-password']        = 'instructor/changePassword';
$route['(:any)/report/(:num)']          = 'student/report';
$route['(:any)/card-details-change']    = 'instructor/cardDetailsChange';
$route['(:any)/cancel-payment']         = 'instructor/cancel_payment';
$route['(:any)/payment_cancel_type']    = 'paypal_payment/payment_cancel_type';
$route['(:any)/video_tutorial']         = 'video_tutorial/index';

$route['faq']                           = 'faq/index';
$route['(:any)/faq']                    = 'faq/index';
/* End of file routes.php */
/* Location: ./application/config/routes.php */