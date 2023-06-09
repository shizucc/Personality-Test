<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepribadian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public  $timestamps = false;
    protected $table = 'kepribadians';

    public function ciri_ciri(){
        return $this->hasMany(CiriCiri::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_kepribadian');
    }
}
?>
