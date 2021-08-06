<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class District extends Model
{
    use Sortable;
    use Sluggable;
    protected $table = 'district';
    public $sortable = ['id', 'district_name','updated_at'];
    public function sluggable(): array
    {
        return [
            'district_slug' => [
                'source' => ['district_name']
            ]
        ];
    }
}
