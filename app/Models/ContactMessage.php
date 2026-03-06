<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'subject',
        'message',
    ];
}
