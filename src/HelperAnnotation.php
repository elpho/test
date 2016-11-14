<?php
  use elpho\lang\Annotation;

  class HelperAnnotation extends Annotation{
    protected static $name = "helper";
    protected static $parameters = array("x", "y", "z");
  }