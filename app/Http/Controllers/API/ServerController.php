<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Player;
use App\Server;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Server[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Server::all();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $apiToken = Str::random(60);

        $validatedData = $request->validate([
            'ip' => 'required|ipv4',
            'port' => 'required|port',
            'info' => 'required|string',
            'pastebin' => 'required|string',
            'status' => 'required|string',
            'cur_players' => 'required|numeric|integer',
            'max_players' => 'required|numeric|integer',
            'server_version' => 'required|string|version',
            'exiled_version' => 'required|string|version',
            'options' => 'required|numeric|integer|max:65535',
            'server_token' => 'sometimes|string',
        ]);

        DB::beginTransaction();

        try {
            $server = Server::firstOrCreate([
                'ip' => $validatedData['ip'],
                'port' => $validatedData['port'],
            ],
                [
                    'info' => $validatedData['info'],
                    'pastebin' => $validatedData['pastebin'],
                    'status' => $validatedData['status'],
                    'cur_players' => $validatedData['cur_players'],
                    'max_players' => $validatedData['max_players'],
                    'server_version' => $validatedData['server_version'],
                    'exiled_version' => $validatedData['exiled_version'],
                    'options' => $validatedData['options'],
                    'api_token' => $apiToken,
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if (array_key_exists('server_token', $validatedData) && $server->wasRecentlyCreated) {
            try {
                $server->linkServer($validatedData['server_token']);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }

        DB::commit();

        if ($server->wasRecentlyCreated)
        {
            $jsonResponse = [
                'message' => 'Server successfully added.',
                'api_token' => $apiToken,
                'server_id' => $server->id,
            ];
        }
        else
        {
            $jsonResponse = [
                'message' => 'Server already exists.',
                'errors' => [
                    'duplicate' => [
                        'A server entry already exists for this ip/port combination.',
                    ],
                ]
            ];
        }

        return response()->json($jsonResponse);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Server $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        return $server;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Server $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Server $server
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Server $server)
    {
        if ($server != Auth::user()) {
            $jsonResponse = [
                'message' => 'No access.',
                'errors' => [
                    'denied' => [
                        'You can\'t modify other servers.',
                    ],
                ]
            ];

            return response()->json($jsonResponse);
        }

        $validatedData = $request->validate([
            'ip' => 'required|ipv4',
            'port' => 'required|port',
            'info' => 'required|string',
            'pastebin' => 'required|string',
            'status' => 'required|string',
            'cur_players' => 'required|numeric|integer',
            'max_players' => 'required|numeric|integer',
            'server_version' => 'required|string|version',
            'exiled_version' => 'required|string|version',
            'options' => 'required|numeric|integer|max:65535',
            'newPlayers' => 'sometimes|required|JSON',
        ]);

        try {
            $server->update([
                'ip' => $validatedData['ip'],
                'port' => $validatedData['port'],
                'info' => $validatedData['info'],
                'pastebin' => $validatedData['pastebin'],
                'status' => $validatedData['status'],
                'cur_players' => $validatedData['cur_players'],
                'max_players' => $validatedData['max_players'],
                'server_version' => $validatedData['server_version'],
                'exiled_version' => $validatedData['exiled_version'],
                'options' => $validatedData['options'],
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

        try {
            if (array_key_exists('newPlayers', $validatedData)) {
                foreach (json_decode($validatedData['newPlayers'], true) as $playerData) {
                    $player = Player::firstOrCreate([
                        'id' => $playerData['id'],
                        'id_type' => $playerData['id_type'],
                    ],
                        [
                            'username' => $playerData['username'],
                        ]);
                    if (!$player->servers->contains($server)) {
                        $player->servers()->attach($server);
                    } else {
                        $player->servers->find($server)->pivot->touch();
                    }
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }

        $jsonResponse = [
            'message' => 'Server successfully updated.',
        ];

        $jsonResponse['members'] = [];
        $jsonResponse['ranks'] = [];

        return response()->json($jsonResponse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Server $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        //
    }
}
