<?php

namespace App\Http\Controllers;

use App\Rank;
use App\ServerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankController extends Controller
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
     * @param ServerAccount $serverAccount
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(ServerAccount $serverAccount)
    {
        if (Auth::user()->hasPermission($serverAccount->id, 'rank_view')) {
            return view('server-account-ranks', ['serverAccount' => $serverAccount]);
        } else {
            return redirect(route('accounts.show', ['serverAccount' => $serverAccount]));
        }
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
     * @param \App\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Rank $rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(Rank $rank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rank $rank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rank $rank)
    {
        //
    }
}
