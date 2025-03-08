<?php

namespace Jlbousing\LaravelLinkedinLearning\Clients;

use Illuminate\Support\Facades\Log;

class LinkedinHttpClient
{

    private $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function get(string $url, array $queryParams = [])
    {
        try {
            $fullUrl = $url . '?' . http_build_query($queryParams);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $fullUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    "Authorization: Bearer {$this->accessToken}",
                    'Cookie: lidc="b=TB14:s=T:r=T:a=T:p=T:g=6216:u=1:x=1:i=1740447470:t=1740452470:v=2:sig=AQHsp2xg7ctuhrK12y_MXTWVvxWhM_TT"; bcookie="v=2&dbf865a5-3ba8-4268-8c53-3d6ee2080609"',
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                Log::error("LinkedIn API Request Error: $err");
                throw new \Exception("LinkedIn API Request Failed");
            }

            return json_decode($response, true);
        } catch (\Exception $e) {
            Log::error("LinkedIn API Client Error: " . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
