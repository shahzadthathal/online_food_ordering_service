<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    protected $fillable = [
        'title',
        'slug',
        'status',
        'menu_id',
        'image'
       ];
       public function sluggable()
       {
           return [
               'slug' => [
                   'source' => 'title'
               ]
           ];
       }

    public function categories(){
        return $this->belongsToMany('App\Models\MenuItemCategory', 'menu_item_category_pivot','menu_item_id','category_id');
    }

    public function menu(){
        return $this->BelongsTo('App\Models\Menu','menu_id','id');
    }
       
}
