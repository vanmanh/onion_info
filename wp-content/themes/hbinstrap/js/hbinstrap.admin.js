jQuery(document).ready(function ($) {
    
    /*
    public function scripts()
    {
       wp_enqueue_script( 'media-upload' );
       wp_enqueue_media();
       wp_enqueue_script('our_admin', get_template_directory_uri() . '/assets/js/our_admin.js', array('jquery'));
    }
    */
    $(document).on("click", ".upload_image_button", function (e) {
      e.preventDefault();
      var $button = $(this);
 
 
      // Create the media frame.
      var file_frame = wp.media.frames.file_frame = wp.media({
         title: 'Select or upload image',
         library: { // remove these to show all
            type: 'image' // specific mime
         },
         button: {
            text: 'Select'
         },
         multiple: false  // Set to true to allow multiple files to be selected
      });
 
      // When an image is selected, run a callback.
      file_frame.on('select', function () {
         // We set multiple to false so only get one image from the uploader
 
         var attachment = file_frame.state().get('selection').first().toJSON();
 
         $button.siblings('input').val(attachment.url);
 
      });
 
      // Finally, open the modal
      file_frame.open();
   });
});
