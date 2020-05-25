<?php

namespace Modules\User\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base
use Modules\Core\Http\Controllers\Api\CoreApiController;

// Repositories
use Modules\User\Repositories\RoleRepository;

// Transformers
use Modules\User\Transformers\RoleTransformer;

class RoleApiController extends CoreApiController
{

    private $user;

    public function __construct(
        RoleRepository $role
    ){
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        try {

            //Request to Repository
            $roles = $this->role->getItemsBy($this->getParamsRequest($request));

            //Response
            $response = ['data' => RoleTransformer::collection($roles)];

            //If request pagination add meta-page
            $request->page ? $response['meta'] = ['page' => $this->pageTransformer($roles)] : false;


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
            $role = $this->role->getItem($criteria,$this->getParamsRequest($request));

            //Break if no found item
            if (!$role) throw new \Exception('Item not found', 204);

            $response = [
                'data' => $role ? new RoleTransformer($role) : '',
            ];

        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        return response()->json($response, $status ?? 200);
    }


}
