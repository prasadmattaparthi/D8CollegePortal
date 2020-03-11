<?php

namespace Drupal\student_entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a student entity.
 * @ingroup student_entity
 */
interface studentInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}

?>
