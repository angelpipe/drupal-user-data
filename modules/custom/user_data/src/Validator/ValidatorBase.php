<?php

namespace Drupal\user_data\Validator;

/**
 * Class ValidatorBase.
 *
 * @package Drupal\user_data\Validator
 */
abstract class ValidatorBase implements ValidatorInterface {

  protected $errorMessage;

  /**
   * Constructor.
   *
   * @param string $error_message
   *   Error message.
   */
  public function __construct($error_message) {
    $this->errorMessage = $error_message;
  }

  /**
   * {@inheritdoc}
   */
  public function getErrorMessage() {
    return $this->errorMessage;
  }

}
