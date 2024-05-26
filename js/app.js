const urlBase = 'http://159.203.115.181/LAMPAPI';
const extension = 'php';

//** MUST DELETE ALL CONSOLE.LOG **

let userId = 0;
let firstName = "";
let lastName = "";
let properPassword = false;
let properContactEmailRegix = false;
let properContactPhoneRegix = false;
let passwordMatches = false;
let loginFieldsFull = false;
let registerFieldsFull = false;

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
	let table = document.getElementById("contacts-hideable");
	if(table.style.display === "block"){
		table.style.display = "none";
	}
	else{
		table.style.display = "block";
	}
}

function toggleElement(row,num){
	//block = show | none = hide
	if(num===0){
		row.style.display="flex";
	}
	else if(num === 1){
		row.style.display="none";
	}
}

function toggleEditElement(){


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
						document.getElementById("register-first-name").value = "";
						document.getElementById("register-last-name").value = "";
						document.getElementById("register-username").value = "";
						document.getElementById("register-password").value= "";
						document.getElementById("register-password-confirm").value = "";

						document.getElementById("register-result").innerHTML = "Registration is complete";
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
    //temp elementById names, need to confirm with style.css
    let newContactFirst = document.getElementById("add-content-first-name").innerHTML.value;
    let newContactLast = document.getElementById("add-content-last-name").innerHTML.value;
    let newContactEmail = document.getElementById("add-contact-email").innerHTML.value;
    let newContactPhone = document.getElementById("add-contact-phone-number").innerHTML.value;


	if(newContactFirst !== "" && newContactLast !== "" && newContactFirst !== "" && newContactPhone !== ""){
		if(properContactRegix === true){

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
					if(this.readyState == 4 && this.statust == 200){
						document.getElementById("add-contact-result").innerHTML = "Contact has been added";
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

function confirmValidContactRegex(){
	let newContactEmail = document.getElementById("add-contact-email").innerHTML.value;
    let newContactPhone = document.getElementById("add-contact-phone-number").innerHTML.value;

	let emailRegex = new RegExp("^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$");
	let phoneRegex = new RegExp("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$");
	
	if(emailRegex.test(newContactEmail) === false){
		//document.getElementById("contact-email").innerHTML = "Email is invalid";
		properContactEmailRegix = false;
	}else{
		properContactEmailRegix = true;
	}

	if(phoneRegex.test(newContactPhone) === false){
		//document.getElementById("contact-phone").innerHTML = "Phone number is invalid";
		properContactPhoneRegix = false;
	}else{
		properContactPhoneRegix = true;
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

function firstPage(){

	console.log("Generating first page");

	let url = urlBase + "/ContactPagination." + extension;
	
	let tmp = {userID:userId, cursor:0};

	document.getElementById("contact-result").innerHTML = "";

	let jsonPayload = JSON.stringify( tmp );

	let xhr = new XMLHttpRequest();

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	
	try{
		xhr.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200){
				//document.getElementById("contact-result").innerHTML = "Contacts have been recieved";
				let jsonObject = JSON.parse( xhr.responseText );
				globalJsonObject = jsonObject;
				loadContacts(jsonObject);
			}
		};
		xhr.send(jsonPayload);
		
	}
	catch(err){
		document.getElementById("contact-result").innerHTML = err.message;
		console.log(err.message);
	}
}

function loadContacts(jsonObject){
	let i = 0;
	let hide = 1;
	let show = 0;
	if(jsonObject.contacts.length == 0){
		document.getElementById("contact-result").innerHTML = "No contacts found";
		return;
	}
	for(i = 0; i<jsonObject.contacts.length; i++){
		console.log(jsonObject.contacts[i].FirstName);
		console.log("contact-first-name-"+parseInt(i+1));

		let row = document.getElementById("contact-row-"+parseInt(i+1));
		toggleElement(row,show);
		document.getElementById("contact-first-name-"+parseInt(i+1)).textContent = jsonObject.contacts[i].FirstName;
		document.getElementById("contact-last-name-"+parseInt(i+1)).textContent = jsonObject.contacts[i].LastName;
		document.getElementById("contact-email-"+parseInt(i+1)).textContent = jsonObject.contacts[i].Email;
		document.getElementById("contact-phone-number-"+parseInt(i+1)).textContent = jsonObject.contacts[i].Phone;

	}
	for(j = i; j<10; j++){
		let row = document.getElementById("contact-row-"+parseInt(j+1));
		toggleElement(row,hide);
	}
}




function searchContact(){

	console.log("Accessing contacts for search");

	let url = urlBase + "/Search." + extension;

	let searchField = document.getElementById("search-bar").value;
	//ADD cursor{firstname/lastname/contactID}, next(tru||false)
	let tmp = {UserID:userId, showFavorites:0, search:searchField, cursor:{firstName:"",lastName:"",ID:1,favorite:0}};

	document.getElementById("contact-result").innerHTML = "";
	

	let jsonPayload = JSON.stringify( tmp );

	console.log(tmp);

	let xhr = new XMLHttpRequest();

	xhr.open("POST", url, true);

	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	
	try{
		xhr.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200){
				let jsonObject = JSON.parse( xhr.responseText );
				//document.getElementById("contact-result").innerHTML ="Contacts have been recieved";
				loadContacts(jsonObject);
			}
		};
		xhr.send(jsonPayload);
		
	}
	catch(err){
		document.getElementById("contact-result").innerHTML = err.message;
		console.log(err.message);
	}
}

function deleteContact(num){
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
						firstPage();
					}
					else{
						searchContact();
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

function updateContact(num){



}

function saveContact(num){


}

function cancelContact(num){


}


function doPagenation(){



}

