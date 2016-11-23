<?php
  require 'vendor/autoload.php';
  include_once 'helpers/EntryHelper.php';

  class TopLevel extends support\ElphoTestCase {
    public function testCall(){
      $this->assertEquals(call(array($this, "callHelper"), "a", "b", "c"), array('a', 'b', 'c'));
    }
    public function testApply(){
      $this->assertEquals(apply(array($this, "callHelper"), array("a", "b", "c")), array('a', 'b', 'c'));
    }

    /**
    * @expectedException Exception
    * @expectedExceptionMessage Could not find entry class 'UnexistantClassName'
    */
    public function testBogusRegisterMain(){
      $name = 'UnexistantClassName';

      $this->assertTrue(!class_exists($name, false));
      $this->assertTrue(!method_exists($name, 'main'));

      //Will only throw exception when DEBUG is defined
      registerMain($name);
    }

    public function testRegisterMain(){
      $name = 'EntryHelper';

      $this->assertTrue(class_exists($name, false));
      $this->assertTrue(method_exists($name, 'main'));

      registerMain($name);

      //Disable default behavior when shutdown function get called
      EntryHelper::done();
    }

    //helper
    public static function callHelper(){
      return func_get_args();
    }
  }
