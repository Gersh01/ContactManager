<!--Nonfunctional Prototype-->
<!DOCTYPE html>
<html lang="en">
    <!-- On load event to check for cookies -->
    <body onload= "readCookie(); firstPage()">
    
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
        <header id="nav-header" class="text-black nav py-5 bg-accent"> 
            <div id="home-button" class= "header-link button" type="button">Home</div>
            <a id="about-us_button" href="javascript:doLogout()"> <div id="about-us-button" class="header-link button" type="button">Logout</div></a>
            <div id="about-link" class="header-link button" type="button">About</div>
        </header>
        <!-- Image Background -->
        <div class="py-6 bg-image-full" style="background-image: url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/5236376f-305d-42da-8e2d-48455360a090/ddzsehq-da9525d2-37e0-448f-aa49-a7274ba68387.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzUyMzYzNzZmLTMwNWQtNDJkYS04ZTJkLTQ4NDU1MzYwYTA5MFwvZGR6c2VocS1kYTk1MjVkMi0zN2UwLTQ0OGYtYWE0OS1hNzI3NGJhNjgzODcucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.nDVDNj0rk3vuQHD7DawjvowvIEn_70NADgE8MevlAOM')">
         
            <!-- "Glassy" Window -->
            <div class="container">

                <!--Search Results/Contacts Table-->
                <h3 class="text-center text-black">Contacts</h3>
                <div id="contact-table">

                    <!--Search Bar-->
                    <div class="text-center my-6">
                        <div id="search-bar-row" class="search-bar row-alt">
                            <input id="search-bar" type="text" placeholder="Search..." required onkeyup = "searchContact()">
                            <a id="refresh-button" href="javascript:firstPage()" class="text-black a-link"><div id="refreshButton" class="text-black refresh-page" type="button">Refresh</div></a>
                            <a id="add-contact-button" href="javascript:showTable()" class="text-black a-link"><div id="addContactButton" class="text-black refresh-page" type="button">Add Contact</div></a>
                            <a id="cancel-add-contact-button" href="javascript:showTable()" class="text-black a-link" style="display:none"><div id="addContactButton" class="text-black refresh-page" type="button">Cancel</div></a>
                        </div>
                    </div>

                    <!--each nested div at this indentation represents one row/contact-->
                    <div id="contacts-hideable" class="contacts-hide" style="display:block">
                        <div id="table" class="table">
                            <div id="contact-row-top" class="cell-top">
                                <div id="contact-first-name" class="cell text-black">First Name</div>
                                <div id="contact-last-name" class="cell text-black">Last Name</div>
                                <div id="contact-email" class="cell text-black">Email</div>
                                <div id="contact-phone-number" class="cell text-black">Phone Number</div>
                                <div id="contact-edit" class="text-black icon-cell">Edit</div>
                                <div id="contact-delete" class="text-black icon-cell">Delete</div>
                            </div>
                            <div id="contact-row-1" class="cell">
                                <span id="contact-first-name-1" class="cell text-black"></span>
                                <input id="contact-first-name-edit-1" type="text" class="cell text-black" style="display:none">

                                <div id="contact-last-name-1" class="cell text-black"></div>
                                <input id="contact-last-name-edit-1" type="text" class="cell text-black" style="display:none">

                                <div id="contact-email-1" class="cell text-black"></div>
                                <input id="contact-email-edit-1" type="text" class="cell text-black" style="display:none">

                                <div id="contact-phone-number-1" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-1" type="text" class="cell text-black" style="display:none">

                                <a id="contact-edit-1" href="javascript:updateContact(1)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-1" href="javascript:saveContact(1)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-1" href="javascript:deleteContact(1)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-1" href="javascript:cancelContact(1)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Cancel</div></a>
                                
                            </div>
                            <div id="contact-row-2" class="cell">
                                <span id="contact-first-name-2" class="cell text-black"></span>
                                <input id="contact-first-name-edit-2" type="text" style="display:none">

                                <div id="contact-last-name-2" class="cell text-black"></div>
                                <input id="contact-last-name-edit-2" type="text" style="display:none">

                                <div id="contact-email-2" class="cell text-black"></div>
                                <input id="contact-email-edit-2" type="text" style="display:none">

                                <div id="contact-phone-number-2" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-2" type="text" style="display:none">

                                <a id="contact-edit-2" href="javascript:updateContact(2)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-2" href="javascript:saveContact(2)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-2" href="javascript:deleteContact(2)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-2" href="javascript:saveContact(2)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                            </div>
                            <div id="contact-row-3" class="cell">
                                <span id="contact-first-name-3" class="cell text-black"></span>
                                <input id="contact-first-name-edit-3" type="text" style="display:none">

                                <div id="contact-last-name-3" class="cell text-black"></div>
                                <input id="contact-last-name-edit-3" type="text" style="display:none">

                                <div id="contact-email-3" class="cell text-black"></div>
                                <input id="contact-email-edit-3" type="text" style="display:none">

                                <div id="contact-phone-number-3" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-3" type="text" style="display:none">

                                <a id="contact-edit-3" href="javascript:updateContact(3)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-3" href="javascript:saveContact(3)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-3" href="javascript:deleteContact(3)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-3" href="javascript:saveContact(3)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                            </div>
                            <div id="contact-row-4" class="cell">
                                <span id="contact-first-name-4" class="cell text-black"></span>
                                <input id="contact-first-name-edit-4" type="text" style="display:none">

                                <div id="contact-last-name-4" class="cell text-black"></div>
                                <input id="contact-last-name-edit-4" type="text" style="display:none">

                                <div id="contact-email-4" class="cell text-black"></div>
                                <input id="contact-email-edit-4" type="text" style="display:none">

                                <div id="contact-phone-number-4" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-4" type="text" style="display:none">

                                <a id="contact-edit-4" href="javascript:updateContact(4)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-4" href="javascript:saveContact(4)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-4" href="javascript:deleteContact(4)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-4" href="javascript:saveContact(4)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                            </div>
                            <div id="contact-row-5" class="cell">
                                <span id="contact-first-name-5" class="cell text-black"></span>
                                <input id="contact-first-name-edit-5" type="text" style="display:none">

                                <div id="contact-last-name-5" class="cell text-black"></div>
                                <input id="contact-last-name-edit-5" type="text" style="display:none">

                                <div id="contact-email-5" class="cell text-black"></div>
                                <input id="contact-email-edit-5" type="text" style="display:none">

                                <div id="contact-phone-number-5" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-5" type="text" style="display:none">

                                <a id="contact-edit-5" href="javascript:updateContact(5)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-5" href="javascript:saveContact(5)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-5" href="javascript:deleteContact(5)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-5" href="javascript:saveContact(5)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                            </div>
                            <div id="contact-row-6" class="cell">
                                <span id="contact-first-name-6" class="cell text-black"></span>
                                <input id="contact-first-name-edit-6" type="text" style="display:none">

                                <div id="contact-last-name-6" class="cell text-black"></div>
                                <input id="contact-last-name-edit-6" type="text" style="display:none">

                                <div id="contact-email-6" class="cell text-black"></div>
                                <input id="contact-email-edit-6" type="text" style="display:none">

                                <div id="contact-phone-number-6" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-6" type="text" style="display:none">

                                <a id="contact-edit-6" href="javascript:updateContact(6)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-6" href="javascript:saveContact(6)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-6" href="javascript:deleteContact(6)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-6" href="javascript:saveContact(6)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                            </div>
                            <div id="contact-row-7" class="cell">
                                <span id="contact-first-name-7" class="cell text-black"></span>
                                <input id="contact-first-name-edit-7" type="text" style="display:none">

                                <div id="contact-last-name-7" class="cell text-black"></div>
                                <input id="contact-last-name-edit-7" type="text" style="display:none">

                                <div id="contact-email-7" class="cell text-black"></div>
                                <input id="contact-email-edit-7" type="text" style="display:none">

                                <div id="contact-phone-number-7" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-7" type="text" style="display:none">

                                <a id="contact-edit-7" href="javascript:updateContact(7)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-7" href="javascript:saveContact(7)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-7" href="javascript:deleteContact(7)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-7" href="javascript:saveContact(7)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                            </div>
                            <div id="contact-row-8" class="cell">
                                <span id="contact-first-name-8" class="cell text-black"></span>
                                <input id="contact-first-name-edit-8" type="text" style="display:none">

                                <div id="contact-last-name-8" class="cell text-black"></div>
                                <input id="contact-last-name-edit-8" type="text" style="display:none">

                                <div id="contact-email-8" class="cell text-black"></div>
                                <input id="contact-email-edit-8" type="text" style="display:none">

                                <div id="contact-phone-number-8" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-8" type="text" style="display:none">

                                <a id="contact-edit-8" href="javascript:updateContact(8)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-8" href="javascript:saveContact(8)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-8" href="javascript:deleteContact(8)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-8" href="javascript:saveContact(8)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>
                            </div>
                            <div id="contact-row-9" class="cell">
                                <span id="contact-first-name-9" class="cell text-black"></span>
                                <input id="contact-first-name-edit-9" type="text" style="display:none">

                                <div id="contact-last-name-9" class="cell text-black"></div>
                                <input id="contact-last-name-edit-9" type="text" style="display:none">

                                <div id="contact-email-9" class="cell text-black"></div>
                                <input id="contact-email-edit-9" type="text" style="display:none">

                                <div id="contact-phone-number-9" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-9" type="text" style="display:none">

                                <a id="contact-edit-9" href="javascript:updateContact(9)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-9" href="javascript:saveContact(9)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-9" href="javascript:deleteContact(9)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-9" href="javascript:saveContact(9)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>
                                

                            </div>
                            <div id="contact-row-10" class="cell">
                                <span id="contact-first-name-10" class="cell text-black"></span>
                                <input id="contact-first-name-edit-10" type="text" style="display:none">

                                <div id="contact-last-name-10" class="cell text-black"></div>
                                <input id="contact-last-name-edit-10" type="text" style="display:none">

                                <div id="contact-email-10" class="cell text-black"></div>
                                <input id="contact-email-edit-10" type="text" style="display:none">

                                <div id="contact-phone-number-10" class="cell text-black"></div>
                                <input id="contact-phone-number-edit-10" type="text" style="display:none">

                                <a id="contact-edit-10" href="javascript:updateContact(10)" class="icon-cell text-black a-link-alt"><div id="editButton" class="text-black icon-cell" type="button">Edit</div></a>
                                <a id="contact-save-edit-10" href="javascript:saveContact(10)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                                <a id="contact-delete-10" href="javascript:deleteContact(10)" class="icon-cell text-black a-link-alt"><div id="deleteButton" class="text-black icon-cell" type="button">Delete</div></a>
                                <a id="contact-save-edit-10" href="javascript:saveContact(10)" class="icon-cell text-black a-link-alt" style="display:none"><div id="editButton" class="text-black icon-cell" type="button">Save</div></a>

                            </div>
                        </div>
                    
                        <span id="contact-result" class="text-black row cell"></span>
                    
                        <!--TODO: FINISH PAGINATION-->
                        <div id="page-selector" class="row-alt justify-content-end">
                            <div id="backButton" class="move-page" type="button">Previous</div>
                            <div id="forwardButton" class="move-page" type="button">Next</div>
                        </div>
                    </div>

                    <!--Add Contact Section (display none by default)-->
                    <div id="add-contact" style="display:none" class="table">
                        <div class="search-bar row">
                            <input id="add-contact-first-name" type="text" placeholder="First Name">
                        </div>
                        <div class="search-bar row">
                            <input id="add-contact-last-name" type="text" placeholder="Last Name">
                        </div>
                        <div class="search-bar row">
                            <input id="add-contact-email" type="text" placeholder="Email">
                        </div>
                        <div class="search-bar row">
                            <input id="add-contact-phone-number" type="text" placeholder="Phone Number">
                        </div>

                        <!--Button-->
                        <a id="addContact" href="javascript:addContact()"><div class="button" type="button">Add User</div></a>
                    </div>

                    <span id="add-contact-result" class="text-black row cell"></span>
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
