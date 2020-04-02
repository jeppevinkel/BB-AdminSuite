<?php

namespace App\Http\Controllers;

use App\ServerAccount;
use Exception;
use Illuminate\Http\Request;

class ServerTokenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws Exception
     */
    public function store(Request $request, ServerAccount $serverAccount)
    {
        if (!$serverAccount) {
            throw new Exception('Specified server account id doesn\'t exist!');
        }

        $serverToken = $serverAccount->createServerToken();

        $jsonResponse = [
            'message' => 'Token successfully created.',
            'server_token' => $serverToken->token,
        ];

        return redirect(route('accounts.show', ['serverAccount' => $serverAccount]));
    }
}
