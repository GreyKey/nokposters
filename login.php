<?php
    include_once('header.php');
?>

<!--BODY-->
<main>

    <div class="container my-3">
        <div class="row">
            <!--Login-->
            <div class="col-12 col-lg-6">
                <div> 
                    <form action="./login/authenticate.php" method="POST" id="login-form" class="p-2 m-2">
                        <h5>Login</h5>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="login-email">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" id="login-email" required="" minlength="3" value="">
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-sm-2 col-form-label" for="login-password">Password:</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="login-password" required="" minlength="6" value="">
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-12">
                                <button type="submit" id="login-submit" class="btn btn-info col me-2">Login</button>
                                <span id="login-error-message" class="col-9 align-middle text-danger"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Sign Up -->
            <div class="col-12 col-lg-6">
                <div>
                    <form action="" id="signup-form" class="p-2 m-2">
                        <h5>New Customer? Register</h5>
                        <div class="form-group row my-2">
                            <label class="col-sm-3 col-form-label" for="signup-email">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="signup-email" required="" minlength="3" value="">
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-sm-3 col-form-label" for="signup-firstname">First Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="signup-firstname" required="" minlength="3" maxlength="128" value="">
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-sm-3 col-form-label" for="signup-lastname">Last Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="signup-lastname" required="" minlength="3" maxlength="128" value="">
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-sm-3 col-form-label" for="signup-password">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="signup-password" required="" minlength="8" value="">
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-sm-3 col-form-label" for="signup-password-verify">Verify Password:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="signup-password-verify" required="" minlength="8" value="">
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <div class="col-sm-10">
                                <button type="submit" id="signup-submit" class="btn btn-info col me-2">Sign Up</button>
                                <span id="signup-error-message" class="col-9 align-middle text-danger"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    


</main>


<?php
    include_once('footer.php');
?>