<main class="container">
<div class="row justify-content-center">
    <!--Admin Login-->
    <div class="col-lg-6 col-md-10 col-12 my-5">
        <div> 
            <form action="./login/authenticate-admin.php" method="POST" id="login-admin-form" class="p-4 m-2">
                <h5 class="text-center">Login as Admin</h5>
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
</div>
</main>