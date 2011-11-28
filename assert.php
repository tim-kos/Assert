<?php
class Assert {
  static function test($val, $expected, $info = array(), $strict = true) {
    $success = ($strict)
      ? $val === $expected
      : $val == $expected;

    if ($success) {
      return true;
    }

    $calls = debug_backtrace();
    foreach ($calls as $call) {
      if ($call['file'] !== __FILE__) {
        $assertCall = $call;
        break;
      }
    }
    $triggerCall = current($calls);
    $type = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $assertCall['function']));

    if (is_string($info)) {
      $info = array('type' => $info);
    }

    $info = array_merge(array(
      'file' => $assertCall['file'],
      'line' => $assertCall['line'],
      'function' => @$triggerCall['class'].'::'.$triggerCall['function'],
      'assertType' => $type,
      'val' => $val,
      'expected' => $expected
    ), $info);
    throw new AppException($info);
  }

  static function true($val, $info = array()) {
    return Assert::test($val, true, $info);
  }

  static function false($val, $info = array()) {
    return Assert::test($val, false, $info);
  }

  static function equal($a, $b, $info = array()) {
    return Assert::test($a, $b, $info, false);
  }

  static function identical($a, $b, $info = array()) {
    return Assert::test($a, $b, $info, true);
  }

  static function pattern($pattern, $val, $info = array()) {
    return Assert::test(preg_match($pattern, $val), true, am(array('pattern' => $pattern), $info));
  }

  static function isEmpty($val, $info = array()) {
    return Assert::test(empty($val), true, $info);
  }

  static function notEmpty($val, $info = array()) {
    return Assert::test(empty($val), false, $info);
  }

  static function isNumeric($val, $info = array()) {
    return Assert::test(is_numeric($val), true, $info);
  }

  static function notNumeric($val, $info = array()) {
    return Assert::test(is_numeric($val), false, $info);
  }

  static function isInteger($val, $info = array()) {
    return Assert::test(is_int($val), true, $info);
  }

  static function notInteger($val, $info = array()) {
    return Assert::test(is_int($val), false, $info);
  }

  static function isIntegerish($val, $info = array()) {
    return Assert::test(is_int($val) || ctype_digit($val), true, $info);
  }

  static function notIntegerish($val, $info = array()) {
    return Assert::test(is_int($val) || ctype_digit($val), false, $info);
  }

  static function isObject($val, $info = array()) {
    return Assert::test(is_object($val), true, $info);
  }

  static function notObject($val, $info = array()) {
    return Assert::test(is_object($val), false, $info);
  }

  static function isBoolean($val, $info = array()) {
    return Assert::test(is_bool($val), true, $info);
  }

  static function notBoolean($val, $info = array()) {
    return Assert::test(is_bool($val), false, $info);
  }

  static function isString($val, $info = array()) {
    return Assert::test(is_string($val), true, $info);
  }

  static function notString($val, $info = array()) {
    return Assert::test(is_string($val), false, $info);
  }

  static function isArray($val, $info = array()) {
    return Assert::test(is_array($val), true, $info);
  }

  static function notArray($val, $info = array()) {
    return Assert::test(is_array($val), false, $info);
  }

  static function isNull($val, $info = array()) {
    return Assert::test(is_null($val), true, $info);
  }

  static function notNull($val, $info = array()) {
    return Assert::test(is_null($val), false, $info);
  }
}