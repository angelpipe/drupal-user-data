<?php

namespace Drupal\user_data\Step;

/**
 * Class StepEnum.
 *
 * @package Drupal\user_data\Step
 */
abstract class StepEnum {

  /**
   * Steps used in form.
   */
  const STEP_ONE = 'step_one';
  const STEP_TWO = 'step_two';
  const STEP_THREE = 'step_three';

  /**
   * Get steps class mapping.
   *
   * @param string $step
   *   Step identifier.
   *
   * @return String
   *   Classname of the step if exists, false otherwise
   */
  public static function getMapping($step) {
    $map = [
      self::STEP_ONE => 'Drupal\\user_data\\Step\\StepOne',
      self::STEP_TWO => 'Drupal\\user_data\\Step\\StepTwo',
      self::STEP_THREE => 'Drupal\\user_data\\Step\\StepThree',
    ];

    return isset($map[$step]) ? $map[$step] : FALSE;
  }

}
