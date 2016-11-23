<?php
  require 'vendor/autoload.php';

  use elpho\lang\ArrayList;
  use elpho\lang\ArrayList_from;

  class ArrayListTest extends support\ElphoTestCase {
    public function testConstructors(){
      $subject = new ArrayList();
      $this->assertEquals($subject->length(), 0);

      $subject = new ArrayList_from(array('a', 'b', 'c'));
      $this->assertEquals(3, $subject->length());

      return $subject;
    }

    /**
    * @depends testConstructors
    */
    public function testPop($subject){
      $mirror = array('a', 'b', 'c');

      $this->assertNotEquals(0, $subject->length());
      $this->assertEquals(array_pop($mirror), $subject->pop());
      $this->assertEquals(2, $subject->length());

      $element = $subject->pop();
      $this->assertEquals('b', $element);
      $this->assertEquals(1, $subject->length());
    }

    public function testPush(){
      $subject = new ArrayList();
      $this->assertEquals(0, $subject->length());

      $subject->push('hey');
      $this->assertEquals(1, $subject->length());

      $subject->push('ho', 'lets', 'go');
      $this->assertEquals(4, $subject->length());

      $subject->pushAll(array('one', 'two', 'three', 'four'));
      $this->assertEquals(8, $subject->length());

      $subject->pushAll(array());
      $this->assertEquals(8, $subject->length());
    }

    /**
    * @expectedException PHPUnit_Framework_Error
    */
    public function testBogusPush(){
      $subject = new ArrayList();
      $this->assertEquals(0, $subject->length());

      $subject->push();
    }

    public function testMerge(){
      $subjectA = new ArrayList_from(array('1', '2', '3'));
      $subjectB = new ArrayList_from(array('2', '3', '4'));

      //merge is like push all, but on a new ref...
      $merged = $subjectA->merge($subjectB);

      $this->assertEquals(3, $subjectA->length());
      $this->assertEquals(3, $subjectB->length());
      $this->assertEquals(6, $merged->length());
    }

    public function testIndexOf(){
      $subject = new ArrayList_from(array('1', '2', '3', '1', '2', '3'));

      $this->assertEquals(0, $subject->indexOf('1'));
      $this->assertEquals(1, $subject->indexOf('2'));
      $this->assertEquals(2, $subject->indexOf('3'));
    }
    public function testLastIndexOf(){
      $subject = new ArrayList_from(array('1', '2', '3', '1', '2', '3'));

      $this->assertEquals(3, $subject->lastIndexOf('1'));
      $this->assertEquals(4, $subject->lastIndexOf('2'));
      $this->assertEquals(5, $subject->lastIndexOf('3'));
    }

    public function testJoin(){
      $subject = new ArrayList_from(array('1', '2', '3'));

      $this->assertEquals('123', $subject->join());
      $this->assertEquals('1A2A3', $subject->join('A'));
      $this->assertEquals('112321233', $subject->join('123'));
      $this->assertEquals('1.2.3', $subject->join('.'));
    }

    public function testMap(){
      $subject = new ArrayList_from(array(1, 2, 3, 4, 5));

      $result = $subject->map(function($element){
        return $element * ($element - 1);
      });

      $this->assertEquals(0, $result[0]);
      $this->assertEquals(2, $result[1]);
      $this->assertEquals(6, $result[2]);
      $this->assertEquals(12, $result[3]);
      $this->assertEquals(20, $result[4]);
    }
  }
