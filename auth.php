<?php

namespace fedex;

class FedexAuth{
    private $apiKey;
    private $apiSecret;
    private $token;
    private $expiresIn;

    public function __construct()
    {
        $this->apiKey = FEDEX_API_KEY;
        $this->apiSecret = FEDEX_SECRET_KEY;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function getFedexToken()
    {
        $response = [];
        $url = 'https://apis-sandbox.fedex.com/oauth/token';

        $authorization = base64_encode("$this->apiKey:$this->apiSecret");

        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->apiKey,
            'client_secret' => $this->apiSecret
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . $authorization,
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Request Error: ' . curl_error($ch);
        } else {
            $responseData = json_decode($response, true);
            $this->setToken($responseData['access_token']);
            $this->setExpiresIn($responseData['expires_in']);
        }

        curl_close($ch);
    }

    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getExpiresIn()
    {
        return $this->expiresIn;
    }
}

?>
