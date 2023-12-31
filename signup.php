<?php
include "header.php";
?>

<script>
    function validateForm() {
        var email = document.forms["loginForm"]["email"].value;
        var password = document.forms["loginForm"]["password"].value;

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }
    }
</script>

<div class="bg-navy">
    <div class="container">
        <center>
            <br>
            <div class="card col-4 montserrat" style="padding-top: 20px; box-shadow: 0px 1px 8px 0.5px #FFF; border-radius: 20px;">
                <div class="card-body">
                    <form method="post" action="<?php echo $host;?>function/actSignup.php" onsubmit="validateForm()">
                    <h2 class="sr-only">Login Form</h2>
                        <?php if(@$_GET['status'] == 'failed'){?>
                            <b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">Signup Failed</b>
                        <?php } ?>
                        <?php if(@$_GET['status'] == 'failedKurang'){?>
                            <b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">Password must be 8 characters</b>
                        <?php } ?>
                        <?php if(@$_GET['status'] == 'failedBesar' || @$_GET['status'] == 'failedKecil'){?>
                            <b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">The password must have upper and lower case letters</b>
                        <?php } ?>
                        <?php if(@$_GET['status'] == 'failedAngka' || @$_GET['status'] == 'failedSymbol'){?>
                            <b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">
                                The password must contain a combination of numbers and symbols</b>
                        <?php } ?>

                    <center>
                        <img src="assets/img/icon-landing.svg" class="img-responsive" style="margin-bottom: 100px;">
                    </center>

                    <div class="form-group" style="color: #C4C4C4;">
                        <input class="form-control" type="text" name="fullname" placeholder="Full Name *" required>
                    </div>
                    <div class="form-group" style="color: #C4C4C4;">
                        <input class="form-control" type="email" name="email" placeholder="Email *" required></div>
                    <div class="form-group" style="color: #C4C4C4;">
                        <input class="form-control" type="password" name="password" placeholder="Password *" required></div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit"
                                style="background-color: #4972E1; width: 70%; box-shadow: 0px 1px 8px 1px #4972E1; border-radius: 10px;">
                            Sign Up
                        </button>
                    </div>
                    <a class="forgot" href="forgotPassword.php" style="font-size: 13px;"><u>Forgot password?</u></a>
                    </form>
                </div>
            </div>
        </center>
    </div>
    <br><br><br><br><br>
</div>

