$(document).ready(function() {
    "use strict";

    $("#regAuthenticateUserBTN").click(function(e){
        if($("#regAuthenticateUser")[0].checkValidity()){
            e.preventDefault();

            $("#regAuthenticateUserBTN").text('Please Wait...');
        
            if($("#userPassword").val() != $("#confUserPassword").val()){
                $("#passError").text('* Password did not matched!');
                $("#regAuthenticateUserBTN").text('Create Account');
            }
            else{
                $("#passError").text('');
                $.ajax({
                    url: 'core/class.php',
                    method: 'post',
                    data: $("#regAuthenticateUser").serialize()+'&action=register',
                    beforeSend: function(){
                        $('#regAuthenticateUserBTN').attr("disabled","disabled");
                        $('#regAuthenticateUser').css("opacity",".5");
                    },
                    success:function(response){
                        // console.log(response);
                        $('#regAuthenticateUser').css("opacity","");
                        $("#regAuthenticateUserBTN").removeAttr("disabled");
                        // $("#regAuthenticateUser")[0].reset();
                        $("#regAuthenticateUserBTN").html('<i class="fa fa-user mr-3"></i>' + 'Create Account');
                        if(response === 'register'){
                            window.location = 'verification';
                        }else{
                        $("#regAlert").html(response);
                        }
                    }
                });
            }
        }
    });

    // ... Login User 
    $('#authenticateUserBTN').click(function(e){

        if($('#authenticateUser')[0].checkValidity()){
            e.preventDefault();
            $("#authenticateUserBTN").text('Please Wait...');

            $.ajax({
                url: 'core/class.php',
                method: 'post',
                data: $("#authenticateUser").serialize()+'&action=login',
                beforeSend: function(){
                    $('#authenticateUserBTN').attr("disabled","disabled");
                    $('#authenticateUserBTN').css("opacity",".5");
                },
                success:function(response){
                    // console.log(response);
                    $('#authenticateUserBTN').css("opacity","");
                    $("#authenticateUserBTN").removeAttr("disabled");
                    // $("#authenticateUser")[0].reset();
                    $("#authenticateUserBTN").html('<i class="fas fa-check mr-3"></i>' + 'Login');
                    if(response === 'userLogin'){
                        window.location = 'verification';
                    }else{
                    $("#loginAlert").html(response);
                    }
                }
            });
        }
    })

})