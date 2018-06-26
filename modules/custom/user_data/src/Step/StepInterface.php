<?php

namespace Drupal\user_data\Step;

/**
 * Interface StepInterface.
 *
 * @package Drupal\user_data\Step
 */
interface StepInterface {

  /**
   * Get step.
   *
   * @return string
   *  Step identifier
   */
  public function getStepId();

  /**
   * Get the renderable form array of the step.
   *
   * @return array
   */
  public function getStepFormElements();

  /**
   * Return actions for the step.
   *
   * @return array
   */
  public function getActions();

  /**
   * Get all field names.
   *
   * @return array
   */
  public function getFieldNames();

  /**
   * Get field validators.
   *
   * @return array
   */
  public function getFieldValidators();

  /**
   * Set values from user input.
   *
   * @param array $values
   *  All the values from the user
   */
  public function setValues($values);

  /**
   * Get values already set on the step.
   *
   * @return array
   */
  public function getValues();

}
