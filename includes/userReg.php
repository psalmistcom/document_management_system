<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-6 col-md-7">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create Account</h1>
                    </div>
                    <p id="regAlert"></p>
                    <form class="user" id="regAuthenticateUser" method="POST"> 
                        <div class="form-group">
                            <input type="text" class="d-block form-control" name="userName" id="userName" placeholder="Enter Full Name...">
                        </div>
                        <div class="form-group">
                            <input type="email" class="d-block form-control" name="userEmail" id="userEmail" placeholder="Enter Email Address...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="d-block form-control" name="userPassword" id="userPassword" placeholder="Password">
                        </div>                                    
                        <div class="form-group">
                            <input type="password" class="d-block form-control" name="confUserPassword" id="confUserPassword" placeholder="Confirm Password">
                        </div>                                    
                        <p id="passError" class="text-danger"></p>
                        <button id="regAuthenticateUserBTN" class="btn btn-bg-primary d-block btn-user btn-block">
                        <i class="fa fa-user mr-3"></i> Create Account </button>
                        <hr>                                
                    </form>
                    <div class="text-center">
                        Already have an Account? <a class="small" href="#" id="login-link">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>