// assets/js/app.js

// loads the jquery package from node_modules
import $ from 'jquery';
import 'select2';
// loads the Bootstrap jQuery plugins
import 'bootstrap-sass/assets/javascripts/bootstrap/transition.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/alert.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/collapse.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/dropdown.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/modal.js';

window.jQuery = $;
window.$ = $;

$(document).ready(function() {

    $('.select2').select2({
        tags: true,
        multiple: true,
        placeholder: '',
        allowClear: true,
        createTag: function(params) {
            // Don't offset to create a tag if there is no @ symbol
            if (params.term.indexOf('#') === -1) {
                // Return null to disable tag creation
                return null;
            }

            return {
                id: params.term,
                text: params.term
            }
        }
    });
});
