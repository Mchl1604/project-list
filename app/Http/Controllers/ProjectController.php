<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $projects = Project::where('user_id', '=', $userId, 'and')->get();

        return view('Pages.projects', ['projects' => $projects]);
    }

    public function store(Request $request)
    {

        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'status' => 'required|in:Pending,Ongoing,Completed,Cancelled',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'priority' => 'required|in:LOW,MEDIUM,HIGH',
            ]);
            $data['user_id'] = Auth::id();

            Project::create($data);
            return redirect('/projects')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            return redirect('/projects')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $project = Project::where('user_id', '=', Auth::id(), 'and')->findOrFail($id);

            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'status' => 'required|in:Pending,Ongoing,Completed,Cancelled',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'priority' => 'required|in:LOW,MEDIUM,HIGH',
            ]);
            $project->update($data);
            return redirect('/projects')->with('success', 'Project updated successfully!');
        } catch (\Exception $e) {
            return redirect('/projects')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::where('user_id', '=', Auth::id(), 'and')->findOrFail($id);

            $project->delete();

            return redirect('/projects')->with('success', 'Project deleted successfully!');
        } catch (\Exception $e) {
            return redirect('/projects')->with('error', $e->getMessage());
        }
    }
}
