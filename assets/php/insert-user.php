<?php

include 'User.php';

$user = new User('php_login_system', '127.0.0.1', 'root','root');

$user->create('admin','password');