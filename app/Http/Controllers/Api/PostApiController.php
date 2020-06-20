<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;

class PostApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/posts",
     *     summary="Create new post",
     *     tags={"Post"},
     *     description="Create new post",
     *     produces={"application/json"},
     *
     *     @SWG\Parameter(
     *          name="Authorization",
     *          description="Provide in header request: Authorization: Bearer ACCESS_TOKEN",
     *          type="string",
     *          required=true,
     *          in="header"
     *     ),
     *     @SWG\Parameter(
     *          name="title",
     *          description="title",
     *          type="string",
     *          required=true,
     *          in="formData"
     *     ),
     *     @SWG\Parameter(
     *          name="category_id",
     *          description="category_id",
     *          type="string",
     *          required=true,
     *          in="formData"
     *     ),
     *     @SWG\Parameter(
     *          name="author",
     *          description="author",
     *          type="string",
     *          required=false,
     *          in="formData"
     *     ),
     *     @SWG\Parameter(
     *          name="content",
     *          description="content",
     *          type="string",
     *          required=false,
     *          in="formData"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Post was stored successfully.",
     *
     *      @SWG\Schema(
     *        type="object",
     *        @SWG\Property(
     *           property="success",
     *           type="boolean"
     *        ),
     *        @SWG\Property(
     *          property="data",
     *          type="object",
     *          @SWG\Property(
     *            property="post",
     *            type="array",
     *            @SWG\Items(ref="#/definitions/Post")
     *          ),
     *        ),
     *        @SWG\Property(
     *          property="message",
     *          type="string"
     *        )
     *     )
     *   ),
     *
     *     @SWG\Response(
     *          response=400,
     *          description="Missing required field"
     *     ),
     *
     *     @SWG\Response(
     *          response=500,
     *          description="Server Error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_id' => 'required',
            'title' => 'required|min:3|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required field',
                'data' => $input
            ]);
        }

        $user = $request->user();
        $input['creator_id'] = $user->id;

        $post = Post::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Post was stored successfully.',
            'data' => $post
        ]);
    }
}
