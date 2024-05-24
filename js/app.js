const urlBase = 'http://159.203.115.181/LAMPAPI';
const extension = 'php';

//** MUST DELETE ALL CONSOLE.LOG **

let userId = 0;
let firstName = "";
let lastName = "";
let passwordMatches = false;
let loginFieldsFull = false;
let registerFieldsFull = false;

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
						//refers to page after login, needs to be updated
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

//Names are subject to change depending on HTML and css
function doRegister(){

	document.getElementById("register-result").innerHTML = "";

	if(passwordMatches == false){
		//need to change color to red, this doesn't work right now
		document.getElementById("register-result").style.color = "red";
		document.getElementById("register-result").innerHTML = "* Passwords do not match";
		return;
	}
	else{
		let newUserFirst = document.getElementById("register-first-name").value;
		let newUserLast = document.getElementById("register-last-name").value;
		let newUserName = document.getElementById("register-username").value;
		let newUserPassword = document.getElementById("register-password").value;
		let newUserPasswordConfirm = document.getElementById("register-password-confirm").value;

	
		/* This element items implementation is dependant on time*/
		//let newUserSecurityQ = document.getElementById("userSecurity").value;
		
		if(newUserFirst === "" || newUserLast === "" || newUserName === "" || newUserPassword === "" || newUserPasswordConfirm === ""){
			document.getElementById("register-result").innerHTML = "Required fields must be filled";
			return;
		}
		else{
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
    let newContactFirst = document.getElementById("contactFirst").innerHTML;
    let newContactLast = document.getElementById("contactLast").innerHTML;
    let newContactEmail = document.getElementById("contactEmail").innerHTML;
    let newContactPhone = document.getElementById("contactPhone").innerHTML;

    document.getElementById("addContactResult").innerHTML = "";

    let tmp = {contactFirst:newContactFirst, contactLast:newContactLast, contactEmail:newContactEmail, contactPhone:newContactPhone};

    let jsonPayload = JSON.stringify( tmp );
    //temporary name depends on sites URL
    let url = urlBase + "/contacts.php" + extension;

    let xhr = new XMLHttpRequest();

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    
    try{
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.statust == 200){
                document.getElementById("addContatctResult").innerHTML = "Contact has been added";
            }
        };
        xhr.send( jsonPayload );

    }
    catch (err){
        document.getElementById("addContactResult").innerHTML = err.message;
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

function deleteContact(){



}


function searchContact(){



}

function updateContact(){



}


function doPagenation(){



}
