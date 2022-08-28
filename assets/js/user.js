$(document).ready(function() {
    // "use strict";

    // Display User
    displayAllUsers();
    function displayAllUsers(){
        $.ajax({
            url: 'core/controller.php',
            method: 'post',
            data: {action: 'display_users'},
            success:function(response){
                //console.log(response);
                $("#showUsers").html(response);
            }
        });
    }


     //Delete User
     $("body").on("click", ".deleteUser", function(e){
        e.preventDefault();
        del_user_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You can restore the user!",
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
                    data: {del_user_id: del_user_id},
                    success:function(response){
                        console.log(response)
                        Swal.fire(
                        'Deleted!',
                        'user Deleted Successfully',
                        'success'
                        ) 
                        displayAllUsers();
                    }
                });
            }
        });
    });

     //restore User
     $("body").on("click", ".restoreUser", function(e){
        e.preventDefault();
        res_user_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You can still restore the user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: {res_user_id: res_user_id},
                    success:function(response){
                        console.log(response)
                        Swal.fire(
                        'Deleted!',
                        'Category restored Successfully',
                        'success'
                        ) 
                        displayAllUsers();
                    }
                });
            }
        });
    });


     //Disapp Users
     $("body").on("click", ".disApproveUser", function(e){
        e.preventDefault();
        disapprove_user_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Did you want to disapprove this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Disapprove!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: {disapprove_user_id: disapprove_user_id},
                    success:function(response){
                        console.log(response)
                        Swal.fire(
                        'Disapproved!',
                        'User Disapproved Successfully',
                        'success'
                        ) 
                        displayAllUsers();
                    }
                });
            }
        });
    });

     //Approve Users
     $("body").on("click", ".ApproveUser", function(e){
        e.preventDefault();
        approve_user_id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Did you want to Approve this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'core/controller.php',
                    method: 'post',
                    data: {approve_user_id: approve_user_id},
                    success:function(response){
                        console.log(response)
                        Swal.fire(
                        'Approved!',
                        'User Approved Successfully',
                        'success'
                        ) 
                        displayAllUsers();
                    }
                });
            }
        });
    });


    

        



})