<?php

namespace Drupal\user_data\Action;

use Drupal\user_data\Step\StepEnum;

/**
 * Class ActionNext.
 *
 * @package Drupal\user_data\Action
 */
class ActionNext extends ActionBase {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'next';
  }

  /**
   * {@inheritdoc}
   */
  public function getRenderableArray() {
    return [
      '#type' => 'submit',
      '#value' => t($this->getActionText()),
      '#goto_step' => $this->getNextStepId(),
    ];
  }

}
