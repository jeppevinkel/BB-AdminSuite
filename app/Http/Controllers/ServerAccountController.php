<?php

namespace App\Http\Controllers;

use App\ServerAccount;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ServerAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * @return Factory|View
     */
    public function create()
    {
        return view('server_accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $serverAccount = ServerAccount::createNew(Auth::user()->getAuthIdentifier(), $validatedData['name'], 0);
        } catch (\Exception $e) {
            throw $e;
        }

        return redirect(route('accounts.show', ['serverAccount' => $serverAccount]));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ServerAccount $serverAccount
     * @return Factory|View
     */
    public function show(ServerAccount $serverAccount)
    {
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
     * @param Request $request
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
