<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperItem
 */
class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => 'integer',
    ];

    protected $hidden = [
        'file',
        'created_at',
        'updated_at',
    ];

    public function scopeOldRecords($query)
    {
        return $query->where('created_at', '<', now()->subDays(30));
    }
}
