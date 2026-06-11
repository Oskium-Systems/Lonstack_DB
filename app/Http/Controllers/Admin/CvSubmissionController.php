<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvSubmissionController extends Controller
{
  public function index()
  {
    $submissions = CvSubmission::latest()->paginate(20);
    return view('admin.cv-submissions.index', compact('submissions'));
  }

  public function updateStatus(Request $request, CvSubmission $submission)
  {
    $request->validate([
      'status' => ['required', 'in:new,reviewed,shortlisted,rejected'],
    ]);

    $submission->update([
      'status'      => $request->input('status'),
      'admin_notes' => $request->input('admin_notes'),
    ]);

    return response()->json([
      'success'      => true,
      'message'      => 'Status updated.',
      'status'       => $submission->status,
      'status_label' => $submission->status_label,
      'status_color' => $submission->status_color,
    ]);
  }

  public function destroy(CvSubmission $submission)
  {
    // Delete the file from storage
    if (Storage::disk('public')->exists($submission->cv_path)) {
      Storage::disk('public')->delete($submission->cv_path);
    }

    $submission->delete();

    return response()->json([
      'success' => true,
      'message' => 'Submission deleted.',
    ]);
  }

  public function download(CvSubmission $submission)
  {
    $path = storage_path('app/public/' . $submission->cv_path);

    if (!file_exists($path)) {
      abort(404, 'File not found.');
    }

    return response()->download($path, $submission->cv_original_name);
  }
}
