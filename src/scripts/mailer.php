<?php
header("Access-Control-Allow-Origin: *");

$_POST = json_decode(file_get_contents('php://input'), true);

$to = "dallasanddoll@gmail.com";
$eventDetails = $_POST['eventDetails'];
$eventInfo = $_POST['eventInfo'];

$customer = $eventDetails['customer'];
$venue = $eventDetails['venueInfo'];

$subject = "D+D Event Quote Request for " . $customer['email'];


$message = '<b>Client:</b>'. "\n" 
            . 'Name: ' . $customer['name'] . "\n"
            . 'Tel: ' . $customer['phone'] . "\n"
            . 'Email: ' . $customer['email'] . "\n\n\n"
          . '<b>Event Details:</b>'. "\n"
            . 'Event Date: ' . $eventInfo['eventDate'] . "\n"
            . 'Event Type: ' . $eventInfo['eventType'] . "\n"
            . 'Event Length: ' . $eventInfo['eventLength'] . "\n"
            . 'Event Size: ' . $eventInfo['eventSize'] . "\n\n"
            
            . 'Venue: ' . $venue['name'] . "\n"
            . $venue['address'] . "\n\n"
            
            . 'Band Setup: ' . $eventDetails['bandOptions'] . "\n"
            . 'P.A. Expected to be provided by Band: ' . $eventDetails['sound'] . "\n"
            . 'Inside/Outside Setup: ' . $eventDetails['inside'] . "\n\n";
            
            if ($eventDetails['wedding'])
              $message .= '<b>Wedding Details</b>' . "\n";
            
              if ($eventDetails['wedding']['ceremony'])
                $message .= 'Ceremony Setup: ' . $eventDetails['wedding']['ceremonySetup'] . "\n"
                . 'Ceremony Performance: ' . $eventDetails['wedding']['ceremonyPlayTime'] . "\n\n";

              if ($eventDetails['wedding']['cocktail'])
                $message .= 'Cocktail Hour Setup: ' . $eventDetails['wedding']['cocktailSetup'] . "\n"
                . 'Cocktail Hour Performance: ' . $eventDetails['wedding']['cocktailPlayTime'] . "\n\n";
            
              if ($eventDetails['wedding']['dinner'])
                $message .= 'Dinner Setup: ' . $eventDetails['wedding']['dinnerSetup'] . "\n"
                . 'Dinner Performance: ' . $eventDetails['wedding']['dinnerPlayTime'] . "\n\n";
            
              if ($eventDetails['wedding']['dancing'])
                $message .= 'Dancing Setup: ' . $eventDetails['wedding']['dancingSetup'] . "\n"
                . 'Dancing Performance: ' . $eventDetails['wedding']['dancingPlayTime'] . "\n\n";
                
$headers = "From:" . $customer['email'];
mail($to,$subject,$message,$headers);
echo 'sent';
?>