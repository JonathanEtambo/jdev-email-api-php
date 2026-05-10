<?php

$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/pricing', 'HomeController@pricing');
$router->add('GET', '/docs', 'DocsController@index');

$router->add('GET', '/login', 'AuthController@showLogin');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@showRegister');
$router->add('POST', '/register', 'AuthController@register');
$router->add('GET', '/logout', 'AuthController@logout');

$router->add('GET', '/dashboard', 'DashboardController@index');

$router->add('GET', '/sites', 'SiteController@index');
$router->add('GET', '/sites/create', 'SiteController@create');
$router->add('POST', '/sites/store', 'SiteController@store');
$router->add('GET', '/sites/edit/{id}', 'SiteController@edit');
$router->add('POST', '/sites/update/{id}', 'SiteController@update');
$router->add('POST', '/sites/delete/{id}', 'SiteController@delete');

$router->add('GET', '/subscriptions', 'SubscriptionController@index');
$router->add('GET', '/subscriptions/checkout/{id}', 'SubscriptionController@checkout');
$router->add('POST', '/subscriptions/store-payment', 'SubscriptionController@storePayment');

$router->add('GET', '/admin', 'AdminController@index');
$router->add('POST', '/admin/payments/approve/{id}', 'AdminController@approvePayment');
$router->add('POST', '/admin/payments/reject/{id}', 'AdminController@rejectPayment');
$router->add('POST', '/admin/sites/suspend/{id}', 'AdminController@suspendSite');
$router->add('POST', '/admin/sites/activate/{id}', 'AdminController@activateSite');
