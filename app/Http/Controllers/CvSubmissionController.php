<?php

namespace App\Http\Controllers;

use App\Models\CvSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvSubmissionController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'name'     => ['required', 'string', 'max:100'],
      'email'    => ['required', 'email', 'max:150'],
      'phone'    => ['nullable', 'string', 'max:40'],
      'position' => ['nullable', 'string', 'max:200'],
      'message'  => ['nullable', 'string', 'max:1000'],
      'cv_file'  => ['required', 'file', 'mimes:pdf,doc,docx', 'max:8192'],
    ]);

    $file     = $request->file('cv_file');
    $origName = $file->getClientOriginalName();
    $path     = $file->store('cv-submissions', 'public');

    CvSubmission::create([
      'name'             => $request->input('name'),
      'email'            => $request->input('email'),
      'phone'            => $request->input('phone'),
      'position'         => $request->input('position') ?: 'Open Application',
      'message'          => $request->input('message'),
      'cv_path'          => $path,
      'cv_original_name' => $origName,
      'cv_mime'          => $file->getMimeType(),
      'cv_size'          => $file->getSize(),
    ]);

    return response()->json([
      'success' => true,
      'message' => 'Your CV has been submitted! We\'ll be in touch.',
    ]);
  }
}
