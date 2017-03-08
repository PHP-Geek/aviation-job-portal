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
  |	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'page';
$route['404_override'] = 'page/page_not_found';
$route['login'] = 'auth/login';
$route['employee-login'] = 'auth/employee_login';
$route['register/(:any)'] = 'auth/register/$1';
$route['register/(:any)/(:any)'] = 'auth/register/$1/$2';
$route['recover'] = 'auth/recover';
$route['contact-us'] = 'page/contact_us';
$route['about-us'] = 'page/about_us';
$route['our-services'] = 'page/our_services';
$route['careers'] = 'job/careers';
$route['careers-open'] = 'job/careers_open';
$route['careers-open/(:any)'] = 'job/careers_open/$1';
//$route['careers-open-apply/(:any)'] = 'job/careers_open_apply/$1';
$route['post-job'] = 'job/post';
$route['edit-job/(:any)'] = 'job/edit/$1';
$route['aircraft-sales'] = 'aircraft/sales';
$route['aircraft-sales/(:any)'] = 'aircraft/sales/$1';
$route['aircraft-sales-open/(:any)/(:any)'] = 'aircraft/sales_open/$1/$2';
$route['aircraft-charter'] = 'aircraft/charter';
$route['testimonials'] = 'page/testimonials';
$route['privacy-policy'] = 'page/privacy_policy';
$route['employer-login'] = 'auth/employer_login';
$route['edit-profile'] = 'user/edit_profile';
$route['edit-profile/(:any)'] = 'user/edit_profile/$1';
$route['employer-profile'] = 'user/employer_profile';
$route['employer-profile/(:any)/(:any)'] = 'user/employer_profile/$1/$2';
$route['pilot-profile'] = 'page/pilot_profile';
$route['aircraft-charter/request'] = 'aircraft/request_quote';
$route['aircraft-charter/request/(:any)'] = 'aircraft/request_quote/$1';
$route['employee-dashboard'] = 'page/employee_dashboard';
$route['employer-dashboard'] = 'page/employer_dashboard';
$route['flight-attendant'] = 'page/flight_attendant';
$route['executive'] = 'page/executive';
$route['operation'] = 'page/operation';
$route['staff-recruitment'] = 'page/staff_recruitment';
$route['aircraft-management'] = 'aircraft/aircraft_management';
$route['entry-into-service'] = 'page/entry_into_service';
$route['employer-registration'] = 'page/employer_registration';
$route['engineer'] = 'page/engineer';
$route['jobs-applied-dashboard'] = 'job/jobs_applied_dashboard';
$route['view-job-applicant'] = 'job/view_applicants';
$route['crew-request-form'] = 'page/crew_request_form';
$route['crew-request-form/(:any)'] = 'page/crew_request_form/$1';
$route['contract-crew-request'] = 'page/contract_crew_request';
$route['user-login-apply-job'] = 'page/user_login_apply_job';
$route['invite-colleague'] = 'page/invite_colleague';
$route['sales-and-acquisitions'] = 'aircraft/sales_and_acquisitions';
$route['employee-terms-and-conditions'] = 'page/employee_terms_and_conditions';
$route['employer-terms-and-conditions'] = 'page/employer_terms_and_conditions';
$route['news-and-events'] = 'event/index';
$route['job-alerts'] = 'job/alert';
$route['news-and-events/(:any)'] = 'event/index/$1';
$route['translate_uri_dashes'] = FALSE;
