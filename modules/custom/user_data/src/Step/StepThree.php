<?php

namespace Drupal\user_data\Step;

use Drupal\user_data\Action\ActionPrevious;

/**
 * Class StepThree.
 *
 * @package Drupal\user_data\Step
 */
class StepThree extends StepBase {

  /**
   * {@inheritdoc}
   */
  protected function setStepId() {
    return StepEnum::STEP_THREE;
  }

  /**
   * {@inheritdoc}
   */
  public function getActions() {
    return [
      new ActionPrevious(StepEnum::STEP_ONE, 'Start over'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getStepFormElements() { 
    $form['result'] = [
      '#type' => 'item',
      '#title' => t('User data has been saved succesfully'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return ['result'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldValidators() {
    return [];
  }

}
