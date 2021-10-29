<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * Class Site
 * @package App\Models
 *
 * @property integer id
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property string original_file_name
 * @property string s3_path
 *
 * @property integer user_id
 * @property User user
 *
 * @property Site site
 */
class SiteImage extends Model
{
    use HasFactory;

    protected $fillable = ['original_file_name', 's3_path'];

    public function site(): HasOne
    {
        return $this->hasOne(Site::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
