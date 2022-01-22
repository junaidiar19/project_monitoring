<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tim;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::with(['leader', 'tugas'])->get();

        $data = [
            'project' => $project,
            'tim' => Tim::all(),
        ];

        return view('project.index', $data);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'      => 'required',
            'client'    =>  'required',
            'leader'    =>  'required',
            'start'     => 'required|date|before:end',
            'end'       => 'required|date|after:start',
        ]);

        $input = [
            'nama' => $validatedData['nama'],
            'client' => $validatedData['client'],
            'leader_id' => $validatedData['leader'],
            'tanggal_mulai' => $validatedData['start'],
            'tanggal_selesai' => $validatedData['end'],
        ];

        Project::create($input);

        return back()->with('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $data = [
            'project' => $project->load(['leader']),
            'tim' => Tim::all(),
        ];

        return view('project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'nama'      => 'required',
            'client'    =>  'required',
            'leader'    =>  'required',
            'start'     => 'required|date|before:end',
            'end'       => 'required|date|after:start',
        ]);

        $input = [
            'nama' => $validatedData['nama'],
            'client' => $validatedData['client'],
            'leader_id' => $validatedData['leader'],
            'tanggal_mulai' => $validatedData['start'],
            'tanggal_selesai' => $validatedData['end'],
        ];

        $project->update($input);

        return redirect(route('project.index'))->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Berhasil menghapus data');
    }
}
