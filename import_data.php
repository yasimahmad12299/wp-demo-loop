<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


import_data();

// Function to import data
function import_data() {
		$read_file = file_get_contents(get_template_directory().'/import_files/file.json'); 
		$get_values = json_decode($read_file, true);
		$imported_events_count = 0;
		$updated_events_count = 0;
        echo "Importing data.. \n";
		foreach($get_values as $items) { 
			
			$args = array(
				'fields' => 'ids',
				'post_type'   => 'events',
				'meta_query'  => array(
				  array(
				  'key' => 'id',
				  'value' => $items["id"]
				  )
				)
			  );

			  $query = new WP_Query( $args );
			  if( empty($query->have_posts())) {
            
				$post_id = wp_insert_post(array (
				'post_type' => 'events',
				'post_title' => sanitize_text_field($items["title"]),
				'post_content' => sanitize_textarea_field($items["about"]),
				'post_status' => 'publish',
				'post_date' => $items["timestamp"]
				));

				if ($post_id) {
					// insert post meta
					add_post_meta($post_id, 'id', sanitize_text_field($items["id"]));
					add_post_meta($post_id, 'organizer', sanitize_text_field($items["organizer"]));
					add_post_meta($post_id, 'email_address', sanitize_text_field($items["email"]));
					add_post_meta($post_id, 'address', sanitize_text_field($items["address"]));
					add_post_meta($post_id, 'latitude', sanitize_text_field($items["latitude"]));
					add_post_meta($post_id, 'longitude', sanitize_text_field($items["longitude"]));
					add_post_meta($post_id, 'date_time', sanitize_text_field($items["timestamp"]));
					wp_set_object_terms($post_id , $items['tags'], 'event-tags', false);

				}	
				$imported_events_count = $imported_events_count+1;
			}
			else {
			
					$post_id = $query->posts[0];
					$update_post = wp_update_post(array(
						'ID'           => $post_id,
						'post_type' => 'events',
						'post_title' => sanitize_text_field($items["title"]),
						'post_content' => sanitize_textarea_field($items["about"]),
						'post_status' => 'publish',
						'post_date' => $items["timestamp"]
					));

					if ($post_id) {
						// insert post meta
						//add_post_meta($post_id, 'id', sanitize_text_field($items["id"]));
						update_post_meta($post_id, 'organizer', sanitize_text_field($items["organizer"]));
						update_post_meta($post_id, 'email_address', sanitize_text_field($items["email"]));
						update_post_meta($post_id, 'address', sanitize_text_field($items["address"]));
						update_post_meta($post_id, 'latitude', sanitize_text_field($items["latitude"]));
						update_post_meta($post_id, 'longitude', sanitize_text_field($items["longitude"]));
						update_post_meta($post_id, 'date_time', sanitize_text_field($items["timestamp"]));
						wp_set_object_terms($post_id , $items['tags'], 'event-tags', false);
	
					}	
					$updated_events_count = $updated_events_count+1;
			}
	
		}

        echo $report = "Imported: ". $imported_events_count. ", Updated: ". $updated_events_count;

        send_email($imported_events_count, $updated_events_count);
    }

//==================================================================================//

        // Function to send automated email after import

        function send_email($imported_events_count, $updated_events_count) {

            $mail = new PHPMailer(true);

            try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
            $mail->isSMTP();                                          
            $mail->Host       = SMTP_HOST;                 
            $mail->SMTPAuth   = true;                                 
            $mail->Username   = SMTP_USER_NAME;                    
            $mail->Password   = SMTP_PASSWORD;                              
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = SMTP_PORT;                                   
    
            //Recipients
            $mail->setFrom('noreply@gmail.com', 'WP Demo Loop');
            $mail->addAddress('logging@agentur-loop.com', 'Loop Admin');     
           // $mail->addReplyTo('yasim.ahmad@gmail.com', 'WP Demo Loop');
    
            //Content
            $mail->isHTML(true);                              
            $mail->Subject = 'WP Demo Loop - Import Report';
            $mail->Body    = "<b> Total Imported Records: </b>". $imported_events_count. "<br>". "<b> Total Updated Records: </b>". $updated_events_count;
       
            $mail->send();
            echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        
        
?>