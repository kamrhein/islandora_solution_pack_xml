<?php
/**
* @file
* Theme functions for the islandora_solr_metadata module.
*/

/** 
 * Implements hook_preprocess_theme().
 */
function islandora_xml_preprocess_islandora_xml(array &$variables) {
  drupal_add_js('misc/form.js');
  drupal_add_js('misc/collapse.js');
  $islandora_object = $variables['islandora_object'];
  $repository = $islandora_object->repository;
  module_load_include('inc', 'islandora', 'includes/datastream');
  module_load_include('inc', 'islandora', 'includes/utilities');
  module_load_include('inc', 'islandora', 'includes/metadata');

  // We should eventually remove the DC object and dc_array code as it only
  // exists to not break legacy implementations.
  if (islandora_datastream_access(ISLANDORA_VIEW_OBJECTS, $islandora_object['DC'])) {
    try {
      $dc = $islandora_object['DC']->content;
      $dc_object = DublinCore::importFromXMLString($dc);
    }
    catch (Exception $e) {
      drupal_set_message(t('Error retrieving object %s %t', array('%s' => $islandora_object->id, '%t' => $e->getMessage())), 'error', FALSE);
    }
  }
  $variables['islandora_dublin_core'] = isset($dc_object) ? $dc_object : NULL;
  $variables['dc_array'] = isset($dc_object) ? $dc_object->asArray() : array();
  $variables['islandora_object_label'] = $islandora_object->label;
  $variables['theme_hook_suggestions'][] = 'islandora_xml__' . str_replace(':', '_', $islandora_object->id);
  $variables['parent_collections'] = islandora_get_parents_from_rels_ext($islandora_object);
  $variables['hasPart_relations'] = islandora_get_haspart_from_rels_ext($islandora_object);
  $variables['isPartOf_relations'] = islandora_get_ispartof_from_rels_ext($islandora_object);
  $variables['metadata'] = islandora_retrieve_metadata_markup($islandora_object);
  $variables['description'] = islandora_retrieve_description_markup($islandora_object);

  $variables['islandora_thumbnail_img'] = NULL;

  if (isset($islandora_object['XML']) && islandora_datastream_access(ISLANDORA_VIEW_OBJECTS, $islandora_object['XML'])) {
    $xml_url = url("islandora/object/{$islandora_object->id}/datastream/XML/view");
    $params = array(
      'title' => $islandora_object->label,
      'path' => $xml_url,
    );
    $xml_str = trim($islandora_object['XML']->content);
    $command = "echo '$xml_str' | seria -y -";
    $variables['islandora_content'] = shell_exec($command);
  }
  else {
    $variables['islandora_content'] = NULL;
  }
}

