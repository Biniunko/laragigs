<?php

namespace App\Models;
use HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
    'title',
    'tags',
    'company',
    'location',
    'email',
    'website',
    'description',
];
};
