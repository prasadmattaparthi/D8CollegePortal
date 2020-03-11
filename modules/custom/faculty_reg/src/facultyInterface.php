<?php

namespace Drupal\faculty_reg;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a student entity.
 * @ingroup student_entity
 */
interface facultyInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}

?>
