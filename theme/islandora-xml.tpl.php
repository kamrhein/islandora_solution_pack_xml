<?php

/**
 * @file
 * This is the template file for the object page for basic image
 *
 * @TODO: add documentation about file and available variables
 */
?>

<div class="islandora-xml-object islandora" >
  <div class="islandora-xml-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
      <fieldset class="collapsible collapsed" style="display: block; clear:both">
      <legend><span class="fieldset-legend"><?php print t('XML content'); ?></span></legend>
        <div class="fieldset-wrapper">
          <pre style="white-space: pre-wrap;"><?php print $islandora_content; ?></pre>
        </div>
      </fieldset>
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
