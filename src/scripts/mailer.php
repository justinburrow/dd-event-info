<?php
header("Access-Control-Allow-Origin: *");

$_POST = json_decode(file_get_contents('php://input'), true);

$to = "dallasanddoll@gmail.com";
$eventDetails = $_POST['eventDetails'];
$eventInfo = $_POST['eventInfo'];

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
                
$headers = "From:" . $customer['email'] . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to,$subject,$message,$headers);
echo 'sent';
?>