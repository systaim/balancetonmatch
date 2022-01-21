<?php

namespace App\Http\Controllers;

use App\Models\Rencontre;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Rencontre $match)
    {
        // dd($request->all());
        $user = Auth::user();

        $dataComment = $request->validate([
            'type_comments' => ['required'],
            // 'comments' => 'min:3',
            'minute' => 'required',
        ]);

        $dataMatch = $request->validate([
            'home_score' => ['digits:1'],
            'away_score' => ['digits:1'], //'required_without:home_score',
        ]);

        $match->update($dataMatch);

        $dataComment['match_id'] = $match->id;
        // dd($request->all());
        $comment = Commentaire::create($dataComment);
        $comment->user()->associate($user);
        $comment->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $commentaire = Commentaire::find($id);

        if ($commentaire->statistic) {
            if ($commentaire->statistic->action == "goal" && $commentaire->team_action == "home") {
                $commentaire->delete();
                $commentaire->commentator->match->home_score -= 1;
                $commentaire->commentator->match->save();
            } elseif ($commentaire->statistic->action == "goal" && $commentaire->team_action == "away") {
                $commentaire->delete();
                $commentaire->commentator->match->away_score -= 1;
                $commentaire->commentator->match->save();
            }
        } else {
            $commentaire->delete();
        }

        $commentaire->delete();
        return back();
    }

    /**
     * Add a new comment to the store
     * 
     * @OA\Post(
     *     path="/comments",
     *     tags={"comment"},
     *     operationId="addComment",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"commentstore_auth": {"write:comments", "read:comments"}}
     *     },
     *     requestBody={"$ref": "http://127.0.0.1:8000/components/requestBodies/Comment"}
     * )
     */
    public function addComment()
    {
    }

    /**
     * Update an existing comment
     *
     * @OA\Put(
     *     path="/comments",
     *     tags={"comment"},
     *     operationId="updateComment",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     security={
     *         {"commentstore_auth": {"write:comments", "read:comments"}}
     *     },
     *     requestBody={"$ref": "http://127.0.0.1:8000/components/requestBodies/Comment"}
     * )
     */
    public function updateComment()
    {
    }

    /**
     * @OA\Get(
     *     path="/comments/{commentId}",
     *     tags={"comment"},
     *     summary="Find comment by ID",
     *     description="Returns a single comment",
     *     operationId="getCommentById",
     *     @OA\Parameter(
     *         name="commentId",
     *         in="path",
     *         description="ID of comment to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="http://127.0.0.1:8000/components/schemas/Comment"),
     *         @OA\XmlContent(ref="http://127.0.0.1:8000/components/schemas/Comment"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplier"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     *
     * @param int $id
     */
    public function getCommentById($id)
    {
    }

    /**
     * @OA\Post(
     *     path="/comment/{commentId}",
     *     tags={"comment"},
     *     summary="Updates a comment in the store with form data",
     *     operationId="updateCommentWithForm",
     *     @OA\Parameter(
     *         name="commentId",
     *         in="path",
     *         description="ID of comment that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"commentstore_auth": {"write:comments", "read:comments"}}
     *     },
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Updated name of the comment",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     description="Updated status of the comment",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function updateCommentWithForm()
    {
    }

    /**
     * @OA\Delete(
     *     path="/comment/{commentId}",
     *     tags={"comment"},
     *     summary="Deletes a comment",
     *     operationId="deleteComment",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="commentId",
     *         in="path",
     *         description="Comment id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found",
     *     ),
     *     security={
     *         {"commentstore_auth": {"write:comments", "read:comments"}}
     *     },
     * )
     */
    public function deleteComment()
    {
    }

    /**
     * @OA\Post(
     *     path="/comment/{commentId}/uploadImage",
     *     tags={"comment"},
     *     summary="uploads an image",
     *     operationId="uploadFile",
     *     @OA\Parameter(
     *         name="commentId",
     *         in="path",
     *         description="ID of comment to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="http://127.0.0.1:8000/components/schemas/ApiResponse")
     *     ),
     *     security={
     *         {"commentstore_auth": {"write:pets", "read:pets"}}
     *     },
     *     @OA\RequestBody(
     *         description="Upload images request body",
     *         @OA\MediaType(
     *             mediaType="application/octet-stream",
     *             @OA\Schema(
     *                 type="string",
     *                 format="binary"
     *             )
     *         )
     *     )
     * )
     */
    public function uploadFile()
    {
    }
}
