<?php
/* Template Name: mail */
	$email = wp_mail( 'yasim.ahmad@gmail.com', 'test', 'testing');
    if($email) {
        echo "Email sent";
        }
        else {
            echo "error";
        }

?>