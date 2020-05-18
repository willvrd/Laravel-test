<?php

namespace Modules\User\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base
use Modules\Core\Http\Controllers\Api\CoreApiController;

// Entities
use App\User;

// Repositories
use Modules\User\Repositories\UserRepository;

// Transformers
use Modules\User\Transformers\UserTransformer;

class UserApiController extends CoreApiController
{

    private $user;

    public function __construct(
        UserRepository $user
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
            $users = $this->user->getItemsBy($this->getParamsRequest($request));

            //Response
            $response = ['data' => UserTransformer::collection($users)];

            //If request pagination add meta-page
            $request->page ? $response['meta'] = ['page' => $this->pageTransformer($users)] : false;


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
            $user = $this->user->getItem($criteria,$this->getParamsRequest($request));

            //Break if no found item
            if (!$user) throw new \Exception('Item not found', 204);

            $response = [
                'data' => $user ? new UserTransformer($user) : '',
            ];

        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        return response()->json($response, $status ?? 200);
    }


}
