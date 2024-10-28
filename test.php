<?php
include('shipping.php');

use fedex\shipping;
use fedex\Contact;
use fedex\Address;
use fedex\baseRequest;

// Example usage
$shipper = [
    'Contact' => ['PersonName' => 'John Doe', 'PhoneNumber' => '1234567890'],
    'Address' => [
        'StreetLines' => ['123 Main St'],
        'City' => 'Memphis',
        'StateOrProvinceCode' => 'TN',
        'PostalCode' => '38103',
        'CountryCode' => 'US',
    ],
];

$recipient = [
    'Contact' => ['PersonName' => 'Jane Smith', 'PhoneNumber' => '0987654321'],
    'Address' => [
        'StreetLines' => ['456 Elm St'],
        'City' => 'Nashville',
        'StateOrProvinceCode' => 'TN',
        'PostalCode' => '37201',
        'CountryCode' => 'US',
    ],
];

$packageDetails = [
    'SequenceNumber' => 1,
    'GroupPackageCount' => 1,
    'Weight' => [
        'Units' => 'LB',
        'Value' => 10.0,
    ],
    'Dimensions' => [
        'Length' => 10,
        'Width' => 10,
        'Height' => 10,
        'Units' => 'IN',
    ],
];

// Create the shipment
$shipping = new shipping();
$shipperContact = new Contact("Alice Johnson", "555-123-4567", "Shipper Company");
$recipientContact = new Contact("Bob Smith", "555-987-6543", "Recipient Company");

$shipperAddress = new Address(["123 Shipper St"], "Owings Mills", "MD", "21117", "US", residential: false);
$recipientAddress = new Address(["456 Recipient Rd"], "Baltimore", "MD", "21202", "US");

$accountNo = FEDEX_ACCOUNT_NO;
$shipDatestamp = date('Y-m-d');

$packageLines = [
                    [
                        "weight" => [
                            "units" => "LB",
                            "value" => 50
                        ]
                    ],
                    [
                        "weight" => [
                            "units" => "LB",
                            "value" => 60
                        ]
                    ]
                ];

$baseRequest = new baseRequest(
    $shipperContact,
    $recipientContact,
    $shipperAddress,
    $recipientAddress,
    $accountNo,
    $shipDatestamp,
    requestedPackageLineItems: $packageLines
);
$response = $shipping->getFedexRate($baseRequest);
echo $response->getTotalNetCharge();