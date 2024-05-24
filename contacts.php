<!--Nonfunctional Prototype-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Contact Manager Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- On load event to check for cookies -->
        <body onload = "readCookie()">
        <header id="nav-header" class="text-black nav py-5 bg-accent"> 
            <div id="home-button" class="text-black nav-link" type="button">Home</div>
            <div id="about-us-button" class="text-black nav-link" type="button">Logout</div>
            <div id="about-link" class="text-black nav-link" type="button">About</div>
        </header>
        <!-- Image Background -->
        <div class="py-6 bg-image-full" style="background-image: url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/5236376f-305d-42da-8e2d-48455360a090/ddzsehq-da9525d2-37e0-448f-aa49-a7274ba68387.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzUyMzYzNzZmLTMwNWQtNDJkYS04ZTJkLTQ4NDU1MzYwYTA5MFwvZGR6c2VocS1kYTk1MjVkMi0zN2UwLTQ0OGYtYWE0OS1hNzI3NGJhNjgzODcucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.nDVDNj0rk3vuQHD7DawjvowvIEn_70NADgE8MevlAOM')">
         
            <!-- "Glassy" Window -->
            <div class="container">

                <!--Search Bar-->
                <div class="text-center my-6">
                    <div id="search-bar" class="search-bar row">
                        <input type="text" placeholder="Search...">
                    </div>
                </div>

                <!--Search Results/Contacts Table-->
                <h3 class="text-center text-black">Contacts</h3>
                <div id="contact-table" class="table">

                    <!--each nested div at this indentation represents one row/contact-->
                    <div id="contact-row" class="cell">
                        <div id="contact-first-name" class="cell text-black">First Name</div>
                        <div id="contact-last-name" class="cell text-black">Last Name</div>
                        <div id="contact-email" class="cell text-black">Email</div>
                        <div id="contact-phone-number"class="cell text-black">Phone Number</div>
                        <div id="contact-edit" class="cell text-black" type="button">Edit</div>
                        <div id="contact-delete" class="cell text-black" type="button">Delete</div>
                    </div>
                </div>

                <!--TODO: FINISH PAGINATION-->
                <div id="page-selector" class="page-selector">

                </div>
            </div>
        </div>

        <!--Site Footer-->
        <footer class="py-5 bg-accent" id="footer">
            <div class="m-0 text-center text-black">A student project for COP4331, University of Central Florida</div>
        </footer>
    </body>
    <script src="js/app.js"></script>
</html>
