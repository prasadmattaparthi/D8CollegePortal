<?php

namespace Drupal\faculty_reg;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

class facultyAccessControlHandler extends EntityAccessControlHandler {

  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view faculty entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit faculty entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete faculty entity');
    }
    return AccessResult::allowed();
  }


  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add faculty entity');
  }

}
?>
