<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
Use App\Models\PrivacyConsent;
use Illuminate\Http\Request;

class ConsentController extends Controller
{
    public function index()
    {
        $consents = PrivacyConsent::orderByDesc('accepted_at')->paginate(10);
        return view('admin.dashboard', compact('consents'));
    }
}
