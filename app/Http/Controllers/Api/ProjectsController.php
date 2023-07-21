<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Filtro risultati

        $searchString = $request->query('q', '');

        // Filtro per Type e Technology
        $typeId = $request->query('type');
        $technologyId = $request->query('technology');

        $query = Project::with('type', 'technologies');

        if ($searchString) {
            $query = $query->where('title', 'LIKE', "%${searchString}%");
        }

        if ($typeId) {
            $query->whereHas('type', function ($q) use ($typeId) {
                $q->where('id', $typeId);
            });
        }

        if ($technologyId) {
            $query->whereHas('technologies', function ($q) use ($technologyId) {
                $q->where('id', $technologyId);
            });
        }

        $projects = $query->paginate(6);

        return response()->json([
            'success'   => true,
            'results'   => $projects,
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();

        return response()->json([
            'success'   => $project ? true : false,
            'results'   => $project,
        ]);
    }


    public function random()
    {
        $project = Project::inRandomOrder()->limit(12)->get();

        return response()->json([
            'success'   => true,
            'results'   => $project,
        ]);
    }
}
