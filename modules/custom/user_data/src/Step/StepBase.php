<?php

namespace Drupal\user_data\Step;

/**
 * Class StepBase.
 *
 * @package Drupal\user_data\Step
 */
abstract class StepBase implements StepInterface {

  /**
   * Step identifier
   *
   * @var string
   */
  protected $stepId;

  /**
   * Values of the step.
   *
   * @var array
   */
  protected $values;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->stepId = $this->setStepId();
  }

  /**
   * {@inheritdoc}
   */
  public function getStepId() {
    return $this->stepId;
  }

  /**
   * {@inheritdoc}
   */
  public function setValues($values) {
    $this->values = $values;
  }

  /**
   * {@inheritdoc}
   */
  public function getValues() {
    return $this->values;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldValidators() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  abstract protected function setStepId();

}
