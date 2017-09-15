<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerCreateRequest;
use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'store',
            'destroy',
            'getUserServers'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('server.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('server.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServerCreateRequest $request)
    {
        DB::beginTransaction();
        try {

            Server::create($request->except(['rams']))
                ->createMany($request->only(['rams']));

            DB::commit();
            return redirect()->route('user-servers');
        } catch (\Exception $exception) {

            DB::rollback();
            Log::info($exception->getMessage());

            return redirect()
                ->route('create')
                ->withInput()
                ->withErrors(['error' => 'Unable to create server']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $server = Server::with('rams')
            ->where('id', '=', $id)
            ->get();

        if ($server) {
            return view('server.single', ['server' => $server]);
        }

        return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Server::where('id', $id)->delete();
        return redirect()->route('user-servers');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserServers()
    {
        $servers = Auth::user()->servers()->paginate(20);
        return view('server.user-servers', [
            'servers' => $servers
        ]);
    }
}
