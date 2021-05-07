<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MenuItemCategory extends Model
{
    use HasFactory;

    use Sortable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_item_categories';

    protected $fillable = [
        'title',
        'slug',
        'status',
    ];
    public $sortable = [
        'title',
        'slug',
        'status',
        'created_at'
    ];
    public function sluggable(){
           return [
               'slug' => [
                   'source' => 'title'
               ]
           ];
    }

    public function menuItems(){
        return $this->belongsToMany('App\Models\MenuItem', 'menu_item_category_pivot','category_id','menu_item_id');
    }
}

