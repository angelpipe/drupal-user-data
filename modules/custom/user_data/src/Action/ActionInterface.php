<?php

namespace Drupal\user_data\Action;

/**
 * Interface ActionInterface.
 *
 * @package Drupal\user_data\Action
 */
interface ActionInterface {

  /**
   * Get action key name.
   *
   * @return string.
   */
  public function getKey();

  /**
   * Get renderable array for the action.
   *
   * @return array
   */
  public function getRenderableArray();

  /**
   * Tell if the action triggers an AJAX call
   *
   * @return bool
   */
  public function hasAjax();

  /**
   * Get next step identifier.
   *
   * @return string.
   */
  public function getNextStepId();

  /**
   * Get action button text.
   *
   * @return string.
   */
  public function getActionText();

}
