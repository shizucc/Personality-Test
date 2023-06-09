<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;
class DaftarPertanyaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public  $timestamps = false;
    public function ciri(){
        return $this->belongsTo(CiriCiri::class);
    }
    public function kepribadian(){
        return $this->belongsToThrough(Kepribadian::class,CiriCiri::class);
    }
}
