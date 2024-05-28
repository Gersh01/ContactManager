const urlBase = 'http://159.203.115.181/LAMPAPI';
const extension = 'php';

//** MUST DELETE ALL CONSOLE.LOG **

let userId = 0;
let firstName = "";
let lastName = "";

let properPassword = false;
let properEmailRegex = true;
let properPhoneRegex = true;

let passwordMatches = false;
let loginFieldsFull = false;
let registerFieldsFull = false;

let contactInEdit = 0;
let firstContactPageFlag = 0;

let inputLogin = document.getElementById("login-password");
let inputRegister = document.getElementById("register-password-confirm");
let globalJsonObject = null;

if(inputLogin != null){
	inputLogin.addEventListener("keypress", function(event){
		if(event.key === "Enter"){
			document.getElementById("doLogin").click();
		}
	});
}

if(inputRegister != null){
	inputRegister.addEventListener("keypress", function(event){
		if(event.key === "Enter"){
			document.getElementById("doRegister").click();
		}
	});
}

function doRedirect(){
	window.location.href = "login.php";
}
	

function doLogin(){

    userId = 0;
	firstName = "";
	lastName = "";
	
	let login = document.getElementById("login-username").value;
	let password = document.getElementById("login-password").value;

	/* Do we want to add hashing to the passwords?*/ 
//	var hash = md5( password );
	
	document.getElementById("login-result").innerHTML = "";

	if(login === "" || password === ""){
		document.getElementById("login-result").innerHTML = "Required fields must be filled";
		return;
	}
	else{
			let tmp = {login:login,password:password};
			//	var tmp = {login:login,password:hash};
			let jsonPayload = JSON.stringify( tmp );
			
			let url = urlBase + '/Login.' + extension;
		
			let xhr = new XMLHttpRequest();
		
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
			console.log(jsonPayload);
			try
			{
				xhr.onreadystatechange = function() 
				{
					if (this.readyState == 4 && this.status == 200) 
					{
						let jsonObject = JSON.parse( xhr.responseText );
						userId = jsonObject.id;
				
						if( userId < 1 )
						{		//loginResult is temp name may need to change element .css name
							document.getElementById("login-result").innerHTML = "* Username or Password is incorrect *";
							return;
						}
				
						firstName = jsonObject.firstName;
						lastName = jsonObject.lastName;
		
						saveCookie();
						//refers to page after login
						window.location.href = "contacts.php";
					}
				};
				xhr.send(jsonPayload);
			}
			catch(err)
			{
				document.getElementById("login-result").innerHTML = err.message;
			}
	}
}

function saveCookie(){

	let minutes = 20;
	let date = new Date();
	date.setTime(date.getTime()+(minutes*60*1000));	
	document.cookie = "firstName=" + firstName + ",lastName=" + lastName + ",userId=" + userId + ";expires=" + date.toGMTString();
}

function readCookie(){

    userId = -1;
	let data = document.cookie;
	let splits = data.split(",");
	for(var i = 0; i < splits.length; i++) 
	{
		let thisOne = splits[i].trim();
		let tokens = thisOne.split("=");
		if( tokens[0] == "firstName" )
		{
			firstName = tokens[1];
		}
		else if( tokens[0] == "lastName" )
		{
			lastName = tokens[1];
		}
		else if( tokens[0] == "userId" )
		{
			userId = parseInt( tokens[1].trim() );
		}
	}
	
	if( userId < 0 )
	{
		window.location.href = "login.php";
	}
	else
	{
//		document.getElementById("userName").innerHTML = "Logged in as " + firstName + " " + lastName;
	}
}

function doLogout(){

    userId = 0;
	firstName = "";
	lastName = "";
	document.cookie = "firstName= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    //sends user to page after logout, needs to be updated
	window.location.href = "login.php";
}

function showTable(){
	if(contactInEdit === 0){
		let table = document.getElementById("contacts-hideable");
		let contact = document.getElementById("add-contact");
		let refresh = document.getElementById("refresh-button");
		let addContactButton = document.getElementById("addContactButton");
		let favoriteIconFav = document.getElementById("search-favorites-on");
		let favoriteIconUnFav = document.getElementById("search-favorites-off");

		console.log("Hiding table");
		if(table.style.display === "block"){
			table.style.display = "none";
			refresh.style.display = "none"
			favoriteIconFav.style.display = "none";
			favoriteIconUnFav.style.display = "none";

			addContactButton.innerText = "Cancel"
			contact.style.display = "block";
		}
		else{
			contact.style.display="none";
			addContactButton.innerText = "Add Contact";

			favoriteIconUnFav.style.display = "block";

			firstPage(null,null);

			refresh.style.display = "block";
			table.style.display = "block";
		}
	}
}

function toggleElement(row,num){
	//block = show | none = hide
	if(num === 0){
		console.log("Changing row contact on "+row.style.display);
		row.style.display = "display:block";
	}
	else if(num === 1){
		row.style.display = "display:none";
	}
}

function toggleEditElement(toggle,num){

	let firstName = document.getElementById("contact-first-name-"+num);
	let lastName = document.getElementById("contact-last-name-"+num);
	let email = document.getElementById("contact-email-"+num);
	let phone = document.getElementById("contact-phone-number-"+num);
	let edit = document.getElementById("contact-edit-"+num);
	let del = document.getElementById("contact-delete-"+num);

	let editFirst = document.getElementById("contact-first-name-edit-"+num);
	let editLast = document.getElementById("contact-last-name-edit-"+num);
	let editEmail = document.getElementById("contact-email-edit-"+num);
	let editPhone = document.getElementById("contact-phone-number-edit-"+num);
	let save = document.getElementById("contact-save-edit-"+num);
	let cancel = document.getElementById("contact-cancel-edit-"+num);

	//show edit field
	if(toggle === 1){
		firstName.style.display = "none";
		lastName.style.display = "none";
		email.style.display = "none";
		phone.style.display = "none";
		edit.style.display = "none";
		del.style.display = "none";


		contactInEdit +=1;

	
		editFirst.style.display = "block";
		editLast.style.display = "block";
		editEmail.style.display = "block";
		editPhone.style.display = "block";
		save.style.display = "block";
		cancel.style.display = "block";
	}
	//hide edit field
	else{
		editFirst.style.display = "none";
		editLast.style.display = "none";
		editEmail.style.display = "none";
		editPhone.style.display = "none";
		save.style.display = "none";
		cancel.style.display = "none";

		contactInEdit -=1;

		firstName.style.display = "block";
		lastName.style.display = "block";
		email.style.display = "block";
		phone.style.display = "block";
		edit.style.display = "block";
		del.style.display = "block";
	}

}

//Names are subject to change depending on HTML and css
function doRegister(){

	document.getElementById("register-result").innerHTML = "";

	let newUserFirst = document.getElementById("register-first-name").value;
	let newUserLast = document.getElementById("register-last-name").value;
	let newUserName = document.getElementById("register-username").value;
	let newUserPassword = document.getElementById("register-password").value;
	let newUserPasswordConfirm = document.getElementById("register-password-confirm").value;

	if(newUserFirst === "" || newUserLast === "" || newUserName === "" || newUserPassword === "" || newUserPasswordConfirm === ""){
		document.getElementById("register-result").innerHTML = "Required fields must be filled";
		return;
	}
	else{
	
		/* This element items implementation is dependant on time*/
		//let newUserSecurityQ = document.getElementById("userSecurity").value;
		
		if(passwordMatches == false){
			//need to change color to red, this doesn't work right now
			document.getElementById("register-result").style.color = "red";
			document.getElementById("register-result").innerHTML = "* Passwords do not match";
			return;
		}
		else if(passwordMatches == true && properPassword == true){
			let tmp = {firstName:newUserFirst,lastName:newUserLast,login:newUserName,password:newUserPassword};

			console.log(tmp);
			let jsonPayload = JSON.stringify( tmp );
			
			// 'register' is a place holder
			let url = urlBase + '/Register.' + extension;
		
			let xhr = new XMLHttpRequest();
		
			xhr.open("POST", url, true);
		
			xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
			console.log(jsonPayload);
			try{
				xhr.onreadystatechange = function()
				{
					if(this.readyState == 4 && this.status == 200){
						jsonResponse = JSON.parse( xhr.responseText );
						if(jsonResponse.verdict === "login was taken"){
							document.getElementById("register-result").innerHTML = "Username is already taken";
							document.getElementById("register-username").value = "";
							document.getElementById("register-password").value= "";
							document.getElementById("register-password-confirm").value = "";
						}
						else{
							document.getElementById("register-first-name").value = "";
							document.getElementById("register-last-name").value = "";
							document.getElementById("register-username").value = "";
							document.getElementById("register-password").value= "";
							document.getElementById("register-password-confirm").value = "";

							document.getElementById("register-result").innerHTML = "Registration is complete";
						}
						
					}
				};
				xhr.send(jsonPayload);
			}
			catch(err){
				document.getElementById("register-result").innerHTML = err.message;
			}
		}	
	}	
}

//Names are subject to change based on HTML and css files
function addContact(){
	let num = -1;
    //temp elementById names, need to confirm with style.css
    let newContactFirst = document.getElementById("add-contact-first-name").value;
    let newContactLast = document.getElementById("add-contact-last-name").value;
    let newContactEmail = document.getElementById("add-contact-email").value;
    let newContactPhone = document.getElementById("add-contact-phone-number").value;

	console.log(newContactPhone);
	if(emptyContactFields(num) === 0){
		if(properEmailRegex === true && properPhoneRegex === true){

			let newContactName = newContactFirst +" "+newContactLast;

			document.getElementById("add-contact-result").innerHTML = "";

			let tmp = {name:newContactName, phone:newContactPhone, email:newContactEmail, userID:userId, favorite:0};

			let jsonPayload = JSON.stringify( tmp );

			let url = urlBase + "/AddContact." + extension;

			let xhr = new XMLHttpRequest();

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
			
			try{
				xhr.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						document.getElementById("add-contact-result").innerHTML = "Contact has been added";

						document.getElementById("add-contact-first-name").value = "";
						document.getElementById("add-contact-last-name").value = "";
						document.getElementById("add-contact-email").value = "";
						document.getElementById("add-contact-phone-number").value = "";
					}
				};
				xhr.send( jsonPayload );
			}
			catch (err){
				document.getElementById("add-contact-result").innerHTML = err.message;
			}
		}
		else{
			document.getElementById("add-contact-result").innerHTML = "Required fields are invalid";
		}
	}
	else{
		document.getElementById("add-contact-result").innerHTML = "Required fields are missing";
	}
}

function confirmValidContactRegex(num){
	let email = "";

	let emailRegex = new RegExp(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/);

	if(num===-1){
		email = document.getElementById("add-contact-email").value;
	}
	else{
		email = document.getElementById("contact-email-edit-"+num).value;
	}

	if(emailRegex.test(email) === false){
		console.log("Email is invalid");
		properEmailRegex = false;
	}else{
		console.log("Email is valid");
		properEmailRegex = true;
	}

}

function confirmPassword(){
	let password = document.getElementById("register-password").value;
	let confirmPassword = document.getElementById("register-password-confirm").value;

	document.getElementById("register-result").innerHTML = "";

	if(password!==confirmPassword){
		passwordMatches = false;
		document.getElementById("register-result").innerHTML = "Password does not match";
	}
	else{
		passwordMatches = true;
		document.getElementById("register-result").innerHTML = "";
	}

}

function confirmValidPhoneRegex(num){

	let phoneRegex = new RegExp("[0-9]{3}-[0-9]{3}-[0-9]{4}");
	let phone = "";

	if(num === -1){
		phone = document.getElementById("add-contact-phone-number");
	}
	else{
		phone = document.getElementById("contact-phone-number-edit-"+num);
	}
	console.log(num + "inside phoneRegex");
	if(phone.value!== ""){
		phone.addEventListener("keypress", function(event){
			if(event.key!=="Backspace"){
				if(phone.value.length === 3 || phone.value.length === 7){
					console.log("adding -")
					phone.value += "-";
				}
			}
		});
	}
	console.log(phoneRegex.test(phone.value));
	if(phoneRegex.test(phone.value)===true && phone.value.length===12){
		properPhoneRegex = true;
	}
	else{
		properPhoneRegex = false;
	}
	}

function passwordRegexChecker(){

	let password = document.getElementById("register-password").value;

	let upperPasswordRegex = new RegExp("(?=.*[A-Z])");
	let specialPasswordRegex = new RegExp("(?=.*[@$!%*?&])");
	let numberPasswordRegex = new RegExp("(?=.*[0-9])");
	let wholePasswordRegex = new RegExp("(?=.*[A-Z])(?=.*[@$!%*?&])(?=.*[0-9])");

	
	//These elements needed to be added to website page
	/*
	document.getElementById("password-length").innerHTML = "";
	document.getElementById("password-lowercase").innerHTML = "";
	document.getElementById("password-uppercase").innerHTML = "";
	document.getElementById("password-number").innerHTML = "";
	*/


	if(password.length>=8){
		console.log("length = true");
	}
	else{
		properPassword = false;
		console.log("length = false");
		//document.getElementById("password-length").innerHTML = "Password must be at least 8 characters";
	}

	if(upperPasswordRegex.test(password)){
		console.log("upper = true");
		}
	else{
		properPassword = false;
		console.log("upper = false");
		//document.getElementById("password-uppercase").innerHTML = "Password must contain at least 1 uppercase character";
	}

	if(specialPasswordRegex.test(password)){
		console.log("special = true");
	}
	else{
		properPassword = false;
		console.log("special = false");
		//document.getElementById("password-special").innerHTML = "Password must contain at least 1 specail character";
	}

	if(numberPasswordRegex.test(password)){
		console.log("number = true");
	}
	else{
		properPassword = false;
		console.log("number = false");
		//document.getElementById("password-number").innerHTML = "Password must containt at least 1 number";
	}

	if(wholePasswordRegex.test(password)){
		properPassword = true;
		console.log("password = true");
	}
	else{
		console.log("password = false");
		console.log(password);
	}
}

function firstPage(contactPageination,pageSelect){
	console.log(pageSelect);
	console.log(contactPageination);
	if(contactInEdit === 0){
		tmp = null;
		//Goes to next page
		if(pageSelect===1 && document.getElementById("search-bar").value==""){
			tmp = {userID:userId, cursor:contactPageination, next:pageSelect};
		}
		else if(pageSelect===-1 && document.getElementById("search-bar").value==""){
			tmp = {userID:userId, cursor:contactPageination, next:pageSelect};
		}
		else if(pageSelect===null){
			firstContactPageFlag = 0;
			tmp = {userID:userId, cursor:0};
		}
		console.log("Generating first page");

		let url = urlBase + "/ContactPagination." + extension;
		
		

		document.getElementById("contact-result").innerHTML = "";

		let jsonPayload = JSON.stringify( tmp );

		let xhr = new XMLHttpRequest();

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
		console.log(tmp);
		try{
			xhr.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200){
					//document.getElementById("contact-result").innerHTML = "Contacts have been recieved";

					document.getElementById("search-bar").value = "";

					let jsonObject = JSON.parse( xhr.responseText );
					globalJsonObject = jsonObject;
					loadContacts(jsonObject);
					console.log("GlobalPageCounter "+firstContactPageFlag);
				}
			};
			xhr.send(jsonPayload);
			
		}
		catch(err){
			document.getElementById("contact-result").innerHTML = err.message;
			console.log(err.message);
		}
	}
}

function loadContacts(jsonObject){

	let i = 0;
	let hide = 1;
	let show = 0;
	console.log(jsonObject);

	if(jsonObject.contacts.length == 0){
		document.getElementById("contact-result").innerHTML = "No contacts found";
		return;
	}
	console.log("The length of the jsonObject "+jsonObject.contacts.length);

	for(i = 0; i<jsonObject.contacts.length; i++){
		console.log(jsonObject.contacts[i].FirstName);
		console.log("contact-first-name-"+parseInt(i+1));

		let row = document.getElementById("contact-row-"+parseInt(i+1));

		if(jsonObject.contacts[i].Favorite==="1" || jsonObject.contacts[i].Favorite===1){
			console.log("Contact is a fav "+jsonObject.contacts[i].FirstName)
			document.getElementById("contact-not-fave-"+parseInt(i+1)).style.display = "none";			
			document.getElementById("contact-fave-"+parseInt(i+1)).style.display = "block";
		}
		else if(jsonObject.contacts[i].Favorite===0 || jsonObject.contacts[i].Favorite=== "0"){
			document.getElementById("contact-fave-"+parseInt(i+1)).style.display = "none";
			document.getElementById("contact-not-fave-"+parseInt(i+1)).style.display = "block";
		}
		
		toggleElement(row,show);

		document.getElementById("contact-first-name-"+parseInt(i+1)).textContent = jsonObject.contacts[i].FirstName;
		document.getElementById("contact-last-name-"+parseInt(i+1)).textContent = jsonObject.contacts[i].LastName;
		document.getElementById("contact-email-"+parseInt(i+1)).textContent = jsonObject.contacts[i].Email;
		document.getElementById("contact-phone-number-"+parseInt(i+1)).textContent= jsonObject.contacts[i].Phone;
	}
	for(j = i; j<10; j++){
		console.log("changing contact row to hide "+j);
		let row = document.getElementById("contact-row-"+parseInt(j+1));
		toggleElement(row,hide);
	}
}

function noContactsFound(){
	let hide = 1;
	for(let i = 0; i<10; i++){
		let row = document.getElementById("contact-row-"+parseInt(i+1));
		toggleElement(row,hide);
	}
}

function emptyContactFields(num){
	let missingField = 1;
	let noMissingFields =0;


	let firstName = document.getElementById("add-contact-first-name");
	let lastName = document.getElementById("add-contact-last-name");
	let email = document.getElementById("add-contact-email");
	let phone = document.getElementById("add-contact-phone-number");

	let editFirst = document.getElementById("contact-first-name-edit-"+num);
	let editLast = document.getElementById("contact-last-name-edit-"+num);
	let editEmail = document.getElementById("contact-email-edit-"+num);
	let editPhone = document.getElementById("contact-phone-number-edit-"+num);

	//If a new contact is being created
	if(num === -1){
		if(firstName.value === "" || lastName.value === "" || email.value === "" || phone.value === ""){
			return missingField;
		}
		else{
			return noMissingFields;
		}
	}
	else{
		if(editFirst.value === "" || editLast.value === "" || editEmail.value === "" || editPhone.value === ""){
			return missingField;
		}
		else{
			return noMissingFields;
		}
	}
}

function searchContact(first, last, contactId, favorite, pagination){
	let tmp = null;
	let searchField = document.getElementById("search-bar").value;

	let favoriteSearch = null;
	if(document.getElementById("search-favorites-on").style.display=== "block"){
		favoriteSearch = 1;
		console.log("performing favorited searches");
	}
	else{
		favoriteSearch = 0;
	}

	if(contactInEdit === 0){
		//Search asking to see next page of contacts
		if(pagination === 1){
			tmp = {UserID:userId, showFavorites:favoriteSearch, search:searchField, cursor:{firstName:first, lastName:last, ID:contactId, favorite:favorite},next:pagination};
		}
		else if(pagination === 0){
			tmp = {UserID:userId, showFavorites:favoriteSearch, search:searchField, cursor:{firstName:first, lastName:last, ID:contactId, favorite:favorite},next:pagination};
		}
		else if(pagination === null){
			tmp = {UserID:userId, showFavorites:favoriteSearch, search:searchField, cursor:{firstName:"",lastName:"",ID:1,favorite:0}};
			firstContactPageFlag = 0;
		}
		console.log(searchField);
		if(searchField === "" && favoriteSearch === 0){
			console.log("no search field.");
			firstPage(null,null);
		}
		else{
			console.log("Accessing contacts for search");

			let url = urlBase + "/Search." + extension;

			//ADD cursor{firstname/lastname/contactID}, next(tru||false)
		
			document.getElementById("contact-result").innerHTML = "";
			
		
			let jsonPayload = JSON.stringify( tmp );
		
			console.log(tmp);
		
			let xhr = new XMLHttpRequest();
		
			xhr.open("POST", url, true);
		
			xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
			
			try{
				xhr.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200){
						//document.getElementById("contact-result").innerHTML ="Contacts have been recieved";
						if(xhr.responseText!="No Records Found"){
							let jsonObject = JSON.parse( xhr.responseText );
							globalJsonObject = jsonObject;
							loadContacts(jsonObject);
							console.log("GlobalPageCounter "+firstContactPageFlag);
						}
						else{
							globalJsonObject = null;
							noContactsFound();
						}
					}
				};
				xhr.send(jsonPayload);
				
			}
			catch(err){
				document.getElementById("contact-result").innerHTML = err.message;
				console.log(err.message);
			}
		}
	}
}

function deleteContact(num){
	if(contactInEdit === 0){
		console.log(num);

		let url = urlBase + "/DeleteContact." + extension;

		//globalJsonObject.splice(num-1,1);
		console.log(globalJsonObject);

		let deletedContactID = globalJsonObject.contacts[num-1].ID;
		let convertToString = "" + deletedContactID;

		let tmp = {contactID:deletedContactID};
		
		let jsonPayload = JSON.stringify(tmp);

		console.log(convertToString);

		let xhr = new XMLHttpRequest();

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
		console.log(jsonPayload);
		try{
			xhr.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200){
					let jsonObject = JSON.parse(xhr.responseText);
					console.log(jsonObject.deleted);
					console.log(jsonObject.error);
					if(jsonObject.deleted === "Yes"){
						document.getElementById("contact-result").innerHTML = "Contact has been deleted";
						if(document.getElementById("search-bar").value == ""){
							firstPage(null,null);
						}
						else{
							searchContact(null,null,null,null,null);
						}
					}
					else{
						document.getElementById("contact-result").innerHTML = "Contact was not deleted";
					}
				}
			};
			xhr.send(jsonPayload);
		}
		catch(err){
			document.getElementById("contact-result").innerHTML = err.message;
			console.log(err.message);
		}
	}
}

function updateContact(num){	
	let edit = 1;

	let editFirst = document.getElementById("contact-first-name-edit-"+num);
	let editLast = document.getElementById("contact-last-name-edit-"+num);
	let editEmail = document.getElementById("contact-email-edit-"+num);
	let editPhone = document.getElementById("contact-phone-number-edit-"+num);

	let firstName = document.getElementById("contact-first-name-"+num);
	let lastName = document.getElementById("contact-last-name-"+num);
	let email = document.getElementById("contact-email-"+num);
	let phone = document.getElementById("contact-phone-number-"+num);

	editFirst.value = firstName.textContent;
	editLast.value = lastName.textContent;
	editEmail.value = email.textContent;
	editPhone.value = phone.textContent;

	toggleEditElement(edit,num);
}

function saveContact(num){
	let done = 0;
	let emptyCheck = 0;
	let cell = num;

	let editFirst = document.getElementById("contact-first-name-edit-"+num);
	let editLast = document.getElementById("contact-last-name-edit-"+num);
	let editEmail = document.getElementById("contact-email-edit-"+num);
	let editPhone = document.getElementById("contact-phone-number-edit-"+num);

	let firstName = document.getElementById("contact-first-name-"+num);
	let lastName = document.getElementById("contact-last-name-"+num);
	let email = document.getElementById("contact-email-"+num);
	let phone = document.getElementById("contact-phone-number-"+num);



	emptyCheck = emptyContactFields(cell);



	if(emptyCheck === 0){
		if(properEmailRegex === true && properPhoneRegex === true){
			let Id = globalJsonObject.contacts[num-1].ID;

			firstName.textContent = editFirst.value;
			lastName.textContent = editLast.value;
			email.textContent = editEmail.value;
			phone.textContent = editPhone.value;
		
			let fullName = firstName.textContent+ " " + lastName.textContent;

			let url = urlBase + "/UpdateContact." + extension;
			
			let tmp = {newName:fullName, newPhone:phone.textContent, newEmail:email.textContent, contactID:Id, newFavorite:0};

			//document.getElementById("contact-edit-result").innerHTML = "";

			let jsonPayload = JSON.stringify( tmp );

			let xhr = new XMLHttpRequest();

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
			try{
				xhr.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						//document.getElementById("contact-edit-result").innerHTML = "Contact has been updated";
						toggleEditElement(done,num);
						
						if(document.getElementById("search-bar").value == ""){
							firstPage(null,null);
						}
						else{
							searchContact(null,null,null,null,null);
						}
					}
					else{
						//document.getElementById("contact-edit-result").innerHTML = "Contact cannot be updated";
					}
				};
				xhr.send(jsonPayload);
			}
			catch(err){
				document.getElementById("contact-result").innerHTML = err.message;
				console.log(err.message);
			}
		}
	}
	else{
		document.getElementById("contact-result").innerHTML = "Required fields missing";
	}
}

function cancelContact(num){
	let done = 0;

	let editFirst = document.getElementById("contact-first-name-edit-"+num);
	let editLast = document.getElementById("contact-last-name-edit-"+num);
	let editEmail = document.getElementById("contact-email-edit-"+num);
	let editPhone = document.getElementById("contact-phone-number-edit-"+num);

	let firstName = document.getElementById("contact-first-name-"+num);
	let lastName = document.getElementById("contact-last-name-"+num);
	let email = document.getElementById("contact-email-"+num);
	let phone = document.getElementById("contact-phone-number-"+num);

	editFirst.value = firstName.textContent;
	editLast.value = lastName.textContent;
	editEmail.value = email.textContent;
	editPhone.value = phone.textContent;

	toggleEditElement(done,num);
}


function goNext(){
	let next = 1;
	let lastIndex = 9;

	let lastContactFirstName = document.getElementById("contact-first-name-10").innerText;
	let lastContactLastName = document.getElementById("contact-last-name-10").innerText;

	let nextName = lastContactFirstName+" "+lastContactLastName;
	if(globalJsonObject.contacts.length==10){
		let Id = globalJsonObject.contacts[lastIndex].ID;
		let fav = globalJsonObject.contacts[lastIndex].Favorite;
		if(contactInEdit === 0){
			firstContactPageFlag += 1;
			//if search field is empty
			if(document.getElementById("search-bar").value === ""){
				firstPage(nextName,next);
			}
			//if search field is in use
			else{
				searchContact(lastContactFirstName, lastContactLastName, Id, fav, next);
			}
		}
	}
	

}

function goPrev(){	
	let prev = -1;
	let prevSearch = 0;
	let firstIndex = 0;

	console.log("go prev");
	let firstContactFirstName = document.getElementById("contact-first-name-1").innerText;
	let firstContactLastName = document.getElementById("contact-last-name-1").innerText;

	let prevName = firstContactFirstName+" "+firstContactLastName;
	if(firstContactPageFlag > 0){
		let Id = globalJsonObject.contacts[firstIndex].ID;
		let fav = globalJsonObject.contacts[firstIndex].Favorite;
		if(contactInEdit === 0 ){
			firstContactPageFlag -= 1;
			//if search field is empty
			if(document.getElementById("search-bar").value === ""){
				firstPage(prevName,prev);
			}
			//if search field is in use
			else{
				searchContact(firstContactFirstName, firstContactLastName, Id, fav, prevSearch);
			}
		}
	}
}


function favoriteContact(row, favStatus){
	if(contactInEdit === 0){
		let newFavValue = null;

		let favContact = document.getElementById("contact-fave-"+row);

		let unFavContact = document.getElementById("contact-not-fave-"+row);

		let contactId = globalJsonObject.contacts[row-1].ID;

		if(favContact.style.display === "none"){
			unFavContact.style.display = "none";
			favContact.style.display = "block";
			newFavValue = 1;
		}
		else{
			favContact.style.display = "none";
			unFavContact.style.display = "block"
			newFavValue = 0;
		}

		let url = urlBase + "/ChangeFavorite." + extension;
		
		let tmp = {ID:contactId, updatedFavorite:newFavValue};

		let jsonPayload = JSON.stringify(tmp);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", url, true);
		try{
			xhr.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200){
					searchContact(null,null,null,null,null);
				}
			};
			xhr.send(jsonPayload);
		}
		catch(err){
			console.log(err.message);
		}
	}	
}

function favoriteSearch(){
	let favoritedSearch = document.getElementById("search-favorites-on");
	let nonFavoritedSearch = document.getElementById("search-favorites-off");
	if(contactInEdit === 0){
		if(favoritedSearch.style.display === "none"){
			console.log("Performing favorite search");
			nonFavoritedSearch.style.display = "none";
			favoritedSearch.style.display = "block";
		}
		else{
			console.log("Performing un-favorited search");
			favoritedSearch.style.display = "none";
			nonFavoritedSearch.style.display = "block";
		}
		searchContact(null,null,null,null,null);
	}
}