<?php

require_once 'core/boot.php';
$user = new User();
$user->logout();
Redirect::to('index');
