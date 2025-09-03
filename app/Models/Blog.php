<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'content',
      'slug',
      'image',
      'is_published',
      'user_id',
      'category_id'  
    ];

    //now the program will search with 'slug', not 'id'
    public function getRouteKeyName()
    {
        return 'slug'; 
    }

    // $blog->user likhle user er sokol tottho paoa jabe
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // $blog->category likhle category er sokol tottho paoa jabe
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}



