<?php

namespace Modules\User\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base
use Illuminate\Routing\Controller;

// Entities
use App\User;

// Transformers
use Modules\User\Transformers\UserTransformer;

class UserApiController extends Controller
{

    private $user;

    public function __construct(
        User $user
    ){
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        try {

            //Request to Repository
            $users = $this->user->all();

            //Response
            $response = ['data' => UserTransformer::collection($users)];


        } catch (\Exception $e) {

            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];

        }

        return response()->json($response, $status ?? 200);

    }

     /** SHOW
   * @param Request $request
   *  URL GET:
   *  &fields = type string
   *  &include = type string
   */
    public function show($criteria, Request $request)
    {
        try {
            //Request to Repository
            $user = $this->user->find($criteria);

            //Break if no found item
            if (!$user) throw new \Exception('Item not found', 204);

            $response = [
                'data' => $user ? new UserTransformer($user) : '',
            ];

        } catch (\Exception $e) {
            \Log::error($e);
            //$status = $this->getStatusError($e->getCode());
            $status = $e->getCode();
            $response = ["errors" => $e->getMessage()];
        }
        return response()->json($response, $status ?? 200);
    }


}
