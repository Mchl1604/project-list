<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required|in:Pending,Ongoing,Completed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required|in:LOW,MEDIUM,HIGH',
        ]);
        $data['user_id'] = Auth::id();
        
        if (Project::create($data)){
            return redirect('/projects')->with('success', 'Project created successfully!');
        }
        
    }
}
