<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Province extends Model
{
    use Sortable;
    use Sluggable;
    protected $table = 'province';
    public $sortable = ['id', 'province_name','updated_at'];
    public function sluggable(): array
    {
        return [
            'province_slug' => [
                'source' => ['province_name']
            ]
        ];
    }
}
