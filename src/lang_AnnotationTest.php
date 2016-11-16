<?php
  include_once 'inc/suitSetup.php';
  include_once 'helpers/EntryHelper.php';
  include_once 'helpers/HelperAnnotation.php';

  class AnnotationTest extends PHPUnit_Framework_TestCase {
    public function testReadFromClass(){
      $class = new ReflectionClass('EntryHelper');
      $annotations = HelperAnnotation::read($class);

      $this->assertEquals($annotations->length(), 3);
      return $annotations;
    }

    public function testReadFromMethod(){
      $method = (new ReflectionClass('EntryHelper'))->getMethod('done');
      $annotations = HelperAnnotation::read($method);

      $this->assertEquals($annotations->length(), 4);
      return $annotations;
    }

    /**
    * @depends testReadFromClass
    */
    public function testClassAnnotationParameters($anns){
      $this->assertEquals('', $anns[0]->x);
      $this->assertEquals('', $anns[0]->y);
      $this->assertEquals('', $anns[0]->z);

      $this->assertEquals('a', $anns[1]->x);
      $this->assertEquals('b', $anns[1]->y);
      $this->assertEquals('c', $anns[1]->z);

      $this->assertEquals('b', $anns[2]->x);
      $this->assertEquals('a', $anns[2]->y);
      $this->assertEquals('c', $anns[2]->z);
    }

    /**
    * @depends testReadFromMethod
    */
    public function testMethodAnnotationParameters($anns){
      $this->assertEquals('a', $anns[0]->x);
      $this->assertEquals('', $anns[0]->y);
      $this->assertEquals('', $anns[0]->z);

      $this->assertEquals('b', $anns[1]->x);
      $this->assertEquals('', $anns[1]->y);
      $this->assertEquals('', $anns[1]->z);

      $this->assertEquals('a', $anns[2]->x);
      $this->assertEquals('b', $anns[2]->y);
      $this->assertEquals('', $anns[2]->z);

      $this->assertEquals('b', $anns[3]->x);
      $this->assertEquals('c', $anns[3]->y);
      $this->assertEquals('a', $anns[3]->z);
    }
  }