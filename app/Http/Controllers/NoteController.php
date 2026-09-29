<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notes()->latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        auth()->user()->notes()->create($request->only('title', 'content'));

        return redirect()->route('notes.index')->with('status', 'Nota creada correctamente.');
    }

    public function edit(Note $note)
    {
        abort_if($note->user_id !== auth()->id(), 403);
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        abort_if($note->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update($request->only('title', 'content'));

        return redirect()->route('notes.index')->with('status', 'Nota actualizada correctamente.');
    }

    public function destroy(Note $note)
    {
        abort_if($note->user_id !== auth()->id(), 403);
        $note->delete();
        return back()->with('status', 'Nota eliminada.');
    }
}