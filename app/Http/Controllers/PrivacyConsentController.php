<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PrivacyConsent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class PrivacyConsentController extends Controller
{
    public function accept(Request $request)
    {
        $guid = Str::uuid();
        $version = 1;
        $timestamp = now();
    
        PrivacyConsent::create([
            'guid' => $guid,
            'accepted_at' => $timestamp,
            'version' => $version,
        ]);
    
        $cookieData = json_encode([
            'guid' => $guid,
            'accepted_at' => $timestamp->toDateTimeString(),
            'version' => $version,
            'status' => 'accepted',
        ]);
    
        // 👇 Make the cookie accessible to JavaScript (HttpOnly = false)
        $cookie = Cookie::make('privacy_consent', $cookieData, 60 * 24 * 365, '/', null, false, false);
    
        return response()->json(['message' => 'Consent accepted'])
            ->cookie($cookie);
    }
    
    // Decline
    public function decline(Request $request)
    {
        $timestamp = now();
    
        $cookieData = json_encode([
            'declined_at' => $timestamp->toDateTimeString(),
            'status' => 'declined',
        ]);
    
        // 👇 Also make decline cookie visible to JS
        $cookie = Cookie::make('privacy_decline', $cookieData, 60 * 24, '/', null, false, false);
    
        return response()->json(['message' => 'Consent declined'])
            ->cookie($cookie);
    }
}

