<?php

  /**
  * @helper()
  * @helper(a, b, c)
  * @helper(y=a, b, c)
  */
  class EntryHelper{
    private static $isDone = false;

    public static function main($args=array()){
      if(self::$isDone)
        return;

      self::done();
      throw new Exception("EntryHelper got called");
    }

    /**
    * @helper(a)
    * @helper(b)
    * @helper(a, b)
    * @helper(z=a, b, c)
    */
    public static function done(){
      self::$isDone = true;
    }
  }