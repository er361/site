<?php

namespace App\Http\Controllers;

use App\Services\JsonRpcClient;
use Illuminate\Http\Request;


class SiteController extends Controller
{

    protected $client;

    public function __construct(JsonRpcClient $client)
    {
        $this->client = $client;
    }

    public function userBalance(Request $request)
    {
        $this->validate($request,['user_id ' => 'requried']);

        $res = $this->client->send('balance.userBalance',
            ['user_id' => $request->get('user_id')]
        );
        return $res;
    }

    public function userBalanceHistory(Request $request)
    {
        $res = $this->client->send('balance.history', ['limit' => $request->get('limit')]);
        return $res;
    }
}
