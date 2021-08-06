<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Ward extends Model
{
    use Sortable;
    use Sluggable;
    protected $table = 'ward';
    public $sortable = ['id', 'ward_name','updated_at'];
    public function sluggable(): array
    {
        return [
            'ward_slug' => [
                'source' => ['ward_name']
            ]
        ];
    }
}
