<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::where(['deleted' => false, 'status' => true])->get();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Posts::whereId($id);
        if ($post->exists()) {
            $data = [];
            $data["id"] = $post->first()->id;
            if ($request->has("title")) {
                $data["title"]=$request->title;
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
