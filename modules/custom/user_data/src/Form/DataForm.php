<?php

namespace Drupal\user_data\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\user_data\Manager\StepManager;
use Drupal\user_data\Step\StepEnum;

/**
 * Form to collect user data.
 *
 * @package Drupal\user_data\Form
 */
class DataForm extends FormBase {
  use StringTranslationTrait;

  /**
   * Step manager instance.
   *
   * @var \Drupal\user_data\Manager\StepManager
   */
  protected $stepManager;

  /**
   * Current step.
   *
   * @var \Drupal\user_data\Step\StepInterface
   */
  protected $step;

  /**
   * Step identifier.
   *
   * @var \Drupal\user_data\Step\StepEnum
   */
  protected $stepId;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->stepId = StepEnum::STEP_ONE;
    $this->stepManager = new StepManager();
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_data_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['messages'] = [
      '#attributes' => [
        'id' => 'messages',
      ],
      '#type' => 'container',
    ];
    $form['form'] = [
      '#attributes' => [
        'id' => 'form',
      ],
      '#type' => 'container',
    ];

    // Attach step
    $this->step = $this->stepManager->getStep($this->stepId);
    $form['form'] += $this->step->getStepFormElements();

    // Attach step actions.
    $form['form']['actions']['#type'] = 'actions';
    $actions = $this->step->getActions();
    foreach ($actions as $action) {
      $form['form']['actions'][$action->getKey()] = $action->getRenderableArray();

      if ($action->hasAjax()) {
        $form['form']['actions'][$action->getKey()]['#ajax'] = [
          'callback' => [$this, 'loadStep'],
          'effect' => 'fade',
          'wrapper' => 'form',
        ];
      }
    }

    return $form;
  }

  /**
   * Load steps into the form (AJAX call).
   *
   * @param array $form
   *   Form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state interface.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   Ajax response.
   */
  public function loadStep(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $messages = drupal_get_messages();
    // load or clean messages based on validation
    if (!empty($messages)) {
      $messages = [
        '#message_list' => $messages,
        '#status_headings' => [
          'status' => $this->t('Status message'),
          'error' => $this->t('Error message'),
          'warning' => $this->t('Warning message'),
        ],
        '#theme' => 'status_messages',
      ];
      $response->addCommand(new HtmlCommand('#messages', $messages));
    }
    else {
      $response->addCommand(new HtmlCommand('#messages', ''));
    }

    // Load form.
    $response->addCommand(new HtmlCommand('#form',
      $form['form']));

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $field_validators = $this->step->getFieldValidators();

    if (empty($triggering_element['#skip_validation']) && $field_validators) {
      foreach ($field_validators as $field => $validators) {
        $field_value = $form_state->getValue($field);
        foreach ($validators as $validator) {
          if (!$validator->validate($field_value)) {
            $form_state->setErrorByName($field, $validator->getErrorMessage());
          }
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save values to step.
    $values = [];
    foreach ($this->step->getFieldNames() as $name) {
      $values[$name] = $form_state->getValue($name);
    }
    $this->step->setValues($values);
    $this->stepManager->addStep($this->step);

    // Change current step.
    $triggering_element = $form_state->getTriggeringElement();
    $this->stepId = $triggering_element['#goto_step'];

    // Call submit handler in case it is possible.
    if (isset($triggering_element['#submit_handler'])) {
      $handler = [$this, $triggering_element['#submit_handler']];
      if (is_callable($handler)) {
        $this->{$triggering_element['#submit_handler']}($form, $form_state);
      }
    }

    $form_state->setRebuild(TRUE);
  }

  /**
   * Handler to save introduced data.
   *
   * @param array $form
   *   Form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state interface.
   */
  public function saveData(array &$form, FormStateInterface $form_state) {
    $data = array();
    foreach ($this->stepManager->getAllSteps() as $step) {
      foreach ($step->getValues() as $field => $value) {
        $data[$field] = $value;
      }
    }
    $entity = entity_create('user_data_contact', $data);
    $entity->save();
    $this->stepManager->clearSteps();
  }

}
