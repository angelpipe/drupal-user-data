<?php

namespace Drupal\user_data\Manager;

use Drupal\user_data\Step\StepInterface;
use Drupal\user_data\Step\StepEnum;

/**
 * Class StepManager.
 *
 * @package Drupal\user_data\Manager
 */
class StepManager {

  /**
   * Collection of steps of the form.
   *
   * @var \Drupal\user_data\Step\StepInterface
   */
  protected $steps;

  /**
   * Add a new step to the collection.
   *
   * @param \Drupal\user_data\Step\StepInterface $step
   *   Step to be added.
   */
  public function addStep(StepInterface $step) {
    $this->steps[$step->getStepId()] = $step;
  }

  /**
   * Get a step from steps collection.
   *
   * @param int $step_id
   *   Step identifier.
   *
   * @return \Drupal\user_data\Step\StepInterface
   *   Step object.
   */
  public function getStep($step_id) {
    if (isset($this->steps[$step_id])) {
      $step = $this->steps[$step_id];
    }
    else {
      $class = StepEnum::getMapping($step_id);
      $step = new $class($this);
    }

    return $step;
  }

  /**
   * Get steps collection.
   *
   * @return \Drupal\user_data\Step\StepInterface[]
   *   Steps.
   */
  public function getAllSteps() {
    return $this->steps;
  }

  /**
   * Remove data from all steps.
   */
  public function clearSteps() {
    $this->steps = array();
  }

}
