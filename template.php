<?php

/**
 * @file
 * The primary PHP file for this theme.
 */
function nmma_collection_theme_preprocess_page(&$variables) {
  // var_dump($vars['theme_hook_suggestions']);
  if (isset($variables['node']->type)) {
    // If the content type's machine name is "my_machine_name" the file
    // name will be "page--my-machine-name.tpl.php".
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }
}

function nmma_collection_theme_preprocess_block(&$variables) {
  $variables['theme_hook_suggestions'][] = 'block__' . $variables['block']->region;
  $variables['theme_hook_suggestions'][] = 'block__' . $variables['block']->module;
  $variables['theme_hook_suggestions'][] = 'block__' . $variables['block']->delta;

  // Add block description as template suggestion
  $block = block_custom_block_get($variables['block']->delta);

  // Transform block description to a valid machine name
  if (!empty($block['info'])) {
    setlocale(LC_ALL, 'en_US');

    // required for iconv()
    $variables['theme_hook_suggestions'][] = 'block__' . str_replace(' ', '_', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $block['info'])));
  }
}

function nmma_collection_theme_form_alter(&$form, &$form_state, $form_id){
  // dsm($form); // print $form array on the top of the page
  // if($form_id == "views-exposed-form"){
    if (isset($form['combine'])) {
      $form['combine']['#attributes'] = array('placeholder' => array(t('Discover by Artist Name, Title, or Keyword')));
    }

    if(isset($form['#form_id']) && $form['#form_id'] == 'open_access_entry_node_form') {
      $form['title']['#attributes'] = array('placeholder' => array(t('The title of your work')));
      $form['field_email']['und'][0]['value']['#attributes']['placeholder'] = t('Email');
      $form['field_oae_first_name']['und'][0]['value']['#attributes']['placeholder'] = t('First Name');
      $form['field_oae_last_name']['und'][0]['value']['#attributes']['placeholder'] = t('Last Name');
      $form['field_oae_description']['und'][0]['value']['#attributes']['placeholder'] = t('Please share a bit about your submission with us!');
    }
  // }
}

function open_access_entry_node_submit($form, &$form_state) {
  $form_state['redirect'] = 'seekin';
}