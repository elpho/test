<?php
  if(!defined('DEBUG')){
    define('DEBUG', 1);
    require 'vendor/autoload.php';

    //Framework is not a dependency so we must include this by hand,
    //usually composer will do this for us.
    require '../elpho/startup.php';
  }