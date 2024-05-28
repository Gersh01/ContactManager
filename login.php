<!--Nonfunctional Prototype-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Contact Manager Template</title>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Header - set the background image for the header in the line below-->
        <header id="splash-image" class="py-6 bg-image-full" style="background-image: url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/5236376f-305d-42da-8e2d-48455360a090/ddzsehq-da9525d2-37e0-448f-aa49-a7274ba68387.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzUyMzYzNzZmLTMwNWQtNDJkYS04ZTJkLTQ4NDU1MzYwYTA5MFwvZGR6c2VocS1kYTk1MjVkMi0zN2UwLTQ0OGYtYWE0OS1hNzI3NGJhNjgzODcucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.nDVDNj0rk3vuQHD7DawjvowvIEn_70NADgE8MevlAOM')">
            <div class="container">
                <div class="text-center my-6">
                    <h1 class="text-black fs-3 fw-bolder">Oceanic Connections</h1>
                    <p class="text-black mb-0">Your Premier Contact Manager</p>
                </div>
            </div>
        </header>

        <!--White Page Section-->
        <section class="py-5">

            <!--Login/Signup Cluster-->
            <div id="login-and-register-cluster" class="row justify-content-center text-center offset-2 offset-2-right">

                <!--Login Column-->
                <div id="login-column" class="col">
                   <label for ="login-username"  class="label" style="display:flex">Username </label>
                        <div class="search-bar row">
                        <input id="login-username" type="text" placeholder="Username">
                    </div>
                    <label for ="login-password" class="label" style="display:flex">Password</label>
                    <div class="search-bar-pass row">
                        <input id="login-password" type="password" placeholder="Password">
                    </div>
                    <!--Error Message-->
                    <a id="doLogin" href="javascript:doLogin();"><div id="login-button" class="button" type="button">Log in!</div></a>
                    <span id="login-result" class="error row cell"></span>
                </div>

                <!--Signup Column-->
                <div id="register-column" class="col">
                    <label for ="register-first-name"  class="label" style="display:flex">First Name </label>
                    <div class="search-bar row">
                        <input id="register-first-name" type="text" placeholder="First Name">
                    </div>
                    <label for ="register-last-name"  class="label" style="display:flex">Last Name </label>
                    <div class="search-bar row">
                        <input id="register-last-name" type="text" placeholder="Last Name">
                    </div>
                    <label for ="register-username"  class="label" style="display:flex">Username </label>
                    <div class="search-bar row">
                        <input id="register-username" type="text" placeholder="Username">
                    </div>
                    <label for ="register-password"  class="label" style="display:flex">Password </label>
                    <div class="search-bar-pass row">
                        <input id="register-password" type="password" placeholder="Password" required onkeyup = "passwordRegexChecker()">
                    </div>
                    <label for ="register-password-confirm"  class="label" style="display:flex">Confirm Password </label>
                     <div class="search-bar-pass row">
                        <input id="register-password-confirm" type="password" placeholder="Confirm Password" required onkeyup="confirmPassword()">
                    </div>
                    <!--Error Message-->
                    <a id="doRegister" href="javascript:doRegister()"><div class="button" type="button">Sign up!</div></a>
                    <span id="register-result" class="text-black row cell"></span>
                </div>
            </div>
        </section>

        <!--Footer-->
        <footer class="py-5 bg-accent" id="footer">
            <div class="m-0 text-center text-black">A student project for COP4331, University of Central Florida</div>
        </footer>
    </body>
    <script type="text/javascript" src="js/app.js"></script>
</html>
