<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class RealestateView extends Model
{
    use Sortable;
    protected $table = 'realestate_view';
    public $sortable = ['id', 'full_name','realestate_title','realestate_view','created_at'];

}
