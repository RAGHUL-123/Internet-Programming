<?php

// Step 1: Read the content from a text file
$textFile = 'input.txt'; // Your input text file
$content = file_get_contents($textFile);

// Step 2: Use Regular Expressions to extract emails and phone numbers
$emails = [];
$phoneNumbers = [];

// Regex for email addresses
$emailPattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';
preg_match_all($emailPattern, $content, $emails);

// Regex for phone numbers (format: 123-456-7890 or (123) 456-7890)
$phonePattern = '/(\(\d{3}\)\s?|\d{3}-)?\d{3}-\d{4}/';
preg_match_all($phonePattern, $content, $phoneNumbers);

// Step 3: Create XML Structure
$xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

$emailsNode = $xml->addChild('emails');
foreach ($emails[0] as $email) {
    $emailsNode->addChild('email', htmlspecialchars($email));
}

$phonesNode = $xml->addChild('phoneNumbers');
foreach ($phoneNumbers[0] as $phone) {
    $phonesNode->addChild('phoneNumber', htmlspecialchars($phone));
}

// Step 4: Save the XML to a file
$xmlFile = 'output.xml';
$xml->asXML($xmlFile);

echo "Data extracted and saved to output.xml.";

?>
