$(document).ready(function() {
    // "use strict";

    // Display User
    displayAllBin();
    function displayAllBin(){
        $.ajax({
            url: 'core/controller.php',
            method: 'post',
            data: {action: 'display_bin'},
            success:function(response){
                $("#showbin").html(response);
            }
        });
    }

     // display bin Document for Admin Ajax
     displayAllAdminBin();
     function displayAllAdminBin(){
         $.ajax({
             url: 'core/controller.php',
             method: 'post',
             data: {action: 'display_bin_document'},
             success:function(response){
                 // console.log(response);
                 $("#adminshowbin").html(response);
             }
         });
     }


     //Resture Doc
     $("body").on("click", ".restoreDocumentBTN", function(e){
        e.preventDefault();
        res_bin_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Restore Document?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Restore it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: {res_bin_id: res_bin_id},
                    success:function(response){
                        console.log(response)
                        Swal.fire(
                        'Deleted!',
                        'Document restored Successfully',
                        'success'
                        ) 
                        displayAllBin();
                        displayAllAdminBin();
                    }
                });
            }
        });
    });


})