<?php
$_POST = json_decode(file_get_contents('php://input'), true);

$to = "dallasanddoll@gmail.com";
$eventDetails = $_POST['eventDetails'];
$eventInfo = $_POST['eventInfo'];
$mcEmail = $_POST['eventDetails']['customer']['email'];
$mcFname = explode(' ', $_POST['eventDetails']['customer']['name'])[0];
$mcLname = explode(' ', $_POST['eventDetails']['customer']['name'])[1];

$customer = $eventDetails['customer'];
$venue = $eventDetails['venueInfo'];

$subject = "D+D Event Quote Request for " . $customer['email'];


$message = '<b>Client:</b>'. "<br>" 
            . 'Name: ' . $customer['name'] . "<br>"
            . 'Tel: ' . $customer['phone'] . "<br>"
            . 'Email: ' . $customer['email'] . "<br><br><br>"
          . '<b>Event Details:</b>'. "<br>"
            . 'Event Date: ' . $eventInfo['eventDate'] . "<br>"
            . 'Event Type: ' . $eventInfo['eventType'] . "<br>"
            . 'Event Length: ' . $eventInfo['eventLength'] . "<br>"
            . 'Event Size: ' . $eventInfo['eventSize'] . "<br><br>"
            
            . 'Venue: ' . $venue['name'] . "<br>"
            . $venue['address'] . "<br><br>"
            
            . 'Band Setup: ' . $eventDetails['bandOptions'] . "<br>"
            . 'P.A. Expected to be provided by Band: ' . $eventDetails['sound'] . "<br>"
            . 'Inside/Outside Setup: ' . $eventDetails['inside'] . "<br><br>";
            
            if ($eventDetails['wedding'])
              $message .= '<b>Wedding Details</b>' . "<br>";
            
              if ($eventDetails['wedding']['ceremony'])
                $message .= 'Ceremony Setup: ' . $eventDetails['wedding']['ceremonySetup'] . "<br>"
                . 'Ceremony Performance: ' . $eventDetails['wedding']['ceremonyPlayTime'] . "<br><br>";

              if ($eventDetails['wedding']['cocktail'])
                $message .= 'Cocktail Hour Setup: ' . $eventDetails['wedding']['cocktailSetup'] . "<br>"
                . 'Cocktail Hour Performance: ' . $eventDetails['wedding']['cocktailPlayTime'] . "<br><br>";
            
              if ($eventDetails['wedding']['dinner'])
                $message .= 'Dinner Setup: ' . $eventDetails['wedding']['dinnerSetup'] . "<br>"
                . 'Dinner Performance: ' . $eventDetails['wedding']['dinnerPlayTime'] . "<br><br>";
            
              if ($eventDetails['wedding']['dancing'])
                $message .= 'Dancing Setup: ' . $eventDetails['wedding']['dancingSetup'] . "<br>"
                . 'Dancing Performance: ' . $eventDetails['wedding']['dancingPlayTime'] . "<br><br>";

$auth = base64_encode( 'user:7370bbe2c4800a3cd06b7a86a326c9ff-us12' );
$mcData = array(
	'email_address' => $mcEmail,
	'status'        => 'subscribed',
	'merge_fields'  => array(
		'FNAME' => $mcFname,
    'LNAME' => $mcLname
		)
	);
$json_data = json_encode($mcData);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://us12.api.mailchimp.com/3.0/lists/c88f42b070/members/');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
	'Authorization: Basic '.$auth));
curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

$sendEmailAddress = json_encode(array('email_address'=>$mcEmail));
$sendEmail = curl_init();
curl_setopt($sendEmail, CURLOPT_URL, 'https://us12.api.mailchimp.com/3.0/automations/003fb825af/emails/537f90bcbf/queue/');
curl_setopt($sendEmail, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
	'Authorization: Basic '.$auth));
curl_setopt($sendEmail, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
curl_setopt($sendEmail, CURLOPT_RETURNTRANSFER, true);
curl_setopt($sendEmail, CURLOPT_TIMEOUT, 10);
curl_setopt($sendEmail, CURLOPT_POST, true);
curl_setopt($sendEmail, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($sendEmail, CURLOPT_POSTFIELDS, $sendEmailAddress);

curl_exec($ch);
curl_exec($sendEmail);
        
$headers = "From:" . $customer['email'] . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to,$subject,$message,$headers);
echo 'sent';
?>