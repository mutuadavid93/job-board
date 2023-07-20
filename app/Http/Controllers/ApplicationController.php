<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Joblisting, Application};

class ApplicationController extends Controller
{
    public function apply(Joblisting $joblisting)
    {
        return Inertia::render("SubmitApplication", [
            "captcha_img" => captcha_img(),
            "joblisting" => $joblisting
        ]);
    }

    public function store(Request $request, Joblisting $joblisting)
    {
        $request->validate([
            'fullname' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'phone' => 'required|digits_between:10,15',
            'portfolio_link' => 'nullable|url',
            'captcha' => 'required|captcha',
            "attached_cv" => "required|mimes:pdf,doc,docx"
        ]);

        $file = $request->file("attached_cv");
        $destination = "cvs";
        // Store in 'storage/app' directory
        $filePath = $file->store($destination);

        // Save record into database
        $application = new Application();
        $application->fullname = $request->input('fullname');
        $application->email = $request->input('email');
        $application->phone = $request->input('phone');
        $application->portfolio_link = $request->input('portfolio_link');
        $application->attached_cv = $filePath;

        // Set the joblisting_id from the route parameter
        $application->joblisting_id = $joblisting->id;
        $application->save();

        // TODO: Redirect to Thank You page.
        return Redirect::route('thankyou');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha_img' => captcha_img()]);
    }
}
