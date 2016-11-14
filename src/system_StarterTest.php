<?php
  include_once 'suitSetup.php';

  class StarterTest extends PHPUnit_Framework_TestCase {
    /**
    * @expectedException Exception
    * @expectedExceptionMessage Starter can only be run once!
    */
    public function testStart(){
      elpho\system\Starter::start();
    }

    /**
    * @expectedException Exception
    * @expectedExceptionMessage Could not find entry class 'UnexistantClassName'
    */
    public function testRegisterInvalidEntryClass(){
      $name = 'UnexistantClassName';

      $this->assertTrue(!class_exists($name, false));
      $this->assertTrue(!method_exists($name, 'main'));

      //Will only throw exception when DEBUG is defined
      elpho\system\Starter::registerEntryClass($name);
    }

    public function testRegisterEntryClass(){
      $this->assertTrue(method_exists('EntryHelper', 'main'));
      elpho\system\Starter::registerEntryClass('EntryHelper');
      return true;
    }

    /**
    * @depends testRegisterEntryClass
    * @expectedException Exception
    * @expectedExceptionMessage EntryHelper got called
    */
    public function testCallPrimaryMethods(){
      elpho\system\Starter::callPrimaryMethods();
    }
  }
