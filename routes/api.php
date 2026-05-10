<?php

$router->add('POST', '/api/send-email', 'ApiController@sendEmail');
$router->add('POST', '/api/contact-dxcode', 'ContactController@sendDxCodeContact');
