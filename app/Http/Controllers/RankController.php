<?php

namespace App\Http\Controllers;

use App\Rank;
use App\ServerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return view('server_accounts.ranks.index', ['serverAccount' => $serverAccount]);
        } else {
            return redirect(route('accounts.show', ['serverAccount' => $serverAccount]));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ServerAccount $serverAccount)
    {
        if (Auth::user()->hasPermission($serverAccount->id, 'rank_add')) {
            return view('server_accounts.ranks.create', ['serverAccount' => $serverAccount]);
        } else {
            return redirect(route('accounts.ranks.index', ['serverAccount' => $serverAccount]));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(Request $request, ServerAccount $serverAccount)
    {
        if (!Auth::user()->hasPermission($serverAccount->id, 'rank_add')) {
            return redirect(route('accounts.ranks.index', ['serverAccount' => $serverAccount]));
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'color' => 'required|string',
            'text' => 'required|string',
            'kickPower' => 'required|numeric|integer|min:0|max:255',
            'requiredKickPower' => 'required|numeric|integer|min:0|max:255',
            'hidden' => 'required|boolean',
            'KickingAndShortTermBanning' => 'required|numeric|integer',
            'BanningUpToDay' => 'required|numeric|integer',
            'LongTermBanning' => 'required|numeric|integer',
            'ForceclassSelf' => 'required|numeric|integer',
            'ForceclassToSpectator' => 'required|numeric|integer',
            'ForceclassWithoutRestrictions' => 'required|numeric|integer',
            'GivingItems' => 'required|numeric|integer',
            'WarheadEvents' => 'required|numeric|integer',
            'RespawnEvents' => 'required|numeric|integer',
            'RoundEvents' => 'required|numeric|integer',
            'SetGroup' => 'required|numeric|integer',
            'GameplayData' => 'required|numeric|integer',
            'Overwatch' => 'required|numeric|integer',
            'FacilityManagement' => 'required|numeric|integer',
            'PlayersManagement' => 'required|numeric|integer',
            'PermissionsManagement' => 'required|numeric|integer',
            'ServerConsoleCommands' => 'required|numeric|integer',
            'ViewHiddenBadges' => 'required|numeric|integer',
            'ServerConfigs' => 'required|numeric|integer',
            'Broadcasting' => 'required|numeric|integer',
            'PlayerSensitiveDataAccess' => 'required|numeric|integer',
            'Noclip' => 'required|numeric|integer',
            'AFKImmunity' => 'required|numeric|integer',
        ]);

        $permissions = (int)$validatedData['KickingAndShortTermBanning'] | (int)$validatedData['BanningUpToDay'] | (int)$validatedData['LongTermBanning'] | (int)$validatedData['ForceclassSelf'] | (int)$validatedData['ForceclassToSpectator'] | (int)$validatedData['ForceclassWithoutRestrictions'] | (int)$validatedData['GivingItems'] | (int)$validatedData['WarheadEvents'] | (int)$validatedData['RespawnEvents'] | (int)$validatedData['RoundEvents'] | (int)$validatedData['SetGroup'] | (int)$validatedData['GameplayData'] | (int)$validatedData['Overwatch'] | (int)$validatedData['FacilityManagement'] | (int)$validatedData['PlayersManagement'] | (int)$validatedData['PermissionsManagement'] | (int)$validatedData['ServerConsoleCommands'] | (int)$validatedData['ViewHiddenBadges'] | (int)$validatedData['ServerConfigs'] | (int)$validatedData['Broadcasting'] | (int)$validatedData['PlayerSensitiveDataAccess'] | (int)$validatedData['Noclip'] | (int)$validatedData['AFKImmunity'];

        $name = strtolower($validatedData['name']);
        $name = preg_replace("|\s+|", "-", $name);

        DB::beginTransaction();

        try {
            $rank = Rank::firstOrCreate([
                'rank_name' => $name,
                'server_account_id' => $serverAccount->id,
            ],
                [
                    'badge_color' => $validatedData['color'],
                    'badge_text' => $validatedData['text'],
                    'kick_power' => $validatedData['kickPower'],
                    'required_kick_power' => $validatedData['requiredKickPower'],
                    'hidden_by_default' => $validatedData['hidden'],
                    'permissions' => $permissions,
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect(route('accounts.ranks.index', ['serverAccount' => $serverAccount]));
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
    public function edit(ServerAccount $serverAccount, Rank $rank)
    {
        if (Auth::user()->hasPermission($serverAccount->id, 'rank_modify')) {
            return view('server_accounts.ranks.edit', ['serverAccount' => $serverAccount, 'rank' => $rank]);
        } else {
            return redirect()->route('accounts.ranks.index', ['serverAccount' => $serverAccount]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Rank $rank
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ServerAccount $serverAccount, Rank $rank)
    {
        if (!Auth::user()->hasPermission($serverAccount->id, 'rank_modify')) {
            return redirect()->route('accounts.ranks.index', ['serverAccount' => $serverAccount]);
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'color' => 'required|string',
            'text' => 'required|string',
            'kickPower' => 'required|numeric|integer|min:0|max:255',
            'requiredKickPower' => 'required|numeric|integer|min:0|max:255',
            'hidden' => 'required|boolean',
            'KickingAndShortTermBanning' => 'required|numeric|integer',
            'BanningUpToDay' => 'required|numeric|integer',
            'LongTermBanning' => 'required|numeric|integer',
            'ForceclassSelf' => 'required|numeric|integer',
            'ForceclassToSpectator' => 'required|numeric|integer',
            'ForceclassWithoutRestrictions' => 'required|numeric|integer',
            'GivingItems' => 'required|numeric|integer',
            'WarheadEvents' => 'required|numeric|integer',
            'RespawnEvents' => 'required|numeric|integer',
            'RoundEvents' => 'required|numeric|integer',
            'SetGroup' => 'required|numeric|integer',
            'GameplayData' => 'required|numeric|integer',
            'Overwatch' => 'required|numeric|integer',
            'FacilityManagement' => 'required|numeric|integer',
            'PlayersManagement' => 'required|numeric|integer',
            'PermissionsManagement' => 'required|numeric|integer',
            'ServerConsoleCommands' => 'required|numeric|integer',
            'ViewHiddenBadges' => 'required|numeric|integer',
            'ServerConfigs' => 'required|numeric|integer',
            'Broadcasting' => 'required|numeric|integer',
            'PlayerSensitiveDataAccess' => 'required|numeric|integer',
            'Noclip' => 'required|numeric|integer',
            'AFKImmunity' => 'required|numeric|integer',
        ]);

        $permissions = (int)$validatedData['KickingAndShortTermBanning'] | (int)$validatedData['BanningUpToDay'] | (int)$validatedData['LongTermBanning'] | (int)$validatedData['ForceclassSelf'] | (int)$validatedData['ForceclassToSpectator'] | (int)$validatedData['ForceclassWithoutRestrictions'] | (int)$validatedData['GivingItems'] | (int)$validatedData['WarheadEvents'] | (int)$validatedData['RespawnEvents'] | (int)$validatedData['RoundEvents'] | (int)$validatedData['SetGroup'] | (int)$validatedData['GameplayData'] | (int)$validatedData['Overwatch'] | (int)$validatedData['FacilityManagement'] | (int)$validatedData['PlayersManagement'] | (int)$validatedData['PermissionsManagement'] | (int)$validatedData['ServerConsoleCommands'] | (int)$validatedData['ViewHiddenBadges'] | (int)$validatedData['ServerConfigs'] | (int)$validatedData['Broadcasting'] | (int)$validatedData['PlayerSensitiveDataAccess'] | (int)$validatedData['Noclip'] | (int)$validatedData['AFKImmunity'];

        $name = strtolower($validatedData['name']);
        $name = preg_replace("|\s+|", "-", $name);

        DB::beginTransaction();

        try {
            $rank->update(
                [
                    'rank_name' => $name,
                    'server_account_id' => $serverAccount->id,
                    'badge_color' => $validatedData['color'],
                    'badge_text' => $validatedData['text'],
                    'kick_power' => $validatedData['kickPower'],
                    'required_kick_power' => $validatedData['requiredKickPower'],
                    'hidden_by_default' => $validatedData['hidden'],
                    'permissions' => $permissions,
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('accounts.ranks.index', ['serverAccount' => $serverAccount]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServerAccount $serverAccount, Rank $rank)
    {
        if (!Auth::user()->hasPermission($serverAccount->id, 'rank_remove')) {
            return back();
        }
        $rank->delete();

        return response()->redirectToRoute('accounts.ranks.index', ['serverAccount' => $serverAccount]);
    }
}
