<?php
namespace Drupal\IMPORT_EXAMPLE;

use Drupal\node\Entity\Node;

class addImportContent {
  public static function addImportContentItem($item, &$context){
    $context['sandbox']['current_item'] = $item;
    $message = 'Creating ' . $item['title'];
    $results = array();
    create_node($item);
    $context['message'] = $message;
    $context['results'][] = $item;
  }
  function addImportContentItemCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'One item processed.', '@count items processed.'
      );
    }
    else {
      $message = t('Finished with an error.');
    }
    drupal_set_message($message);
  }
}

// This function actually creates each item as a node as type 'Page'
function create_node($item) {
  $node_data['type'] = 'page';
  $node_data['title'] = $item['title'];
  $node_data['body']['value'] = $item['content'];
  // Setting a simple textfield to add a unique ID so we can use it to query against if we want to manipulate this data again.
  $node_data['field_unique_id']['value'] = $item['id'];
  $node = Node::create($node_data);
  $node->setPublished(TRUE);
  $node->save();
} 