<?php
return array(
	'_root_'  => 'host/index',  // The default route
	'_404_'   => 'host/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);