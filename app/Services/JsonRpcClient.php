<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class JsonRpcClient
{
    const JSON_RPC_VERSION = '2.0';
    const HOST = 'balance.local/api';

    protected $headers;

    public function __construct()
    {
        $this->headers = [
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => self::HOST
        ];
    }

    public function send(string $method, array $params)
    {
        $response = Http::post(self::HOST . '/balance', [
            'jsonrpc' => self::JSON_RPC_VERSION,
            'id' => time(),
            'method' => $method,
            'params' => $params
        ]);

        if ($response->ok())
            return $response->json();
        else
            throw new \Exception($response->body(),$response->status());
    }
}
