<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \App\Traits\TraitUuid;
    use HasFactory;
    protected $dateFormat = 'Y-m-d H:i:s';
   
    protected $fillable=[
        'country','state','city','service','tag',
        'category','title','description','email',
        'phone','age','images'
    ];
    protected $casts = [
        'images' => 'array'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
