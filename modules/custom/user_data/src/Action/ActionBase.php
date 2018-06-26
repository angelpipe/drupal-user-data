<?php

namespace Drupal\user_data\Action;

/**
 * Class ActionBase.
 *
 * @package Drupal\user_data\Action
 */
abstract class ActionBase implements ActionInterface {

  /**
   * Next step identifier
   *
   * @var string
   */
  protected $nextStepId;

  /**
   * Action button text
   *
   * @var string
   */
  protected $actionText;

  /**
   * Constructor.
   *
   * @param string $nextStep
   *   Next step identifier.
   * @param string $text
   *   Text displayed in the action button.
   */
  public function __construct($nextStep, $text) {
    $this->nextStepId = $nextStep;
    $this->actionText = $text;
  }

  /**
   * {@inheritdoc}
   */
  public function hasAjax() {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getNextStepId () {
    return $this->nextStepId;
  }

  /**
   * {@inheritdoc}
   */
  public function getActionText () {
    return $this->actionText;
  }
}
