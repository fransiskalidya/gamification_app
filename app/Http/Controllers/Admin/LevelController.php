<?php

namespace App\Http\Controllers\Admin;
use App\Models\Level;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = Level::all();

        return view('admin.level.index', compact('level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all()->pluck("course_name", "id")->toArray();
        return view('admin.level.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $level = Level::create([
            'name'  => $request->name,
            'description'   => $request->description,
            'course_id'     => $request->course_id,
        ]);

        return redirect(route('admin.level.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = Level::find($id);
        $courses = Course::all()->pluck("course_name", "id")->toArray();
        return view('admin.level.edit', compact('level','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $level = Level::find($id);
        $level->name   = $request->name;
        $level->description = $request->description;
        $level->course_id   = $request->course_id;
        $level->save();

        Flash::success('Level updated successfully.');

        return redirect(route('admin.level.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::firstwhere('id', $id);
        $level->delete();

        Flash::success('Level delated successfully.');

        return redirect(route('admin.level.index'));
        
    }
}
