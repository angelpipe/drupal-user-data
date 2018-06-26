<?php

namespace Drupal\user_data\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Provides a list controller for user_data_contact entity.
 *
 * @ingroup user_data
 */
class ContactListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['first_name'] = $this->t('First Name');
    $header['last_name'] = $this->t('Last Name');
    $header['gender'] = $this->t('Gender');
    $header['birth'] = $this->t('Birth');
    $header['city'] = $this->t('City');
    $header['phone'] = $this->t('Phone');
    $header['address'] = $this->t('Address');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['first_name'] = $entity->first_name->value;
    $row['last_name'] = $entity->last_name->value;
    $row['gender'] = $entity->gender->value;
    $row['birth'] = $entity->birth->value;
    $row['city'] = $entity->city->value;
    $row['phone'] = $entity->phone->value;
    $row['address'] = $entity->address->value;
    $row['actions'] = Link::createFromRoute(
      $this->t('delete'),
      'entity.user_data_contact.delete_form',
      array('user_data_contact' => $entity->id->value));
    return $row;
  }

}