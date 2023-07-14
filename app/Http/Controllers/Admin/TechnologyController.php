<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{

    // Validations
    protected $validations = [
        'name' => 'required|max:40|unique:technologies',
    ];

    protected $validation_messages = [
        'required'   => ':attribute is a required field',
        'max'        => ':attribute must be less than :max characters long',
        'unique'     => 'This technology already exists.',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::paginate(10);
        return view('admin.technologies.index', ['technologies' => $technologies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create');
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

        $newTechnology = new Technology();

        $newTechnology->name = $data['name'];

        $newTechnology->save();

        return redirect()->route('admin.technologies.show', ['technology' => $newTechnology])->with('create_success', $newTechnology);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', ['technology' => $technology]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', ['technology' => $technology]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        // Validate Data
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // Update Data
        $updated = $technology->update([
            'name' => $data['name'],
        ]);

        $technology->projects()->sync($data['projects'] ?? []);

        return redirect()->route('admin.technologies.show', ['technology' => $technology])->with('update_success', $technology);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        // Detach all related projects first
        $technology->projects()->detach();

        // Then delete the technology
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('delete_success', $technology);
    }
}
