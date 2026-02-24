<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectVisit;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectVisitController extends Controller
{
    public function index(Request $request)
    {
        $query = ProjectVisit::with('project')->orderBy('created_at', 'desc');

        // Filter by project
        if ($request->has('project_id') && $request->project_id) {
            $query->where('project_id', $request->project_id);
        }

        // Filter by date range
        if ($request->has('from_date') && $request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $visits = $query->paginate(20)->withQueryString();
        $projects = Project::where('is_protected', true)->orderBy('title')->get();

        return view('admin.project-visits.index', compact('visits', 'projects'));
    }

    public function destroy(ProjectVisit $projectVisit)
    {
        $projectVisit->delete();

        return redirect()->route('admin.project-visits.index')
            ->with('success', 'Visit record deleted successfully.');
    }
}
