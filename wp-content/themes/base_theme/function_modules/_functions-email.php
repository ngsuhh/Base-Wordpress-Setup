<?php

    /**
     * Send email
     * @return none
     */
	function sendEmail(){

		$to = 'test@test.com';


		// If in dev env, set email to dev email
		if(defined('DEBUG_EMAIL')){
			$to = DEBUG_EMAIL;
		}


		$subject = 'Registration Confirmation';

		$message = "Dear Sample, <br>";
		$message .= 'Thank you for registering and welcome to Adenauer Fellowship!<br>';
		$message .= 'You\'ve receive this email to confirm your registration at adenauer.careers.<br>';
		$message .= 'You can now log in and create your profile.<br>';
		$message .= 'If you’re applying for the Adenauer Fellowship, we wish you best of luck!<br>';

		$message .= '<br><br>If you didn’t register on our website, please ignore this email.<br>';

		$headers = 'From: Sample <sample@sample.com>' . "\r\n";


		wp_mail($to, $subject, $message, $headers);
	}
