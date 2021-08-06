<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Subscribe extends Model
{
    use Sortable;
    protected $table = 'subscribe';
    public $sortable = ['id', 'email'];
}

