<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoteResource::collection(
            Note::where('user_id','=',Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $request->validated($request->all());

        $note = Note::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content
        ]);
        return new NoteResource($note);
    }



    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return  $this->isNotAuth($note) ? $this->isNotAuth($note) : new NoteResource($note) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if($this->isNotAuth($note))
        return $this->isNotAuth($note);

        $note->update($request->all());
        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        return  $this->isNotAuth($note) ? $this->isNotAuth($note) : $note->delete() ;
    }

    /**
     * Search for the specified resource from storage.
     */
    public function search($title)
    {
        return Note::where('title','like','%'.$title.'%')->get();
    }

    /**
     * Check if user is authorized.
     */
    public function isNotAuth (Note $note) {
        if(Auth::user()->id !== $note->user_id)
        return Response(['message' => 'Unauthorized'],403);
    }


}
