<?php

/**
 * @file
 * This is the template file for the object page for basic image
 *
 * @TODO: add documentation about file and available variables
 */
?>

<div class="islandora-xml-object islandora" vocab="http://schema.org/" prefix="dcterms: http://purl.org/dc/terms/">
  <div class="islandora-xml-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
      <div class="islandora-xml-content">
        <?php print $islandora_content; ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="islandora-xml-metadata">
    <?php print $description; ?>
    <?php print $metadata; ?>
    <?php if ($parent_collections): ?>
      <div>
        <h2><?php print t('In collections'); ?></h2>
        <ul>
          <?php foreach ($parent_collections as $collection): ?>
        <li><?php print l($collection->label, "islandora/object/{$collection->id}"); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <?php if ($hasPart_relations): ?>
      <div>
        <h2><?php print t('Has Parts'); ?></h2>
        <ul>
          <?php foreach ($hasPart_relations as $haspart): ?>
            <li><?php print l($haspart->label, "islandora/object/{$haspart->id}"); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <?php if ($isPartOf_relations): ?>
      <div>
        <h2><?php print t('Is Part Of'); ?></h2>
        <ul>
          <?php foreach ($isPartOf_relations as $ispart): ?>
            <li><?php print l($ispart->label, "islandora/object/{$ispart->id}"); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>
</div>
