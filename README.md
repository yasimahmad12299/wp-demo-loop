# wp-demo-loop

<h3>WP Admin Credentials: </h3>

<p>Username: demo-admin</p>
<p>Password: bE7B(bWHT8*Ol%J^@K</p>
<hr>

<h3>WP CLI Trigger to Import the JSON File: </h3>

wp eval-file import_data.php
<p>The import file has already been uploaded under themes/twentytwentytwo/import_files directory and named as <strong>file.json</strong></p>

<hr>

<h3>Automated Email Configuration: </h3>

<h4>Setup SMTP</h4>
<p>I had to configure the SMTP and used PHP mailer to send the emails from local host. I have defined the SMTP details in the wp-config.php as global variables. Please change the details as per the requirements.</p>

<p>I have also used WP SMTP plugin to make sure the emails are being delivered from the local host. I have used Gmail API to send emails and the from email is yasim.ahmad@gmail.com</p>
<hr>

<h3>End point to return events list in JSON: </h3>
BASE_URL/wp-json/events/list
<p>Please replace the BASE_URL as per the host name.</p>