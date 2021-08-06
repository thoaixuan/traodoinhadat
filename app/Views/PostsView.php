<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class PostsView extends Model
{
    use Sortable;
    protected $table = 'post_view';
    public $sortable = ['id', 'full_name','post_title','post_status','created_at'];

}
