<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    const WRONG_CREDS_ERROR = 'Wrong credentials!';

    /**
     * Update the authenticated user's API token.
     *
     * @return array
     */
    public function updateToken(Request $request)
    {
        $token = Str::random(80);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }

    /**
     * Generate new token for non authenticated user
     *
     * @return array
     */
    public function generateToken(Request $request)
    {
        $token = Str::random(80);
        $isValidUser = auth()->validate($request->toArray());
        auth()->setUser($request->user('api'));

        if ($isValidUser) {
            $request->user()->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();
        } else {
            return ['Error' => self::WRONG_CREDS_ERROR];
        }

        return ['token' => $token];
    }
}
