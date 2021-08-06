<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Slider extends Model
{
    use Sortable;
    protected $table = 'slider';
    public $sortable = ['id', 'image','link','name','created_at'];

}
