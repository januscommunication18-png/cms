<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ContactController extends Controller
{
    public function index()
    {
        $settings = [
            'site_title' => SiteSetting::get('site_title', 'Rohit Philip'),
            'linkedin_url' => SiteSetting::get('linkedin_url', '#'),
            'email' => SiteSetting::get('email', 'hello@example.com'),
        ];

        // Generate captcha
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $captcha = [
            'num1' => $num1,
            'num2' => $num2,
            'answer' => Crypt::encryptString((string)($num1 + $num2)),
        ];

        return view('contact', compact('settings', 'captcha'));
    }

    public function send(Request $request)
    {
        // Validate captcha first
        $captchaAnswer = $request->input('captcha');
        $encryptedAnswer = $request->input('captcha_answer');

        try {
            $correctAnswer = Crypt::decryptString($encryptedAnswer);
            if ((string)$captchaAnswer !== $correctAnswer) {
                return back()->withInput()->withErrors(['captcha' => 'Incorrect answer. Please try again.']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['captcha' => 'Verification failed. Please try again.']);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Here you could send an email or store the message
        // For now, we just redirect with a success message

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! I will get back to you soon.');
    }
}
