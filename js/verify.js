//==================================//
//verify.js for contact form in MARothaus Theme
//==================================//
//global variables

var errorMessage;

//==================================//
//event listeners

window.addEventListener('load', verifyFillContents);
document.getElementById('errorBox').addEventListener('click', closeBox);
//still need the div name - document.getElementById('').addEventListener('click',resetMessages);

//==================================//
//function verifies content in form is correct

function verifyFillContents(){

	var fNameField = document.getElementById('fName');
	var fNameLabel = document.getElementById('fNameLabel');
	var fName = fNameField.value;
	var fEmailField = document.getElementById('fEmail');
	var fEmailLabel = document.getElementById('fEmailLabel');
	var fEmail = fEmailField.value;
	var fPhoneField = document.getElementById('fPhone');
	var fPhoneLabel = document.getElementById('fPhoneLabel');
	var fPhone = fPhoneField.value;
	var fQuestionField = document.getElementById('fQuestion');
	var fQuestionLabel = document.getElementById('fQuestionLabel');
	var fQuestion = fQuestionField.value;
	
	var errorBox= document.getElementById('errorBox');
	
	if(fName === '' && fEmail === '' && fPhone === '' && fQuestion === '' ){
		errorBox.style.display = 'none';
	}else {
			//This area is to change form input and label stylings based on incorrect data
	
	var regexName = /^[a-zA-Z0-9.\-() ]{3,150}$/;
	var regexPhone = /^[0-9.\-()]{10,13}$/;
	var regexEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
	//regexEmail character class written by https://www.123contactform.com/jquery-contact-form.htm 
	var regexQuestion = /^[a-zA-Z0-9.,\\/\-()\[\]\n\r+=_~`;:"'?!@#$%\^&* ]{10,1000}$/;
	
	if(!regexName.test(fName) || fName == ''){
		fNameField.style.boxShadow = 'inset 0 0 .4em .2em #cc4747';
		fNameField.style.borderColor = '#cc4747';
		fNameLabel.style.boxShadow = 'inset 0 0 .4em .2em #cc4747';
		fNameLabel.style.borderColor = '#cc4747';
		fNameLabel.style.color = '#c41f1f';
	}else{
		fNameField.style.boxShadow = '';
		fNameField.style.borderColor = '';
		fNameLabel.style.boxShadow = '';
		fNameLabel.style.borderColor = '';
		fNameLabel.style.color = '';
	}
	
	if(!regexPhone.test(fPhone)){
		fPhoneField.style.boxShadow = 'inset 0 0 .4em .2em #cc4747';
		fPhoneField.style.borderColor = '#cc4747';
		fPhoneLabel.style.boxShadow = 'inset 0 0 .4em .2em #cc4747';
		fPhoneLabel.style.borderColor = '#cc4747';
		fPhoneLabel.style.color = '#c41f1f';
	}else{
		fPhoneField.style.boxShadow = '';
		fPhoneField.style.borderColor = '';
		fPhoneLabel.style.boxShadow = '';
		fPhoneLabel.style.borderColor = '';
		fPhoneLabel.style.color = '';
	}
	
	if(!regexEmail.test(fEmail) || fEmail ===''){
		fEmailField.style.boxShadow = 'inset 0 0 .4em .2em #cc4747';
		fEmailField.style.borderColor = '#cc4747';
		fEmailLabel.style.boxShadow = 'inset 0 0 .4em .2em #cc4747';
		fEmailLabel.style.borderColor = '#cc4747';
		fEmailLabel.style.color = '#c41f1f';
	}else{
		fEmailField.style.boxShadow = '';
		fEmailField.style.borderColor = '';
		fEmailLabel.style.boxShadow = '';
		fEmailLabel.style.borderColor = '';
		fEmailLabel.style.color = '';
	}
	
	if(!regexQuestion.test(fQuestion) || (fQuestion.length>0 && fQuestion.length<=11)){
		fQuestionField.style.boxShadow = 'inset 0 0 1.7em .3em #cc4747';
		fQuestionField.style.borderColor = '#cc4747';
		fQuestionLabel.style.boxShadow = 'inset 0 0 .4em .2em #cc4747';
		fQuestionLabel.style.borderColor = '#cc4747';
		fQuestionLabel.style.color = '#c41f1f';
	}else{
		fQuestionField.style.boxShadow = '';
		fQuestionField.style.borderColor = '';
		fQuestionLabel.style.boxShadow = '';
		fQuestionLabel.style.borderColor = '';
		fQuestionLabel.style.color = '';
	}
		
		errorBox.style.left = '4em';
		errorBox.style.display = 'block';
		setTimeout(function(){
			closeBox();
		},60000);
	}

}

//==================================//
//function resets error messages

function closeBox() {
	var errorBox= document.getElementById('errorBox');
	
	errorBox.style.left = '100em';
	setTimeout(function(){
		errorBox.style.display = 'none';
	},600);
}