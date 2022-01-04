<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $icon_image
 * @property string|null $icon_code
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property-read \App\Models\Status $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $sub_categories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIconCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIconImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $fillable = ['name','slug','icon_image','icon_code','status_id','created_by','updated_by'];

    protected $table = 'categories';

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function sub_categories()
    {
        return $this->belongsToMany(SubCategory::class)->withTimestamps();
    }

}
