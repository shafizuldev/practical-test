<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivacyConsent extends Model
{
    use HasFactory;

    protected $fillable = ['guid', 'accepted_at', 'version'];
}
