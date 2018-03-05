<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PasswordGrantProxyControllerRequest;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\DB;

class PasswordGrantProxyController extends Controller
{
    /**
     * @return mixed
     */
    public function issueToken(PasswordGrantProxyControllerRequest $request)
    {
        $http = new Client;

        $client = DB::table('oauth_clients')->where('id', 2)->first();

//        dump($request->username);
//        dump($request->password);
//        dump($client->redirect);

        $response = $http->post(url('api/v1/oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $request->username,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
