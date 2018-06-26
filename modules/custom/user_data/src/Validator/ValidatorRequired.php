<?php

namespace Drupal\user_data\Validator;

/**
 * Class ValidatorRequired.
 *
 * @package Drupal\user_data\Validator
 */
class ValidatorRequired extends ValidatorBase {

  /**
   * {@inheritdoc}
   */
  public function validate($value) {
    return is_array($value) ? !empty(array_filter($value)) : !empty($value);
  }

}
