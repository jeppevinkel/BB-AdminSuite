<?php

namespace App\Http\Controllers;

use App\Rank;
use App\ServerAccount;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ServerAccount $serverAccount)
    {
        return view('server-account-ranks', ['serverAccount' => $serverAccount]);
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
    public function show(RankController $rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(RankController $rank)
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
    public function update(Request $request, RankController $rank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(RankController $rank)
    {
        //
    }
}
