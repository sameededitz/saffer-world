<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class FirebaseService
{
    protected $client;
    protected $firebaseKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->firebaseKey = json_decode(Storage::get('public/firebase/clubs-player-d5842-firebase-adminsdk-nck91-9c660a35fa.json'), true);
    }

    public function sendPushNotification($tokens, $title, $body, $data = [])
    {
        $url = 'https://fcm.googleapis.com/v1/projects/clubs-player-d5842/messages:send';
        $headers = [
            'Authorization' => 'Bearer ' . $this->generateAccessToken(),
            'Content-Type' => 'application/json'
        ];

        foreach ($tokens as $token) {
            $notification = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'apns' => [
                        'payload' => [
                            'aps' => [
                                'sound' => 'default'
                            ]
                        ],
                        'headers' => [
                            'apns-priority' => "10"
                        ]
                    ],
                    'data' => $data,
                ]
            ];

            try {
                $response = $this->client->post($url, [
                    'headers' => $headers,
                    'json' => $notification
                ]);

                $responseBody = json_decode($response->getBody(), true);
                echo 'Notification sent to ' . $token . ': ' . json_encode($responseBody) . PHP_EOL;
            } catch (\Exception $e) {
                throw new \Exception('Error sending notification: ' . $e->getMessage());
            }
        }
    }

    protected function generateAccessToken()
    {
        $now_seconds = time();
        $headers = [
            'alg' => 'RS256',
            'typ' => 'JWT'
        ];

        $payload = [
            'iss' => $this->firebaseKey['client_email'],
            'sub' => $this->firebaseKey['client_email'],
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now_seconds,
            'exp' => $now_seconds + 3600,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging'
        ];

        $jwt = $this->base64UrlEncode(json_encode($headers)) . '.' . $this->base64UrlEncode(json_encode($payload));
        $jwt .= '.' . $this->base64UrlEncode($this->generateSignature($jwt));

        $response = $this->client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ],
        ]);

        $token = json_decode($response->getBody(), true);
        return $token['access_token'];
    }

    protected function generateSignature($data)
    {
        openssl_sign($data, $signature, $this->firebaseKey['private_key'], 'SHA256');
        return $signature;
    }

    protected function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
