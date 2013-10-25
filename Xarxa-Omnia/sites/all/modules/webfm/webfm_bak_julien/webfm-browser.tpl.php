<?php
// $Id: webfm-browser.tpl.php,v 1.3 2011/01/16 01:45:08 nielshackius Exp $

/**
 * @file
 *    Display the webfm browser.
 *
 * Variables:
 * - $links: debug, settings and help links according to permissions
 * - $upload: upload fieldset if the user is permitted access
 *
 * @see webfm_theme(), webfm-popup.tpl.php
 */
?>
<div class="more-help-link">
  <?php print $links; ?>
</div>
<noscript><p class="err">JavaScript must be enabled in order to use webfm!</p></noscript>
<div id="webfm">
  <?php print $upload; ?>
</div>