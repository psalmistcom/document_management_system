$(document).ready(function() {
    // "use strict";

    // Display Document for user Ajax
    displayAllDocument();
    function displayAllDocument(){
        $.ajax({
            url: 'core/controller.php',
            method: 'post',
            data: {action: 'display_document'},
            success:function(response){
                // console.log(response);
                $("#showDoc").html(response);
            }
        });
    }

    // display Document for Admin Ajax
    displayAllDocumentAdmin();
    function displayAllDocumentAdmin(){
        $.ajax({
            url: 'core/controller.php',
            method: 'post',
            data: {action: 'display_document_admin'},
            success:function(response){
                // console.log(response);
                $("#adminShowDoc").html(response);
            }
        });
    }

    // Add Document
    $("#adddocumentFormBTN").click(function(e){
        if($("#adddocumentForm")[0].checkValidity()){
            e.preventDefault();

            $("#adddocumentFormBTN").text('Please Wait...');            

            if($("#doc_name").val() == ""){
                $("#errordocument").text('* Document Title field is required!');
                $("#adddocumentFormBTN").text('Add Document');
            }else{
                var formdata = new FormData (document.getElementById('adddocumentForm'))
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: formdata,
                    processData: false,
                    contentType: false, 
                    cache: false,
                    beforeSend: function(){
                        $('#adddocumentFormBTN').attr("disabled","disabled");
                        $('#adddocumentForm').css("opacity",".5");
                    },
                    success:function(response){
                        // console.log(response);
                        if(response === 'documentAdded'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Added',
                                text: 'Document Added Successfully!',
                            });
                            $('#adddocumentForm').css("opacity","");
                            $("#adddocumentFormBTN").removeAttr("disabled");
                            $("#adddocumentForm")[0].reset();
                            $("#adddocumentFormBTN").text('Add Category');  
                            $("#addCategory").modal('hide');  
                            displayAllDocument();   
                            displayAllDocumentAdmin();                     
                        }else{
                            $("#errorcategory").html(response);
                            $('#adddocumentForm').css("opacity","");
                            $("#adddocumentFormBTN").removeAttr("disabled");
                            $("#adddocumentFormBTN").text('Add Category'); 
                        }
                        
                    }
                });
            }

        }
    });

    // Edit Document
    $("body").on("click", ".editDocumentBTN", function(e){
        e.preventDefault();
        document_edit_id = $(this).attr('id');

        $.ajax({
            url: 'core/controller.php',
            method: 'post',
            data: {document_edit_id: document_edit_id},
            success:function(response){
                // console.log(response);
                data = JSON.parse(response);
                $("#docid").val(data.id);
                $("#document_name").val(data.doc_name);
                $("#document_cateogory").val(data.doc_cateogory);
                $("#doc_file_main").val(data.main_doc);                
                $("#doc_doc_type").val(data.doc_type);                
                $("#doc_doc_size").val(data.doc_size);                
                              
            }
        });
    });

    // Update new ODcument
    $("#updateDocumentForm").submit(function(e){
        e.preventDefault();

        if($("#document_name").val() == ""){
            $("#updateErrordocument").text('* Document title field is required!');
            $("#updateDocumentFormBTN").text('Update Document');
        }else{
            var formdataa = new FormData (document.getElementById('updateDocumentForm'))
            $.ajax({
                url: 'core/controller.php',
                method: 'post',
                data: formdataa,
                processData: false,
                contentType: false, 
                cache: false,
                beforeSend: function(){
                    $('#updateDocumentFormBTN').attr("disabled","disabled");
                    $('#updateDocumentForm').css("opacity",".5");
                },
                success:function(response){
                    console.log(response);
                    // if(response === 'categoryUpdated'){
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: 'updated',
                    //         text: 'Category Updated Successfully!',
                    //     });
                    //     $('#updateDocumentForm').css("opacity","");
                    //     $("#updateDocumentFormBTN").removeAttr("disabled");
                    //     $("#updateDocumentForm")[0].reset();
                    //     $("#updateDocumentFormBTN").text('Update Category');  
                    //     $("#editDocument").modal('hide');  
                    //     displayAllDocument();   
                    //     displayAllDocumentAdmin();                     
                    // }else{
                    //     $("#errorcategory").html(response);
                    //     $('#updateDocumentForm').css("opacity","");
                    //     $("#updateDocumentFormBTN").removeAttr("disabled");
                    //     $("#updateDocumentFormBTN").text('Update Category'); 
                    // }
                    
                }
            });
        }

    })


     //Delete DOcument
     $("body").on("click", ".deletedocumentBTN", function(e){
        e.preventDefault();
        del_doc_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Move to recycle bin?!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Recycle it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: {del_doc_id: del_doc_id},
                    success:function(response){
                        // console.log(response)
                        Swal.fire(
                        'Trashed!',
                        'Moved to trash Successfully',
                        'success'
                        ) 
                        displayAllDocument();
                        displayAllDocumentAdmin();
                    }
                });
            }
        });
    });

    

        



})