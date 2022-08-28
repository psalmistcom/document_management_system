$(document).ready(function() {
    // "use strict";

    // Display Category
    displayAllCategory();
    function displayAllCategory(){
        $.ajax({
            url: 'core/controller.php',
            method: 'post',
            data: {action: 'display_category'},
            success:function(response){
                //console.log(response);
                $("#showCategory").html(response);
            }
        });
    }

    // Add category od doc
    $("#addcategoryFormBTN").click(function(e){
        if($("#addcategoryForm")[0].checkValidity()){
            e.preventDefault();

            $("#addcategoryFormBTN").text('Please Wait...');

            if($("#cat_title").val() == ""){
                $("#errorcategory").text('* Category field is required!');
                $("#addcategoryFormBTN").text('Add Category');
            }else{
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: $("#addcategoryForm").serialize()+'&action=addCategory',
                    beforeSend: function(){
                        $('#addcategoryFormBTN').attr("disabled","disabled");
                        $('#addcategoryForm').css("opacity",".5");
                    },
                    success:function(response){
                        // console.log(response);
                        if(response === 'categoryAdded'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Added',
                                text: 'Category Added Successfully!',
                            });
                            $('#addcategoryForm').css("opacity","");
                            $("#addcategoryFormBTN").removeAttr("disabled");
                            $("#addcategoryForm")[0].reset();
                            $("#addcategoryFormBTN").text('Add Category');  
                            $("#addCategory").modal('hide');  
                            displayAllCategory();                        
                        }else{
                            $("#errorcategory").html(response);
                            $('#addcategoryForm').css("opacity","");
                            $("#addcategoryFormBTN").removeAttr("disabled");
                            $("#addcategoryFormBTN").text('Add Category'); 
                        }
                        
                    }
                });
            }

        }
    });

    // Edit Category
    $("body").on("click", ".editCategoryBTN", function(e){
        e.preventDefault();
        cat_edit_id = $(this).attr('id');

        $.ajax({
            url: 'core/controller.php',
            method: 'post',
            data: {cat_edit_id: cat_edit_id},
            success:function(response){
                // console.log(response);
                data = JSON.parse(response);
                $("#catid").val(data.id);
                $("#catTitle").val(data.cat_title);
                              
            }
        });
    });

    // Update new Cateogry
    $("#updatecategoryForm").submit(function(e){
        e.preventDefault();

        if($("#catTitle").val() == ""){
            $("#update_errorcategory").text('* Category field is required!');
            $("#updatecategoryFormBTN").text('Update Category');
        }else{
            $.ajax({
                url: 'core/controller.php',
                method: 'post',
                data: $("#updatecategoryForm").serialize()+'&action=updateCategory',
                beforeSend: function(){
                    $('#updatecategoryFormBTN').attr("disabled","disabled");
                    $('#updatecategoryForm').css("opacity",".5");
                },
                success:function(response){
                    // console.log(response);
                    if(response === 'categoryUpdated'){
                        Swal.fire({
                            icon: 'success',
                            title: 'updated',
                            text: 'Category Updated Successfully!',
                        });
                        $('#updatecategoryForm').css("opacity","");
                        $("#updatecategoryFormBTN").removeAttr("disabled");
                        $("#updatecategoryForm")[0].reset();
                        $("#updatecategoryFormBTN").text('Update Category');  
                        $("#editCategory").modal('hide');  
                        displayAllCategory();                        
                    }else{
                        $("#errorcategory").html(response);
                        $('#updatecategoryForm').css("opacity","");
                        $("#updatecategoryFormBTN").removeAttr("disabled");
                        $("#updatecategoryFormBTN").text('Update Category'); 
                    }
                    
                }
            });
        }

    })


     //Delete Property
     $("body").on("click", ".deleteCategoryBTN", function(e){
        e.preventDefault();
        cat_del_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: {cat_del_id: cat_del_id},
                    success:function(response){
                        console.log(response)
                        Swal.fire(
                        'Deleted!',
                        'Category Deleted Successfully',
                        'success'
                        ) 
                        displayAllCategory();
                    }
                });
            }
        });
    });

    

        



})