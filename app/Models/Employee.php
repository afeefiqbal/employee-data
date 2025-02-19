<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'company_id', 'email', 'phone','user_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
