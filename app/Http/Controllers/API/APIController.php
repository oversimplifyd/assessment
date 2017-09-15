<?php

namespace App\Http\Controllers\API;

use App\Exceptions\AppError;
use App\Http\Controllers\API\CommonTraits\JSONResponse;
use App\Http\Requests\APIServerCreateRequest;
use App\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class APIController extends Controller
{

    use JSONResponse;

    public function __construct()
    {
        $this->middleware('basic_auth', ['only' => [
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
        $servers = Server::with('rams')->paginate(20);
        return $this->success($servers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(APIServerCreateRequest $request)
    {
        DB::beginTransaction();
        try {

            $server = Server::create(array_merge(
                ['user_id' => Auth::user()->id],
                $request->except(['rams'])
            ));

            $server
                ->rams()
                ->createMany($request['rams']);

            DB::commit();

            return $this->success($server->load('rams'));

        } catch (\Exception $exception) {

            DB::rollback();
            Log::info($exception->getMessage());
            return $this->error(AppError::UNABLE_TO_CREATE_RESOURCE(), 'Unable to Crate Resource');
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
            return $this->success($server);
        }

        return $this->error(AppError::RESOURCE_NOT_FOUND(), 'No such resource');
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
        return $this->success('Server Deleted Successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserServers()
    {
        $userId = Auth::user()->id;
        return $this->success(
            Server::with('rams')
                ->where('user_id', $userId)
                ->paginate(20)
        );
    }
}
