jQuery(document).ready(function () {
   jQuery("#iac_widget_form").change(function () {
        var data = {'action': 'iac_widget_action'};

        data.inform_about_posts = jQuery('#iac_posts_checkbox').is(':checked') === true ? '1' : '0';
        data.inform_about_comments = jQuery('#iac_comments_checkbox').is(':checked') === true ? '1' : '0';

       // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
       jQuery.post('/wp-admin/admin-ajax.php', data, function(response) {
               jQuery('#saveResult').html("<div id='saveMessage' class='successModal'></div>");
               jQuery('#saveMessage').append("<p>Erfolgreich gespeichert<p>").show('slow');
               setTimeout(function () {
                   jQuery('#saveMessage').hide('slow');
               }, 5000);
       });
   });
});
