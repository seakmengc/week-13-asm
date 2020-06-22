<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;

class PostApiController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/posts",
     *     summary="Get post list",
     *     tags={"Post"},
     *     description="Get post list",
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
     *          description="Filter by post title",
     *          type="string",
     *          required=false,
     *          in="query"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Post list",
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
     *          response=500,
     *          description="Server Error"
     *     )
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('name')) {
            $posts = Post::where('name', 'LIKE', '%' . $request->get('name') . '%')->get();
        } else {
            $posts = Post::get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Post list',
            'data' => $posts->toArray()
        ]);
    }

    /**
     * @param PostRequest $request
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
     *          type="integer",
     *          required=true,
     *          in="formData"
     *     ),
     *     @SWG\Parameter(
     *          name="content",
     *          description="content",
     *          type="string",
     *          required=true,
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
     *          property="post",
     *          type="object",
     *          ref="#/definitions/Post"
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
    public function store(PostRequest $request)
    {
        $input = $request->validated();

        $post = Post::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Post was stored successfully.',
            'data' => new PostResource($post)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/posts/{id}",
     *     summary="Show post",
     *     tags={"Post"},
     *     description="Show post",
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
     *          name="id",
     *          description="id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Post was shown successfully.",
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
     *          response=500,
     *          description="Server Error"
     *     )
     * )
     */
    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category was shown successfully.',
            'data' => new PostResource($post)
        ]);
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Put(
     *     path="/posts/{id}",
     *     summary="Update post",
     *     tags={"Post"},
     *     description="Update post",
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
     *          name="id",
     *          description="post id",
     *          type="integer",
     *          required=true,
     *          in="path"
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
     *          name="content",
     *          description="content",
     *          type="string",
     *          required=true,
     *          in="formData"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Post was updated successfully.",
     *
     *      @SWG\Schema(
     *        type="object",
     *        @SWG\Property(
     *           property="success",
     *           type="boolean"
     *        ),
     *        @SWG\Property(
     *          property="data",
     *          type="post",
     *          ref="#/definitions/Post"
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
    public function update(Post $post, PostRequest $request)
    {
        $input = $request->validated();

        $post->fill($input);
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post was updated successfully.',
            'data' => new PostResource($post)
        ]);
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Delete(
     *     path="/posts/{id}",
     *     summary="Delete post",
     *     tags={"Post"},
     *     description="Delete post",
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
     *          name="id",
     *          description="post id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Post was deleted successfully.",
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
     *        ),
     *        @SWG\Property(
     *          property="message",
     *          type="string"
     *        )
     *     )
     *   ),
     *
     *
     *     @SWG\Response(
     *          response=500,
     *          description="Server Error"
     *     )
     * )
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post was deleted successfully.',
            'data' => []
        ]);
    }
}
