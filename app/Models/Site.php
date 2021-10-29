<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * Class Site
 * @package App\Models
 *
 * @property integer id
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property integer sort
 * @property string name
 * @property string description
 * @property boolean show
 * @property string url
 *
 * @property integer folder_id
 * @property Folder folder
 *
 * @property integer site_image_id
 * @property SiteImage siteImage
 *
 * @property integer user_id
 * @property User user
 *
 * @property Collection|Site[] sites
 */
class Site extends Model
{
    use HasFactory;

    protected $fillable = ['sort', 'name', 'description', 'show', 'url'];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function siteImage(): BelongsTo
    {
        return $this->belongsTo(SiteImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
