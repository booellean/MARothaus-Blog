<?php get_header(); ?>

<?php
//code by Senador from https://stackoverflow.com/questions/4323411/how-can-i-write-to-console-in-php
//This function allows me to debug by sending to console

function console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

//Code composed based on two primary sources
//https://premium.wpmudev.org/blog/how-to-build-your-own-wordpress-contact-form-and-why/
//http://www.freecontactform.com/email_form.php

//variable builds errors to be echoed;

		global $echo_to_dom;

		$echo_to_dom = '<p>Please correct the following fields:</p>';
	
//regex tests

		$regexname = '/^[a-zA-Z0-9.\-() ]{3,150}+$/';
		$regexphone = '/^[0-9.\-()]{10,13}+$/';
		$regexquestion = '/^[a-zA-Z0-9#$!%^&*()+=\-\[\]\';,.\/|":<>?~\\\\ \n\r]{10,10000}+$/';
		$regexemail = '/^[a-zA-Z0-9_.+\-]+@[a-zA-Z0-9\-.]+\.[a-zA-Z0-9]{2,4}$/'; 
		//regexEmail character class written by https://www.123contactform.com/jquery-contact-form.htm 

		//user posted variables
		$name = $_POST['fName'];
		$email = $_POST['fEmail'];
		$phone = $_POST['fPhone'];
		$question = $_POST['fQuestion'];

		//php mailer variables
		$to = 'contact@mr-ecology.com';
		$subject = 'Contact Request from Website!';
		$message_body = 'Name: ' . $name  . '   Email: ' . $email  . '   Phone: ' . $phone . '   Question: ' . $question;
		$headers =  'From: ' . $email  . ' Reply-To: ' . $email; 

		//reCaptcha variables written with the help of https://codeforgeek.com/2014/12/google-recaptcha-tutorial/
		$secretKey = '6LdsODIUAAAAAFv8SkIJlyHRDT0Ws2xHDshekrvX';
		$captcha=$_POST['g-recaptcha-response'];
		$ip = $_SERVER['REMOTE_ADDR'];

		$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
		$responseKeys = json_decode($response,true);

//Form checks if all variables meet conditions

		if(empty($name) && empty($email) && empty($phone) && empty($question) && empty($human)){
			console('do not show errors');
		}else{
			if(intval($responseKeys["success"]) !== 1){ 
				$echo_to_dom .= '<p>Human verification was not met.</p>';
				//Gives a separate error for each problem
					if(!preg_match($regexemail, $email) || empty($email)){
						$echo_to_dom .= '<p>The email you have entered is not valid.</p>';}
					if(empty($name) || !preg_match($regexname, $name)){
						$echo_to_dom .= '<p>The name is not invalid</p>';}
					if(!preg_match($regexphone, $phone) && !empty($phone)){
						$echo_to_dom .= '<p>The phone number must be valid or left blank</p>';}
					if(!preg_match($regexquestion, $question) || empty($question)){
						$echo_to_dom .= '<p>The question field must not contian any special characters such as {} or <></p>';}
			}else{ //Test all variables
				if(!preg_match($regexemail, $email) || empty($email) || empty($name) || !preg_match($regexname, $name) || (!preg_match($regexphone, $phone) && !empty($phone)) || !preg_match($regexquestion, $question) || empty($question)){
					//Gives a separate error for each problem
					if(!preg_match($regexemail, $email) || empty($email)){
						$echo_to_dom .= '<p>The email you have entered is invalid.</p>';}
					if(empty($name) || !preg_match($regexname, $name)){
						$echo_to_dom .= '<p>The name is invalid</p>';}
					if(!preg_match($regexphone, $phone) && !empty($phone)){
						$echo_to_dom .= '<p>The phone number must be valid or left blank</p>';}
					if(!preg_match($regexquestion, $question) || empty($question)){
						$echo_to_dom .= '<p>The question field must not contian any special characters such as brackets</p>';}
				}else{ //ready to go!
 							$sent = mail($to, $subject, $message_body, $headers);
							if($sent){ //message sent!
								$echo_to_dom = '<p>Thank you! the author will contact you shortly.</p>';
								console('the message is sending!');
							}else{ //message wasn't sent
								$echo_to_dom = '<p>An error occurred with our servers. Please try again later!</p>';
							console('the message has not sent!');
						}
					}
				}
		}
?>

	<div class = "page-title"><h1>Contact the Author</h1></div>
	
	<div class="validateSend" id="errorBox"><?php echo $echo_to_dom; ?></div>

	<form name="contactMe" id="contactMe" method="post" action="<?php the_permalink(); ?>">
		<div class="formFlex">
			<div class="formLabel" id="fNameLabel">
				<label for="fName">Name:*</label>
			</div>
			<div class="formField">
				<input type="text" name="fName" id="fName" value="<?php echo esc_attr($_POST['fName']); ?>">
			</div>
		</div>
		
		<div class="formFlex">
			<div class="formLabel" id="fEmailLabel">
				<label for="fEmail">Email:*</label>
			</div>
			<div class="formField">
				<input type="text" name="fEmail" id="fEmail" value="<?php echo esc_attr($_POST['fEmail']); ?>">
			</div>
		</div>
		
		<div class="formFlex">
			<div class="formLabel" id="fPhoneLabel">
				<label for="fPhone">Phone:</label>
			</div>
			<div class="formField">
				<input type="tel" name="fPhone" id="fPhone" value="<?php echo esc_attr($_POST['fPhone']); ?>">
			</div>
		</div>
		
		<div class="row"><label for="fQuestion" class="textareaQuestion" id="fQuestionLabel">Question:*</label></div>
		<div class="row">
			<textarea id="fQuestion" name="fQuestion" placeholder="Please type a brief question for Matt, and watch for your confirmation email!"><?php echo esc_textarea($_POST['fQuestion']); ?></textarea>
		</div>
		<input type="hidden" name="submitted" value="1">
		<div class="row">
			<button type="submit" id="submitForm" name="submitForm">Send</button></div>
			
			<div class="formFlex">
				<div class="g-recaptcha" data-sitekey="6LdsODIUAAAAAE7MudSR_iIQYAxH51Wv6TjT0AYS"></div>
			</div>

	</form>

<?php get_footer(); ?>