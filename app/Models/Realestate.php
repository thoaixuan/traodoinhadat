<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Realestate extends Model
{
    use Sortable;
    use Sluggable;
    protected $table = 'realestate';
    public $sortable = ['id', 'realestate_title','updated_at'];
    public function sluggable(): array
    {
        return [
            'realestate_slug' => [
                'source' => ['realestate_title']
            ]
        ];
    }
}
