const root = "../../";
const ajax = root+"/ajax/"
const inputEmail = document.querySelector('input[name="email"]');
const inputPass = document.querySelector('input[name="password"]');
const inputConfPass = document.querySelector('input[name="password2"]');

function isMail( mail ){
	const mailFormate = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if( mail.match(mailFormate) ){
		return true;
	}
	return false;
}

// Add error class to the feild
function createErrorElement( text ){
	const element = document.createElement('div');
	element.classList.add('invalid-feedback');
	element.textContent = text;

	removeErrorElement();

	return element;
}
// Remove error message from form
function removeErrorElement(){
	setTimeout(() => {
		document.querySelector('.invalid-feedback').remove();
	}, 5000);
}

/**
 * 
 * Event Listener
 * 
 * */
inputEmail.addEventListener('change', checkUserEmail);
inputConfPass.addEventListener('input', passValidation);

/** 
 * 
 * End Event Listener 
 * 
 * */

/** User Email Checkup */
function checkUserEmail(e){
	if ( isMail(e.target.value) === false ){
		e.target.classList.add("is-invalid");
		return;
	}

	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onload = function() {
		const response = parseInt(this.responseText);

		if(response === 1){
			//Add Error class
			e.target.classList.add("is-invalid");

			//Display Error Message
			let error = createErrorElement( 'Email address already exists' );
			e.target.parentElement.appendChild(error);
		}else{
			e.target.classList.remove("is-invalid");
			e.target.classList.add("is-valid");
			return;
		}
	}

	xmlhttp.open("POST", ajax+"check-user-email.php?email="+inputEmail.value);
	xmlhttp.send();
}

/** Password and Confirm Password Validation */
function passValidation(e){
	let passValue = inputPass.value;
	let confirmPassValue = inputConfPass.value;

	if( confirmPassValue === passValue ){
		inputConfPass.classList.remove("is-invalid");
		inputConfPass.classList.add("is-valid");
	} else{
		//Remove Previous error message if have
		let haveErrorMsg = inputConfPass.parentElement.querySelector('.invalid-feedback');

		inputConfPass.classList.remove("is-valid");
		inputConfPass.classList.add("is-invalid");
		
		if(haveErrorMsg == null){
			let error = createErrorElement( 'Password and confirm password does not match' );
			e.target.parentElement.appendChild(error);
		}
	}

}