<?php

namespace App\Http\Controllers;

use App\ServerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ServerAccount $serverAccount
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ServerAccount $serverAccount)
    {
        if (Auth::user()->getServerAccount(1) == null) {
            return view('home');
        }

        return view('server-account', ['serverAccount' => $serverAccount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ServerAccount $serverAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ServerAccount $serverAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ServerAccount $serverAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServerAccount $serverAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ServerAccount $serverAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServerAccount $serverAccount)
    {
        //
    }
}
