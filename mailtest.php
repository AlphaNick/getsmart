<?php
   

    session_cache_limiter( 'nocache' );
    error_reporting(0);
    header( 'Expires: ' . gmdate( 'r', 0 ) );
    header( 'Content-type: application/json' );


    $to         = 'sales@stokescreations.com';

    $email_template = 'simple.html';
    $email     			= strip_tags($_POST['email']);
    $phone     			= strip_tags($_POST['phone']);
    $town     			= strip_tags($_POST['town']);
    $age     		    = strip_tags($_POST['age']);
    $lessons     		= strip_tags($_POST['lessons']);
    $name            	= strip_tags($_POST['name']);
    $message    		= nl2br( htmlspecialchars($_POST['message'], ENT_QUOTES) );
    $result     		= array();

    
    if(empty($name)){

        $result = array( 'response' => 'error', 'empty'=>'name', 'message'=>'<strong>Error!</strong> Name is empty.' );
        echo json_encode($result );
        die;
    } 

    if(empty($email)){

        $result = array( 'response' => 'error', 'empty'=>'email', 'message'=>'<strong>Error!</strong> Email is empty.' );
        echo json_encode($result );
        die;
    } 

    if(empty($message)){

         $result = array( 'response' => 'error', 'empty'=>'message', 'message'=>'<strong>Error!</strong> Message body is empty.' );
         echo json_encode($result );
         die;
    }
    


    $headers  = "From: " . $name . ' <' . $email . '>' . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


    $templateTags =  array(
  
        '{{email}}'=>$email,
        '{{message}}'=>$message,
        '{{name}}'=>$name,
        '{{phone}}'=>$phone,
        '{{town}}'=>$town,
        '{{age}}'=>$english,
        '{{lessons}}'=>$lessons
        );


    $templateContents = file_get_contents( dirname(__FILE__) . '/email-templates/'.$email_template);

    $contents =  strtr($templateContents, $templateTags);

    if ( mail( $to, $contents, $headers ) ) {
        $result = array( 'response' => 'success', 'message'=>'<strong>Success!</strong> Mail Sent.' );
    } else {
        $result = array( 'response' => 'error', 'message'=>'<strong>Error!</strong> Cann\'t Send Mail.'  );
    }

    echo json_encode( $result );

    die;
?>