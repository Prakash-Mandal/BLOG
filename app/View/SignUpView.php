<?php
namespace View;

?>
<!DOCTYPE html>
<html lang="en">
<body>
<div class="container-fluid">
    <div class="jumbotron row" style="text-align: left;">
        <div class="jumbotron col-sm-6">
            <img class="img-thumbnail" src="../Images/Entrepreneur-Blogs.jpg" alt="../Images/Entrepreneur-Blogs.jpg">
        </div>
        <div class="jumbotron col-sm-6 text-center" style="padding: 100px text-align: left">
            <form method="POST" id="SignupForm" class="form-group text-center mb-md-3" onsubmit="return validateSignup()">
                <span class="form-inline ml-sm-5">
                    <input type="text" class="form-control mb-md-3 ml-md-5" id="first_name" name="first_name"
                           oninput="validateFirstName()" placeholder="Enter First Name">
                    <span id="first_name_error" class="ml-sm-2">*</span>
                </span>
                <span class="form-inline ml-sm-5">
                    <input type="text" class="form-control mb-md-3 ml-md-5" id="last_name" name="last_name"
                           oninput="validateLastName()" placeholder="Enter Last name">
                    <span id="last_name_error" class="ml-sm-2"></span>

                </span>
                <span class="form-inline ml-sm-5">
                    <input type="email" class="form-control mb-md-3 ml-md-5" name="email" id="email"
                           onchange="validateEmail()" oninput="checkEmail()"
                           autocomplete="username email" placeholder="Enter email">
                    <span id="email_error" class="ml-sm-2">*</span>
                </span>
                <span class="form-inline ml-sm-5">
                    <input type="password" class="form-control mb-md-3 ml-md-5" name="pass" id="pass"
                           oninput="validatePassword()" autocomplete="new-password" placeholder="Enter Password">
                    <span id="pass_error" class="ml-sm-2">*</span>
                </span>
                <span class="form-inline ml-sm-5">
                    <input type="password" class="form-control mb-md-3 ml-md-5" name="u_rpass" id="r_pwd"
                           oninput="validatePassword()" autocomplete="new-password" placeholder="Enter Password Again">
                    <span id="rpass_error" class="ml-sm-2">*</span>
                </span>
                <span class="form-inline ml-sm-5">
                    <button type="submit" class="btn btn-primary ml-md-5" id="signupSubmit" name="signupSubmit" value="Submit">
                        Signup
                    </button>
                </span>
            </form>
        </div>
    </div>
</div>
</body>
</html>