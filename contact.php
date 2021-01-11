<?php
/**
 * EDIT THE VALUES BELOW THIS LINE TO ADJUST THE CONFIGURATION
 * EACH OPTION HAS A COMMENT ABOVE IT WITH A DESCRIPTION
 */
/**
 * Specify the email address to which all mail messages are sent.
 * The script will try to use PHP's mail() function,
 * so if it is not properly configured it will fail silently (no error).
 */
$mailTo     = 'office@get-smart.uk ';

/**
 * Set the message that will be shown on success
 */
$successMsg = 'Thank you, mail sent successfully!';

/**
 * Set the message that will be shown if not all fields are filled
 */
$fillMsg    = 'Please fill all fields!';

/**
 * Set the message that will be shown on error
 */
$errorMsg   = 'Hm.. seems there is a problem, sorry! Try again later';

/**
 * DO NOT EDIT ANYTHING BELOW THIS LINE, UNLESS YOU'RE SURE WHAT YOU'RE DOING
 */

?>
<?php
if(
	!isset($_POST['trial']) ||
    !isset($_POST['name']) ||
    !isset($_POST['email']) ||  
	!isset($_POST['phone']) ||  
	!isset($_POST['town']) ||
	!isset($_POST['tuition']) ||
	!isset($_POST['lessons']) ||
	!isset($_POST['age']) ||
	empty($_POST['trial']) ||
    empty($_POST['name']) ||
    empty($_POST['email']) ||
	 empty($_POST['phone']) ||
	empty($_POST['town']) ||
	empty($_POST['tuition']) ||
	empty($_POST['lessons']) ||
	empty($_POST['age']) 
   
) {
	
	if( empty($_POST['name']) && empty($_POST['email']) ) {
		$json_arr = array( "type" => "error", "msg" => $fillMsg );
		echo json_encode( $json_arr );		
	} else {

		$fields = "";
		if( !isset( $_POST['name'] ) || empty( $_POST['name'] ) ) {
			$fields .= "Name";
		}
		
		if( !isset( $_POST['email'] ) || empty( $_POST['email'] ) ) {
			if( $fields == "" ) {
				$fields .= "Email";
			} else {
				$fields .= ", Email";
			}
		}
		
		
		if( !isset( $_POST['phone'] ) || empty( $_POST['phone'] ) ) {
			if( $fields == "" ) {
				$fields .= "phone";
			} else {
				$fields .= ", Phone";
			}
		}
		
		if( !isset( $_POST['town'] ) || empty( $_POST['town'] ) ) {
			if( $fields == "" ) {
				$fields .= "town";
			} else {
				$fields .= ", town";
			}
		}

		if( !isset( $_POST['tuition'] ) || empty( $_POST['tuition'] ) ) {
			if( $fields == "" ) {
				$fields .= "tuition";
			} else {
				$fields .= ", tuition";
			}
		}

		if( !isset( $_POST['trial'] ) || empty( $_POST['trial'] ) ) {
			if( $fields == "" ) {
				$fields .= "trial";
			} else {
				$fields .= ", trial";
			}
		}

		if( !isset( $_POST['age'] ) || empty( $_POST['age'] ) ) {
			if( $fields == "" ) {
				$fields .= "age";
			} else {
				$fields .= ", age";
			}
		}

		if( !isset( $_POST['lessons'] ) || empty( $_POST['lessons'] ) ) {
			if( $fields == "" ) {
				$fields .= "lessons";
			} else {
				$fields .= ", lessons";
			}
		}
		
		$json_arr = array( "type" => "error", "msg" => "Please fill ".$fields." fields!" );
		echo json_encode( $json_arr );		
	
	}

} else {

	// Validate e-mail
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
		
		$msg = "Trial: ".$_POST['trial']."\r\n";	
		$msg .= "Name: ".$_POST['name']."\r\n";
		$msg .= "Email: ".$_POST['email']."\r\n";
		$msg .= "Phone: ".$_POST['phone']."\r\n";
		$msg .= "town: ".$_POST['town']."\r\n";	
		$msg .= "Subject: ".$_POST['tuition']."\r\n";
		$msg .= "Age: ".$_POST['age']."\r\n";	
		$msg .= "Number of lessons: ".$_POST['lessons']."\r\n";		
		
		if( isset( $_POST['message'] ) && $_POST['message'] != '' ) { $msg .= "Message: ".$_POST['message']."\r\n"; }
		
		$success = @mail($mailTo, $_POST['email'], $msg, 'From: ' . $_POST['name'] . '<' . $_POST['email'] . '>');
		
		if ($success) {
			$json_arr = array( "type" => "success", "msg" => $successMsg );
			echo json_encode( $json_arr );
		} else {
			$json_arr = array( "type" => "error", "msg" => $errorMsg );
			echo json_encode( $json_arr );
		}
		
	} else {
 		$json_arr = array( "type" => "error", "msg" => "Please enter valid email address!" );
		echo json_encode( $json_arr );	
	}

}