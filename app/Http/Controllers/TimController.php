<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tim' => Tim::all(),
        ];

        return view('tim.index', $data);
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
            'nama'      => 'required|max:255',
            'email'     => 'required|email|unique:tim',
            'no_telp'   =>  'required',
        ]);

        $input = [
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'no_telp' => $validatedData['no_telp'],
        ];

        Tim::create($input);

        return back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tim  $tim
     * @return \Illuminate\Http\Response
     */
    public function show(Tim $tim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tim  $tim
     * @return \Illuminate\Http\Response
     */
    public function edit(Tim $tim)
    {
        $data = [
            'tim' => $tim,
        ];

        return view('tim.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tim  $tim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tim $tim)
    {
        $rules = [
            'nama'      => 'required|max:255',
            'no_telp'   =>  'required',
        ];

        if ($request->email) {
            if ($request->email != $tim->email) {
                $rules['email'] = 'email|unique:tim';
            }
        }

        $validatedData = $request->validate($rules);

        $input = [];

        $input['nama'] = $validatedData['nama'];
        $input['no_telp'] = $validatedData['no_telp'];

        if($request->email != $tim->email){
            $input['email'] = $validatedData['email'];
        }

        $tim->update($input);

        return redirect(route('tim.index'))->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tim  $tim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tim $tim)
    {
        $tim->delete();

        return back()->with('success', 'Berhasil menghapus data');
    }
}
