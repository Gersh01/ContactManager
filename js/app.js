const urlBase = 'http://oceanic-connections.xyz/LAMPAPI';
const extension = 'php';

let userId = 0;
let firstName = "";
let lastName = "";

function doLogin(){

    userId = 0;
	firstName = "";
	lastName = "";
	
	let login = document.getElementById("loginName").value;
	let password = document.getElementById("loginPassword").value;
    /* Do we want to add hashing to the passwords?*/ 
//	var hash = md5( password );
	
	document.getElementById("loginResult").innerHTML = "";

	let tmp = {login:login,password:password};
//	var tmp = {login:login,password:hash};
	let jsonPayload = JSON.stringify( tmp );
	
	let url = urlBase + '/Login.' + extension;

	let xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
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
					document.getElementById("loginResult").innerHTML = "User/Password combination incorrect";
					return;
				}
		
				firstName = jsonObject.firstName;
				lastName = jsonObject.lastName;

				saveCookie();
                //refers to page after login, needs to be updated
				window.location.href = "login.html";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("loginResult").innerHTML = err.message;
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
		window.location.href = "index.html";
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
	window.location.href = "home.html";
}

function doRegister(){

    let newUserFirst = document.getElementById("userFirst").value;
    let newUserLast = document.getElementById("userLast").value;
    let newUserName = document.getElementById("userName").value;
    let newUserPassword = document.getElementById("userPassword").value;
    /* This will be used to confirm passwords are the same */
    //let newUserPasswordConf = document.getElementById("userPasswordConf").value;

    /* This element items implementation is dependant on time*/
    //let newUserSecurityQ = document.getElementById("userSecurity").value;

    document.getElementById("registerResult").innerHTML = "";
    
    let tmp = {firstName:newUserFirst, lastName:newUserLast, login:newUserName, password:newUserPassword};

    let jsonPayload = JSON.stringify( tmp );

    // 'register' is a place holder
    let url = urlBase + '/register.' + extension;

    let xhr = new XMLHttpRequest();

    xhr.open("POST", url, true);

    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    try{
        xhr.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("registerResult").innerHTML = "Registration is complete";
            }
        };
        xhr.send(jsonPayload);
    }
    catch(err){
        document.getElementById("registerResult").innerHTML = err.message;
    }
}

function addContact(){



}

function deleteContact(){



}


function searchContact(){



}

function updateContact(){



}


function doPagenation(){



}