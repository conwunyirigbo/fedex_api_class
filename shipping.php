<?php

namespace fedex;

include('auth.php');
include('baseRequest.php');
include('contact.php');
include('address.php');
include('rateResponse.php');
include('shippingResponse.php');

use fedex\baseRequest;
use fedex\shippingResponse;

class shipping {
    private string $token;
    private const BASE_URL = FEDEX_URL;

    public function __construct() {
        $auth = new FedexAuth();
        $auth->getFedexToken();
        $this->token = $auth->getToken();
    }

    public function createFedExShipment(baseRequest $request): shippingResponse|null {

        $url = self::BASE_URL.'/ship/v1/shipments';

        $requestData = $this->getBasePayload($request);
        $requestData = array_merge($requestData, [
           "labelResponseOptions" => "URL_ONLY",
        ]);
        $requestData['requestedShipment'] = array_merge($requestData['requestedShipment'], [
            "blockInsightVisibility" => false,
            "shippingChargesPayment" => [
                     "paymentType" => "SENDER"
                 ]
         ]);
        unset($requestData['requestedShipment']['recipient']);

        $responseData = $this->sendRequest($requestData, $url);

        if (isset($responseData['output']['transactionShipments'][0]['masterTrackingNumber'])) {
            return new shippingResponse(
                $responseData['output']['transactionShipments'][0]['masterTrackingNumber'],
                $responseData['transactionId'],
                $responseData['customerTransactionId'],
                $responseData['output']['transactionShipments'][0]['completedShipmentDetail']['operationalDetail']['deliveryDate'],
                $responseData['output']['transactionShipments'][0]['completedShipmentDetail']['operationalDetail']['deliveryDay'],
                $responseData['output']['transactionShipments'][0]['completedShipmentDetail']['operationalDetail']['transitTime'],
                $responseData['output']['transactionShipments'][0]['serviceName']
            );
        }
        return null;
    }

    public function validateFedExShipment(baseRequest $request): bool {

        $url = self::BASE_URL.'/ship/v1/shipments/packages/validate';

        $requestData = $this->getBasePayload($request);
        $requestData['requestedShipment'] = array_merge($requestData['requestedShipment'], [
            "blockInsightVisibility" => true,
            "shippingChargesPayment" => [
                     "paymentType" => "SENDER"
                 ]
         ]);
        unset($requestData['requestedShipment']['recipient']);
        unset($requestData['requestedShipment']['preferredCurrency']);
        $requestData['requestedShipment']['requestedPackageLineItems'] = [array_slice($requestData['requestedShipment']['requestedPackageLineItems'][0], 0, 1)];

        $responseData = $this->sendRequest($requestData, $url);

        if (isset($responseData['output']['alerts'][0]['code']) == "SHIPMENT.VALIDATION.SUCCESS") {
            return true;
        }
        return false;
    }

    public function getFedexRate(baseRequest $request): rateResponse|null {
        $requestData = $this->getBasePayload($request);
        $requestData = array_merge($requestData, [
            "rateRequestControlParameters" => [
                "returnTransitTimes" => true,
            ]
        ]);
        unset($requestData['requestedShipment']['recipients']);

        $url = self::BASE_URL.'/rate/v1/rates/quotes';

        $response = $this->sendRequest($requestData, $url);

        if ($response != null && isset($response['output']['rateReplyDetails'])) {
            return new rateResponse(
                $response['output']['rateReplyDetails'][0]['ratedShipmentDetails'][0]['totalNetCharge'],
                $response['output']['rateReplyDetails'][0]['operationalDetail']['deliveryDate'],
                $response['output']['rateReplyDetails'][0]['operationalDetail']['deliveryDay'],
                $response['output']['rateReplyDetails'][0]['operationalDetail']['transitTime'],
                $response['output']['rateReplyDetails'][0]['serviceName']
            );
        }

        return null;
    }

    private function sendRequest($requestData, $url)
    {
        $customer_transaction_id = guidv4();

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->token,
            'X-locale: en_US',
            'x-customer-transaction-id: '.$customer_transaction_id
        ];

        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

        $response = curl_exec($ch);
        if (substr($response, 0, 2) == "\x1f\x8b") {
            // It's GZIP compressed, so decompress
            $response = gzdecode($response);
        }
        // echo $response;

        if (curl_errno($ch)) {
            echo 'Request Error: ' . curl_error($ch);
        } else {
            $responseData = json_decode($response, true);
            return $responseData;
        }

        curl_close($ch);

        return null;
    }

    private function getBasePayload(baseRequest $request)
    {
        $requestData = [
            "requestedShipment" => [
                "shipper" => [
                    "contact" => $request->getShipperContact()->toArray(),
                    "address" => $request->getShipperAddress()->toArray()
                ],
                "recipient" => [
                    "contact" => $request->getRecipientContact()->toArray(),
                    "address" => $request->getRecipientAddress()->toArray()
                ],
                "recipients" => [
                    [
                        "contact" => $request->getRecipientContact()->toArray(),
                        "address" => $request->getRecipientAddress()->toArray()
                    ]
                ],
                "shipDatestamp" => $request->getShipDatestamp(),
                "pickupType" => $request->getPickupType(),
                "serviceType" => $request->getServiceType(),
                "requestedPackageLineItems" => $request->getRequestedPackageLineItems(),
                "packagingType" => $request->getPackagingType(),
                "labelSpecification" => [
                    "imageType" => "PDF",
                    "labelStockType" => "PAPER_7X475"
                ],
                "rateRequestType" => [
                    "PREFERRED",
                    "LIST"
                ],
                "preferredCurrency" => $request->getPreferredCurrency(),
            ],
            "accountNumber" => [
                "value" => FEDEX_ACCOUNT_NO
            ],            
        ];  

        return $requestData;
    }
}
?>