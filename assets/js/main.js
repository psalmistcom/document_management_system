// image preview before submit 
$(document).ready(function(){
    // when user clicks on the upload profile image button ...
    $(document).on('click', '#main_doc_placeholder', function(){
      // ...use Jquery to click on the hidden file input field
      $('#main_doc').click();
      // a 'change' event occurs when user selects image from the system.
      // when that happens, grab the image and display it
      $(document).on('change', '#main_doc', function(){
        // grab the file
        var file = $('#main_doc')[0].files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // set the value of the input for profile picture
                $('#main_doc').attr('value', file.name);
                // display the image
                $('#main_doc_placeholder').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
      });
    });
  });