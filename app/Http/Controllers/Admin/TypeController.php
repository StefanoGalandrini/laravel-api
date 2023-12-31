<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    // Validations
    protected $validations = [
        'name'          => 'required|max:20',
        'description'   => 'required|string|max:500',
    ];

    protected $validation_messages = [
        'required'   => ':attribute is a required field',
        'max'        => ':attribute must be less than :max characters long',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        $newType = new Type;

        $newType->name = $data['name'];
        $newType->description = $data['description'];
        $newType->slug = Type::slugger($data['name']);

        $newType->save();

        return redirect()->route('admin.types.index', ['type' => $newType])->with('create_success', $newType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.types.show', ['type' => $type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.types.edit', ['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        // Validate Data
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // Update Data
        $type->name = $data['name'];
        $type->description = $data['description'];
        $type->slug = Type::slugger($data['name']);

        $type->update();

        return redirect()->route('admin.types.show', ['type' => $type])->with('update_success', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();

        foreach ($type->projects as $project) {
            $project->type_id = 1;
            $project->update();
        }

        $type->delete();

        return redirect()->route('admin.types.index')
            ->with('delete_success', $type);
    }
}
