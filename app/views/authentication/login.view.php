<!-- Example individual css  -->
<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/authentication/login.css">
<div class="login">

    <div class="">
        <div class="row justify-content-center center-card">
            <div class="col-xl-9">
                <div class="card border-0 rounded-lg shadow-lg overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row g-0 ">
                            <div class="col-sm-6 d-none d-sm-block bg-image"></div>
                            <div class="container-fluid col-sm-6 p-4">

                                <div class="text-center">
                                    <div class="login-image">
                                        <img src="<?php echo PARENT_FOLDER ?>/Public/img/Group 30.png" alt="PReS Logo">
                                    </div>
                                    <h2 class="pb-2">Sign In</h2>
                                </div>

                                <!-- Check Session for error -->
                                <?php
                                if (!empty($_SESSION["page_error"])) {
                                    echo
                                    "   
                                            <div class='error-box'>
                                                " . $_SESSION["page_error"] . "
                                            </div>    
                                        ";
                                }
                                ?>
                                <form action="<?php echo PARENT_FOLDER ?>/login/submit" method="POST" id="contactForm">
                                    <!-- Email Input -->
                                    <div class="form-floating pb-2">
                                        <input type="email" class="form-control " id="email" name="email" placeholder="name@example.com" value="<?php if (isset($data['email'])) {
                                                                                                                                                    echo $data['email'];
                                                                                                                                                } ?>" data-sb-validations="required,text">
                                        <label for="activity-officials">Email</label>
                                    </div>
                                    <!-- Password Input -->

                                    <div class="form-floating pb-4">
                                        <input type="password" class="form-control " id="password" name="password" placeholder="name@example.com" data-sb-validations="required,password">
                                        <label for="activity-officials">Password</label>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="d-grid pb-2">
                                        <button type="submit" class="btn btn-success btn-lg btn-block " name="submit">
                                            LOG IN
                                        </button>
                                    </div>
                                    <!-- <div class="d-grid pb-2">
                                        <a class="btn btn-success btn-lg btn-block " href="<?php echo PARENT_FOLDER ?>/admin/dashboard">
                                            Admin
                                        </a>
                                    </div> -->

                                    <!-- <p class="pt-2 pb-2">OR</p> -->

                                    <!-- Submit button -->
                                    <div class="d-grid pb-2">
                                        <!-- <button class="btn  btn-outline-success btn-lg btn-block " id="google" name="google" type="google">
                                            <div class="d-flex justify-content-center googleSign">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                                                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                                                    <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                                                    <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                                </svg>

                                                <p class="googleSign2">
                                                    Sign in with Google
                                                </p> -->
                                            <!-- </div> -->
                                        <!-- </button>  -->
                                    </div>
                                    <p class="pb-4">Don't have an account yet?
                                        <b><a href="<?php echo PARENT_FOLDER ?>/register" class="signUp">Sign up now</a>
                                        </b>
                                    </p>
                                    <p class="pb-4"><a href="#" class="signUp"><b>Forgot Password?</b></a></p>
                                </form>
                                <!-- End of contact form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>