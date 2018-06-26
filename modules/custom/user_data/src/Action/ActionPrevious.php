<?php

namespace Drupal\user_data\Action;

use Drupal\user_data\Step\StepEnum;

/**
 * Class ActionPrevious.
 *
 * @package Drupal\user_data\Action
 */
class ActionPrevious extends ActionBase {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'prev';
  }

  /**
   * {@inheritdoc}
   */
  public function getRenderableArray() {
    return [
      '#type' => 'submit',
      '#value' => t($this->getActionText()),
      '#goto_step' => $this->getNextStepId(),
      '#skip_validation' => TRUE,
    ];
  }

}
