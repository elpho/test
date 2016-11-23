<?php
  abstract class ElphoTestCase extends PHPUnit_Framework_TestCase {
    public static function setUpBeforeClass(){
      if(!defined('DEBUG')){
        define('DEBUG', 1);
        //Framework is not a dependency so we must include this by hand,
        //usually composer will do this for us.
        require '../elpho/startup.php';
      }
    }
  }
