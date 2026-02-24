<?php

namespace App\Http\Controllers;

use App\Models\ClientPassword;
use App\Models\ProjectVisit;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    public function showLogin()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        if (session()->has('client_password_id')) {
            return redirect()->route('home');
        }

        return view('client-login', compact('settings'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find client by name (case-insensitive)
        $clientPassword = ClientPassword::where('is_active', true)
            ->whereRaw('LOWER(name) = ?', [strtolower($request->client_name)])
            ->first();

        if ($clientPassword && Hash::check($request->password, $clientPassword->password)) {
            session([
                'client_password_id' => $clientPassword->id,
                'client_name' => $clientPassword->name,
            ]);

            // Log visits for all assigned projects
            foreach ($clientPassword->projects as $project) {
                ProjectVisit::create([
                    'project_id' => $project->id,
                    'visitor_name' => $clientPassword->name . ' (Client Login)',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }

            return redirect()->route('home')->with('success', 'Welcome, ' . $clientPassword->name . '!');
        }

        return back()->withErrors(['password' => 'Invalid client name or password.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['client_password_id', 'client_name']);
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }
}
