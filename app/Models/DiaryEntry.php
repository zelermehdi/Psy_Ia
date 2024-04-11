<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryEntry extends Model
{
    use HasFactory;


    public function diaryEntries()
{
    return $this->hasMany(DiaryEntry::class);
}
}
