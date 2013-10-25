
Drupal.verticalTabs = Drupal.verticalTabs || {};

Drupal.verticalTabs.path_redirect = function() {
  if ($('fieldset.vertical-tabs-path_redirect table tbody td.empty').size()) {
    return Drupal.t('No redirects');
  }
  else {
    var redirects = $('fieldset.vertical-tabs-path_redirect table tbody tr').size();
    return Drupal.formatPlural(redirects, '1 redirect', '@count redirects');
  }
}
