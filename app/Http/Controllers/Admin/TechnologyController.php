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
        $newTechnology->slug = Technology::slugger($data['name']);

        $newTechnology->save();

        return redirect()->route('admin.technologies.show', ['technology' => $newTechnology])->with('create_success', $newTechnology);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.show', ['technology' => $technology]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.edit', ['technology' => $technology]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();

        // Validate Data
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // Update Data
        $technology->name = $data['name'];
        $technology->slug = Technology::slugger($data['name']);
        $technology->update();

        $technology->projects()->sync($data['projects'] ?? []);

        return redirect()->route('admin.technologies.show', ['technology' => $technology])->with('update_success', $technology);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();

        // Detach all related projects first
        $technology->projects()->detach();

        // Then delete the technology
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('delete_success', $technology);
    }
}
