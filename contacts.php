<!--Nonfunctional Prototype-->
<!DOCTYPE html>
<html lang="en">
    <!-- On load event to check for cookies -->
    <body onload= "readCookie(); firstPage(null, null)">
        
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
            <a class="text-black" href="http://oceanic-connections.xyz/contacts.php" aira-label="button"><div id="home-button" class= "header-link button" type="button">Home</div></a>
            <a class="text-black" href="http://oceanic-connections.xyz/about.php" aira-label="button"><div id="about-link" class="header-link button" type="button">About</div></a>
            <a class="text-black logout" href="javascript:doLogout()" aira-label="button"> <div id="about-us-button" class="header-link button" type="button">Logout</div></a>
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
                            <a id="search-favorites-off" href="javascript:favoriteSearch()" class="text-black a-link" aira-label="button"><div id="searchAll" class="text-black refresh-page" type="button"><img src="images/favorite-no-fill.png" alt="non-fave search" class="icon"></img></div></a>
                            <a id="search-favorites-on" href="javascript:favoriteSearch()" class="text-black a-link" style="display:none" aira-label="button"><div id="searchFaves" class="text-black refresh-page" type="button"><img src="images/favorite-fill.png" alt="fave search" class="icon"></img></div></a>
                            
                            <input id="search-bar" type="text" placeholder="Search..." required onkeyup = "searchContact(null, null, null, null, null)">
                            <a id="refresh-button" href="javascript:firstPage(null, null)" class="text-black a-link" aira-label="button"><div id="refreshButton" class="text-black refresh-page" type="button"><img src="images/refresh.png" alt="refresh" class="icon"></img></div></a>
                            <a id="add-contact-button" href="javascript:showTable()" class="text-black a-link" aira-label="button"><div id="addContactButton" class="text-black refresh-page" type="button"><img src="images/add-contact.png" alt="add contact" class="icon"></img></div></a>
                        </div>
                    </div>

                    <!--each nested div at this indentation represents one row/contact-->
                    <div id="contacts-hideable" class="contacts-hide" style="display:block">
                        <table id="table" class="table">
                            <thead id="contact-row-top">
                                <tr class="table-header">
                                    <th id="contact-first-name" >Favorite</th>
                                    <th id="contact-first-name" >First Name</th>
                                    <th id="contact-last-name" >Last Name</th>
                                    <th id="contact-email" >Email</th>
                                    <th id="contact-phone-number">Phone Number</th>
                                    <th id="contact-edit">Edit</th>
                                    <th id="contact-delete">Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr id="contact-row-1">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-1" href="javascript:favoriteContact(1, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-1" href="javascript:favoriteContact(1, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-1"></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-1" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-1"></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-1" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-1"></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-1" type="text" required onkeyup="confirmValidContactRegex(1)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-1"></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-1" type="text" required onkeyup="confirmValidPhoneRegex(1)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-1" href="javascript:updateContact(1)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-1" href="javascript:saveContact(1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-1" href="javascript:deleteContact(1)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-1" href="javascript:cancelContact(1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-2">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-2" href="javascript:favoriteContact(2, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-2" href="javascript:favoriteContact(2, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-2" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-2" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-2" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-2" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-2" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-2" type="text" required onkeyup="confirmValidContactRegex(2)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-2" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-2" type="text" required onkeyup="confirmValidPhoneRegex(2)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-2" href="javascript:updateContact(2)" aira-label="button"><div id="editButton" type="button" aira-label="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-2" href="javascript:saveContact(2)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-2" href="javascript:deleteContact(2)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-2" href="javascript:cancelContact(2)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-3">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-3" href="javascript:favoriteContact(3, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-3" href="javascript:favoriteContact(3, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-3" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-3" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-3" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-3" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-3" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-3" type="text" required onkeyup="confirmValidContactRegex(3)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-3" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-3" type="text" required onkeyup="confirmValidPhoneRegex(3)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-3" href="javascript:updateContact(3)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-3" href="javascript:saveContact(3)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-3" href="javascript:deleteContact(3)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-3" href="javascript:cancelContact(3)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-4">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-4" href="javascript:favoriteContact(4, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-4" href="javascript:favoriteContact(4, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-4" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-4" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-4" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-4" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-4" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-4" type="text" required onkeyup="confirmValidContactRegex(4)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-4" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-4" type="text" required onkeyup="confirmValidPhoneRegex(4)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-4" href="javascript:updateContact(4)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-4" href="javascript:saveContact(4)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-4" href="javascript:deleteContact(4)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-4" href="javascript:cancelContact(4)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-5">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-5" href="javascript:favoriteContact(5, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-5" href="javascript:favoriteContact(5, 1)" style="display:none" aira-label="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-5" ></div>
                                        <div  class="search-bar row">
                                            <input id="contact-first-name-edit-5" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-5" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-5" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-5" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-5" type="text" required onkeyup="confirmValidContactRegex(5)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-5" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-5" type="text" required onkeyup="confirmValidPhoneRegex(5)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-5" href="javascript:updateContact(5)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-5" href="javascript:saveContact(5)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-5" href="javascript:deleteContact(5)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-5" href="javascript:cancelContact(5)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-6">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-6" href="javascript:favoriteContact(6, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-6" href="javascript:favoriteContact(6, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-6" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-6" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-6" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-6" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-6" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-6" type="text" required onkeyup="confirmValidContactRegex(6)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-6" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-6" type="text" required onkeyup="confirmValidPhoneRegex(6)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-6" href="javascript:updateContact(6)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit" ></img></div></a>
                                        <a id="contact-save-edit-6" href="javascript:saveContact(6)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-6" href="javascript:deleteContact(6)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-6" href="javascript:cancelContact(6)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-7">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-7" href="javascript:favoriteContact(7, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon"></img></div></a>
                                        <a id="contact-fave-7" href="javascript:favoriteContact(7, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-7" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-7" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-7" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-7" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-7" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-7" type="text" required onkeyup="confirmValidContactRegex(7)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-7" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-7" type="text" required onkeyup="confirmValidPhoneRegex(7)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-7" href="javascript:updateContact(7)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-7" href="javascript:saveContact(7)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-7" href="javascript:deleteContact(7)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-7" href="javascript:cancelContact(7)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-8">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-8" href="javascript:favoriteContact(8, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-8" href="javascript:favoriteContact(8, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-8" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-8" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-8" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-8" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-8" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-8" type="text" required onkeyup="confirmValidContactRegex(8)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-8" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-8" type="text" required onkeyup="confirmValidPhoneRegex(8)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-8" href="javascript:updateContact(8)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-8" href="javascript:saveContact(8)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-8" href="javascript:deleteContact(8)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-8" href="javascript:cancelContact(8)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-9">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-9" href="javascript:favoriteContact(9, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-9" href="javascript:favoriteContact(9, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-9" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-9" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-9" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-9" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-9" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-9" type="text" required onkeyup="confirmValidContactRegex(9)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-9" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-9" type="text" required onkeyup="confirmValidPhoneRegex(9)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-9" href="javascript:updateContact(9)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-9" href="javascript:saveContact(9)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-9" href="javascript:deleteContact(9)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-9" href="javascript:cancelContact(9)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                                <tr id="contact-row-10">
                                    <!--Favorite Button-->
                                    <td>
                                        <a id="contact-not-fave-10" href="javascript:favoriteContact(10, 0)" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-no-fill.png" class="icon" alt="non-favorite"></img></div></a>
                                        <a id="contact-fave-10" href="javascript:favoriteContact(10, 1)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/favorite-fill.png" class="icon" alt="favorite"></img></div></a>
                                    </td>
                                    
                                    <td>
                                        <div id="contact-first-name-10" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-first-name-edit-10" style="display:none" type="text">
                                    </td>
                                        
                                    <td>
                                        <div id="contact-last-name-10" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-last-name-edit-10" style="display:none" type="text">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-email-10" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-email-edit-10" type="text" required onkeyup="confirmValidContactRegex(10)" style="display:none">
                                        </div>
                                    </td>

                                    <td>
                                        <div id="contact-phone-number-10" ></div>
                                        <div class="search-bar row">
                                            <input id="contact-phone-number-edit-10" type="text" required onkeyup="confirmValidPhoneRegex(10)" style="display:none">
                                        </div>
                                    </td>
                                    
                                    <!--Buttons-->
                                    <td >
                                        <a id="contact-edit-10" href="javascript:updateContact(10)" aira-label="button"><div id="editButton" type="button"><img src="images/edit.png" class="icon" alt="edit"></img></div></a>
                                        <a id="contact-save-edit-10" href="javascript:saveContact(10)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/save.png" class="icon" alt="save"></img></div></a>
                                    </td>

                                    <td>
                                        <a id="contact-delete-10" href="javascript:deleteContact(10)" aira-label="button"><div id="deleteButton" type="button"><img src="images/delete.png" class="icon" alt="delete"></img></div></a>
                                        <a id="contact-cancel-edit-10" href="javascript:cancelContact(10)" style="display:none" aira-label="button"><div id="editButton" type="button"><img src="images/cancel.png" class="icon" alt="cancel"></img></div></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    
                        <span id="contact-result" class="text-black row cell"></span>
                    
                        <!--TODO: FINISH PAGINATION-->
                        <div id="page-selector" class="row-alt justify-content-end">
                            <a id="go-prev-button" href="javascript:goPrev()" class="text-black" aria-label="button"><div id="backButton" class="move-page" type="button">Previous</div></a>
                            <a id="go-next-button" href="javascript:goNext()" class="text-black" aria-label="button"><div id="forwardButton" class="move-page" type="button">Next</div></a>
                        </div>
                    </div>

                    <!--Add Contact Section (display none by default)-->
                    <div id="add-contact" style="display:none" class="add-contacts-container">
                        <label for ="add-contact-first-name"  id="add-contact-first-name-label" class="label" style="display:flex">First Name</label>
                        <div class="search-bar row">
                            <input id="add-contact-first-name" type="text" placeholder="First Name">
                        </div>
                        <label for ="add-contact-last-name"  id="add-contact-last-name-label" class="label" style="display:flex">Last Name</label>
                        <div class="search-bar row">
                            <input id="add-contact-last-name" type="text" placeholder="Last Name">
                        </div>
                        <label for ="add-contact-email"  id="add-contact-email-label" class="label" style="display:flex">Email</label>
                        <div class="search-bar row">
                            <input id="add-contact-email" type="text" required onkeyup="confirmValidContactRegex(-1)" placeholder="Email">
                        </div>
                        <label for ="add-contact-phone-number"  id="add-contact-phone-number-label" class="label" style="display:flex">Phone Number</label>
                        <div class="search-bar row">
                            <input id="add-contact-phone-number" type="text" required onkeyup="confirmValidPhoneRegex(-1)"placeholder="Phone Number">
                        </div>

                        <!--Button-->
                        <a id="addContact" href="javascript:addContact()" class="justify-content-center" style="display:flex" aria-label="button"><div class="button" type="button">Add User</div></a>

                        <!--Registration Validation field-->
                        <div id="contact-validation" style="display:none;">
                            <div id="email-validation" class="cell"> 
                                <img id="incorrect-6" src="images/incorrect.png" class="icon" alt="incorrect"></img>
                                <img id="correct-6"src="images/correct.png" class="icon" style="display:none" alt="correct"></img>
                                <div id="special">Email must be correct format.</div>
                            </div>
                            <div id="phone-validation" class="cell"> 
                                <img id="incorrect-7" src="images/incorrect.png" class="icon" alt="incorrect"></img>
                                <img id="correct-7" src="images/correct.png" class="icon" style="display:none" alt="correct"></img>
                                <div id="phone">Phone Number must be correct format.</div>
                            </div>
                            <div id="field-fill-validation" class="cell"> 
                                <img id="incorrect-8" src="images/incorrect.png" class="icon" alt="incorrect"></img>
                                <img id="correct-8"src="images/correct.png" class="icon" style="display:none" alt="correct"></img>
                                <div id="field">All fields must be filled.</div>
                            </div>
                        </div>
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
