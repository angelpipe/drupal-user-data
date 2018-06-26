<?php

namespace Drupal\user_data\Step;

use Drupal\user_data\Action\ActionNext;
use Drupal\user_data\Validator\ValidatorRequired;

/**
 * Class StepOne.
 *
 * @package Drupal\user_data\Step
 */
class StepOne extends StepBase {

  /**
   * {@inheritdoc}
   */
  protected function setStepId() {
    return StepEnum::STEP_ONE;
  }

  /**
   * {@inheritdoc}
   */
  public function getActions() {
    return [
      new ActionNext(StepEnum::STEP_TWO, 'Next'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getStepFormElements() {
    $form['first_name'] = [
      '#type' => 'textfield',
      '#default_value' => isset($this->getValues()['first_name']) ?
        $this->getValues()['first_name'] : NULL,
      '#required' => FALSE,
      '#title' => t("First Name"),
    ];

    $form['last_name'] = [
      '#type' => 'textfield',
      '#default_value' => isset($this->getValues()['last_name']) ?
        $this->getValues()['last_name'] : NULL,
      '#required' => FALSE,
      '#title' => t("Last Name"),
    ];

    $form['gender'] = [
      '#type' => 'select',
      '#default_value' => isset($this->getValues()['gender']) ?
        $this->getValues()['gender'] : NULL,
      '#options' => [
        'female' => ('female'),
        'male' => ('male'),
      ],
      '#required' => FALSE,
      '#title' => t('Gender'),
    ];

    $form['birth'] = array(
      '#type' => 'date',
      '#default_value' => isset($this->getValues()['birth']) ?
        $this->getValues()['birth'] : NULL,
      '#required' => FALSE,
      '#title' => t('Date of Birth'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'first_name',
      'last_name',
      'gender',
      'birth',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldValidators() {
    return [
      'first_name' => [
        new ValidatorRequired("First Name is required"),
      ],
      'last_name' => [
        new ValidatorRequired("Last Name is required"),
      ],
      'gender' => [
        new ValidatorRequired("Gender is required"),
      ],
      'birth' => [
        new ValidatorRequired("Date of Birth is required"),
      ],
    ];
  }

}
