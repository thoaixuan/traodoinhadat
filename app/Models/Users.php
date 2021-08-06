<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Users extends Model
{
    use Sortable;
    protected $table = 'users';
    public $sortable = ['id', 'full_name','status','updated_at'];
}
