<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/categories",
     *     summary="Get category list",
     *     tags={"Category"},
     *     description="Get category list",
     *     produces={"application/json"},
     *
     *     @SWG\Parameter(
     *          name="name",
     *          description="Filter by category name",
     *          type="string",
     *          required=false,
     *          in="query"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Category list",
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
     *            property="category",
     *            type="array",
     *            @SWG\Items(ref="#/definitions/Category")
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
    public function index(Request $request)
    {
        if ($request->has('name')) {
            $categories = Category::where('name', 'LIKE', '%' . $request->get('name') . '%')->get();
        } else {
            $categories = Category::get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Category list',
            'data' => $categories->toArray()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/categories",
     *     summary="Create new category",
     *     tags={"Category"},
     *     description="Create new category",
     *     produces={"application/json"},
     *
     *     @SWG\Parameter(
     *          name="name",
     *          description="name",
     *          type="string",
     *          required=true,
     *          in="formData"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Category was stored successfully.",
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
     *            property="category",
     *            type="array",
     *            @SWG\Items(ref="#/definitions/Category")
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
            'name' => 'required|min:3|max:35'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required field',
                'data' => $input
            ], 400);
        }

        $category = Category::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Category was stored successfully.',
            'data' => $category
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/categories/{id}",
     *     summary="Show category",
     *     tags={"Category"},
     *     description="Show category",
     *     produces={"application/json"},
     *
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
     *      description="Category was shown successfully.",
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
     *            property="category",
     *            type="array",
     *            @SWG\Items(ref="#/definitions/Category")
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
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category was shown successfully.',
            'data' => $category
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Put(
     *     path="/categories/{id}",
     *     summary="Update category",
     *     tags={"Category"},
     *     description="Update category",
     *     produces={"application/json"},
     *
     *     @SWG\Parameter(
     *          name="id",
     *          description="id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *     ),
     * 
     *     @SWG\Parameter(
     *          name="name",
     *          description="name",
     *          type="string",
     *          required=true,
     *          in="formData"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Category was updated successfully.",
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
     *            property="category",
     *            type="array",
     *            @SWG\Items(ref="#/definitions/Category")
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
    public function update(Category $category, Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|min:3|max:35'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required field',
                'data' => $input
            ]);
        }

        $category->fill($input);
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category was updated successfully.',
            'data' => $category
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Delete(
     *     path="/categories/{id}",
     *     summary="Delete category",
     *     tags={"Category"},
     *     description="Delete category",
     *     produces={"application/json"},
     *
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
     *      description="Category was deleted successfully.",
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
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category was deleted successfully.',
            'data' => []
        ]);
    }
}
