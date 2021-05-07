<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Menu extends Model
{
    use HasFactory;

    use Sortable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';

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
        return $this->hasMany('App\Models\MenuItem','menu_id','id');
    }
}
