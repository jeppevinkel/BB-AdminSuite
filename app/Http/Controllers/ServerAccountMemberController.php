<?php

namespace App\Http\Controllers;

use App\Role;
use App\ServerAccount;
use App\ServerAccountMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServerAccountMemberController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ServerAccount $serverAccount)
    {
        return view('server-account-members', ['serverAccount' => $serverAccount, 'members' => $serverAccount->serverAccountMembers()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\ServerAccount $serverAccount
     * @param ServerAccountMember $serverAccountMember
     * @return array
     */
    public function update(Request $request, ServerAccount $serverAccount, ServerAccountMember $serverAccountMember)
    {
        $validatedData = $request->validate([
            'roles' => 'required|string',
        ]);

        $myRole = Auth::user()->getServerRole($serverAccount->id);

        if (($myRole->hasPermission('member_role_set') && $myRole->id < $serverAccountMember->role->id && $myRole->id < $validatedData['roles']) || $myRole->hasPermission('member_role_set_unlimited')) {
            $serverAccountMember->role_id = Role::all()->find($validatedData['roles'])->id;
            $serverAccountMember->save();
            return ['message' => 'success'];
        }

        return ['error' => 'insufficient permissions.'];
    }
}
