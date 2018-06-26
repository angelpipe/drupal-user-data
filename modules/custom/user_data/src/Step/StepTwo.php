<?php

namespace Drupal\user_data\Step;

use Drupal\user_data\Action\ActionPrevious;
use Drupal\user_data\Action\ActionSave;
use Drupal\user_data\Validator\ValidatorRequired;

/**
 * Class StepTwo.
 *
 * @package Drupal\user_data\Step
 */
class StepTwo extends StepBase {

  /**
   * {@inheritdoc}
   */
  protected function setStepId() {
    return StepEnum::STEP_TWO;
  }

  /**
   * {@inheritdoc}
   */
  public function getActions() {
    return [
      new ActionPrevious(StepEnum::STEP_ONE, 'Back'),
      new ActionSave(StepEnum::STEP_THREE, 'Next'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getStepFormElements() {
    $form['city'] = [
      '#type' => 'textfield',
      '#default_value' => isset($this->getValues()['city']) ?
        $this->getValues()['city'] : NULL,
      '#required' => FALSE,
      '#title' => t("City"),
    ];

    $form['phone'] = array(
      '#type' => 'tel',
      '#default_value' => isset($this->getValues()['phone']) ?
        $this->getValues()['phone'] : NULL,
      '#required' => FALSE,
      '#title' => t('Phone Number'),
    );

    $form['address'] = [
      '#type' => 'textfield',
      '#default_value' => isset($this->getValues()['address']) ?
        $this->getValues()['address'] : NULL,
      '#required' => FALSE,
      '#title' => t("Address"),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'city',
      'phone',
      'address',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldValidators() {
    return [
      'city' => [
        new ValidatorRequired("City is required"),
      ],
    ];
  }

}
