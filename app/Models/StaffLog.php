<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLog extends Model
{
    use HasFactory;

    protected $table = 'staff_logs';
    protected $fillable = ['performer_id', 'performed_on', 'message'];
}
