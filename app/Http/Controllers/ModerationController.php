<?php

namespace App\Http\Controllers;

use App\ServerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ServerAccount $serverAccount, $type)
    {
        if ($type == 0) {
            return view('server-account-bans', ['serverAccount' => $serverAccount, 'bans' => $serverAccount->bans()]);
        } else {
            return view('server-account-warnings', ['serverAccount' => $serverAccount, 'warnings' => $serverAccount->warnings()]);
        }
    }
}
