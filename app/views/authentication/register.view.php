<!-- Example individual css  -->
<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/authentication/register.css">

<SCript>
    function toggleOtherOfficeInput() {
        var officeSelect = document.getElementById('office');
        var otherOfficeInput = document.getElementById('otherOfficeInput');
        if (officeSelect.value === 'Other') {
            otherOfficeInput.style.display = 'block';
        } else {
            otherOfficeInput.style.display = 'none';
        }
    }
</SCript>

<div class="login">


    <div class="container-fluid">
        <div class="row justify-content-center center-card ">
            <div class="col-xl-6 ">
                <div class="card border-0 rounded-lg shadow-lg overflow-hidden mb-5 mt-4">
                    <div class="card-body p-0">
                        <div class="row ">
                            <!-- <div class="col-sm-6 d-none d-sm-block bg-image"></div> -->
                            <div class="container-fluid col-sm-11 col-md-11 col-lg-10">
                                <div class="login-image">
                                    <img src="<?php echo PARENT_FOLDER ?>/public/img/Group 30.png" alt="PReS Logo">
                                </div>
                                <div class="text-center">
                                    <h2>Create an Account</h2>
                                </div>
                                <?php
                                if (isset($_SESSION['page_error'])) {
                                    $pageError = $_SESSION['page_error'];
                                    $displayBlock = 'block';
                                } else {
                                    $displayBlock = 'none';
                                }
                                ?>
                                <label for="" id="error-label" class="error-box" style="display:<?php echo $displayBlock; ?>; margin-bottom:10px;"><?php echo $pageError; ?></label>

                                <!-- Check Session for error -->
                                <?php
                                // if (!empty($_SESSION["page_error"])) {
                                //     echo
                                //     "   
                                //             <div class='error-box'>
                                //                 " . $_SESSION["page_error"] . "
                                //             </div>    
                                //         ";
                                // }
                                ?>
                                <form action="<?php echo PARENT_FOLDER ?>/register/submit" method="POST" id="registration-form">
                                    <div class="form-floating pb-2">
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="name@example.com">
                                        <label for="fname" id="fname">First Name :</label>
                                    </div>
                                    <!-- <label for="fname">First Name: </label>
                                    <div class="mb-2 pb-2 ">
                                        <input type="text" name="fname" class="form-control  form-control2  rounded-input p-2" id="fname">
                                    </div> -->

                                    <div class="form-floating pb-2">
                                        <input type="text" class="form-control " id="mname" name="mname" placeholder="name@example.com">
                                        <label for="mname" id="mname">Middle Name (Optional):</label>
                                    </div>
                                    <div class="form-floating pb-2">
                                        <input type="text" class="form-control " id="lname" name="lname" placeholder="name@example.com">
                                        <label for="lname" id="lname">Last Name :</label>
                                    </div>

                                    <div class="form-floating pb-2">
                                        <select class="form-select" id="office" name="office" aria-label="Floating label select example p-2" onchange="toggleOtherOfficeInput()">
                                            <option value="" selected>Select option...</option>
                                            <option value="PIO">Public Information Office</option>
                                            <option value="OP">Office of the President</option>
                                            <option value="QAO">Quality Assurance Office</option>
                                            <option value="DIC">Dean's Office - Institute of Computing</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <label for="office">Office Assigned :</label>

                                    </div>

                                    <div id="otherOfficeInput" class="form-floating pb-2" style="display:none;">
                                        <input type="text" class="form-control" id="otherOffice" name="otherOffice" placeholder="Enter your office">
                                        <label for="otherOffice">Please specify:</label>
                                    </div>
                                    <div class="form-floating pb-2">
                                        <input type="text" class="form-control " id="position" name="position" placeholder="">
                                        <label for="lname" id="position">Position:</label>
                                    </div>

                                    <div class="form-floating pb-2">
                                        <input type="email" class="form-control " id="email" name="email" placeholder="name@example.com">
                                        <label for="email" id="email">Email :</label>
                                    </div>
                                    <div class="form-floating pb-2">
                                        <input type="number" class="form-control " id="contact" name="contact" placeholder="09123456789">
                                        <label for="contact" id="contact">Contact Number :</label>
                                    </div>
                                    <div class="form-floating pb-2">
                                        <input type="password" class="form-control " id="pass" name="pass" placeholder="name@example.com">
                                        <label for="pass" id="pass">Password :</label>
                                    </div>
                                    <div class="form-floating pb-2">
                                        <input type="password" class="form-control " id="cpass" name="cpass" placeholder="name@example.com">
                                        <label for="cpass" id="cpass">Confirm Password :</label>
                                    </div>



                                    <!-- Submit button -->
                                    <div class="d-grid pb-2">
                                        <button type="submit" class="btn btn-success btn-lg btn-block createAccount" name="submit">
                                            Create Account
                                        </button>

                                    </div>
                                    <!-- <div class="d-grid pb-2">
                                        <a class="btn btn-success btn-lg btn-block " href="<?php echo PARENT_FOLDER ?>/admin/dashboard">
                                            Admin
                                        </a>
                                    </div> -->

                                    <!-- <p class="pt-2 pb-2">OR</p> -->

                                    <!-- Submit button -->
                                    <!-- <div class="d-grid pb-2">
                                        <button class="btn  btn-outline-success btn-lg btn-block " id="google" name="google" type="google">
                                            <div class="d-flex justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                                                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                                                    <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                                                    <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                                </svg>

                                                <p class="googleSign">
                                                    Create Account with Google
                                                </p>
                                            </div>
                                        </button>
                                    </div> -->
                                    <p class="pb-4">Already have an account?
                                        <b><a href="<?php echo PARENT_FOLDER ?>/login" class="signUp">Sign In Now</a>
                                        </b>
                                    </p>

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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    window.error = "<?php echo isset($_SESSION['ui_error']) ? $_SESSION['ui_error'] : ''; ?>";
</script>

<script src="<?php echo PARENT_FOLDER ?>/public/js/authentication/registration.js"></script>
<?php
if (isset($_SESSION['success'])) {
    $url = PARENT_FOLDER . '/login';
    echo '
                <script> 
                let timerInterval;
                Swal.fire({
                title: "Successfully Registered!",
                text: "Redirecting to login page...",
                icon: "success",
                timer: 2500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
                }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = "' . $url . '";
                }
                });
                </script>
                ';
}
unset($_SESSION['success']);
?>