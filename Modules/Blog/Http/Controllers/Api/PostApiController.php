<?php

namespace Modules\Blog\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base
use Modules\Core\Http\Controllers\Api\CoreApiController;

// Repositories
use Modules\Blog\Repositories\PostRepository;

// Transformers
use Modules\Blog\Transformers\PostTransformer;

class PostApiController extends CoreApiController
{

    private $post;

    public function __construct(
        PostRepository $post
    ){
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        try {

            //Request to Repository
            $posts = $this->post->getItemsBy($this->getParamsRequest($request));

            //Response
            $response = ['data' => PostTransformer::collection($posts)];

            //If request pagination add meta-page
            $request->page ? $response['meta'] = ['page' => $this->pageTransformer($posts)] : false;


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
            $post = $this->post->getItem($criteria,$this->getParamsRequest($request));

            //Break if no found item
            if (!$post) throw new \Exception('Item not found', 204);

            $response = [
                'data' => $post ? new PostTransformer($post) : '',
            ];

        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        return response()->json($response, $status ?? 200);
    }



}
