<?php

namespace Drupal\user_data\Validator;

/**
 * Interface ValidatorInterface.
 *
 * @package Drupal\user_data\Validator
 */
interface ValidatorInterface {

  /**
   * Validate a value matches the required criteria
   *
   * @param string $value
   *   The value to validate.
   *
   * @return bool
   */
  public function validate($value);

  /**
   * Get validation error message.
   *
   * @return string
   */
  public function getErrorMessage();

}
