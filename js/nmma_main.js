// var search_element = document.getElementById('edit-combine');
// if(search_element) {
//   search_element.placeholder = 'Discover by Artist Name, Title, or Keyword';
// }

if (Drupal.jsEnabled) {
  $(document).ready(function(){
    $('form#views-exposed-form-nmma-collection-view-page-2 input.form-text').example('Discover by Artist Name, Title, or Keyword', {className: 'search_example'});
  });
}