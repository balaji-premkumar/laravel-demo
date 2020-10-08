<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/post",
     *     summary="Get All Posts",
     *     description="Get All available posts from DB",
     *     operationId="getallposts",
     *     tags={"post"},
     *  @OA\Response(
     *      response = 200,
     *      description = "Returns List of postings"
     *  )
     * )
     *
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Posts::where(['deleted' => false, 'status' => true])->get();
        return response()->json($posts);
    }

    /**
     * @OA\Post(
     *     path="/api/post",
     *     summary="Create a new Posts",
     *     description="Add a posting to DB",
     *     operationId="addapost",
     *     tags={"post"},
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass Post Data",
     *    @OA\JsonContent(
     *       required={"title","description"},
     *       @OA\Property(property="title", type="string"),
     *       @OA\Property(property="description", type="string"),
     *    ),
     *  ),
     *  @OA\Response(
     *      response = 201,
     *      description = "Returns the created post data"
     *  )
     * )
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $post = new Posts();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return response()->json($post, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/post/{id}",
     *     summary="Get a Single Post",
     *     description="Get a posting to DB",
     *     operationId="getapost",
     *     tags={"post"},
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass Post Data",
     *    @OA\JsonContent(
     *       required={"id"},
     *       @OA\Property(property="id", type="integer"),
     *    ),
     *  ),
     *  @OA\Response(
     *      response = 200,
     *      description = "returns a single post data"
     *  )
     * )
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $query = Posts::where(['deleted' => false, 'status' => true, 'id' => $id]);
        $postavail = $query->exists();
        if ($postavail != null) {
            $post = $query->get();
            return response()->json($post);
        } else {
            return response()->json(["message" => "sorry requested post is not found"], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/post",
     *     summary="Update a Post",
     *     description="update a posting to DB",
     *     operationId="updateapost",
     *     tags={"post"},
     *
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass Post Data",
     *    @OA\JsonContent(
     *       required={"title","description"},
     *       @OA\Property(property="title", type="string"),
     *       @OA\Property(property="description", type="string"),
     *    ),
     *  ),
     *  @OA\Response(
     *      response = 200,
     *      description = "returns the updated post data"
     *  )
     * )
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $post = Posts::whereId($id);
        if ($post->exists()) {
            $data = [];
            $data["id"] = $post->first()->id;
            if ($request->has("title")) {
                $data["title"] = $request->title;
            }
            if ($request->has("description")) {
                $data["description"] = $request->description;
            }
            if ($request->has("status")) {
                $data["status"] = $request->status;
            }
            $post = Posts::whereId($id)->update($data);

            return response()->json(["updated_data" => $data]);
        } else {
            return response()->json(["message" => "The given Post ID $id is not available in our datas"]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/post",
     *     summary="Delete a Single Post",
     *     description="Delete a posting to DB",
     *     operationId="deleteapost",
     *     tags={"post"},
     *
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass a post id to delete",
     *    @OA\JsonContent(
     *       required={"id"},
     *       @OA\Property(property="id", type="integer"),
     *    ),
     *  ),
     *  @OA\Response(
     *      response = 200,
     *      description = "returns nothing"
     *  )
     * )
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Posts::find($id);
        if ($post->exists()) {
            $data["deleted"] = true;
            Posts::whereId($id)->update($data);
            return response()->json(["message" => "Post ID: $id is deleted successfully."]);
        } else {
            return response()->json(["message" => "The given Post ID $id is not available in our datas"]);
        }
    }
}
