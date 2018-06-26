<?php

namespace Drupal\user_data\Action;

use Drupal\user_data\Step\StepEnum;

/**
 * Class ActionSave.
 *
 * @package Drupal\user_data\Action
 */
class ActionSave extends ActionBase {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'save';
  }

  /**
   * {@inheritdoc}
   */
  public function getRenderableArray() {
    return [
      '#type' => 'submit',
      '#value' => t($this->getActionText()),
      '#goto_step' => $this->getNextStepId(),
      '#submit_handler' => 'saveData',
    ];
  }

}
