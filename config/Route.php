<?php
/**
 * List routes
 */

$this->router->add('home', '/', 'HomeController:index');
$this->router->add('addUser', '/addUser', 'HomeController:addUser','POST');