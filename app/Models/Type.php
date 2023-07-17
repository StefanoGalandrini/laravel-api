<?php

namespace App\Models;

use App\Models\Project;
use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    use Slugger;

    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
