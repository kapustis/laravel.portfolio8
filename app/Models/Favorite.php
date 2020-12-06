<?php

namespace App\Models;

use App\RecordsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property int $id
 */
class Favorite extends Model
{
    use HasFactory, RecordsActivity;
    /**
     * Don't auto-apply mass assignment protection.
     * Снятие авто-защиты от массового присвоения.
     * @var array
     */
    protected $guarded = [];
    /**
     * Fetch the model that was favorited.
     * Выборка для favorited
     * @return MorphTo
     */
    public function favorited()
    {
        return $this->morphTo();
    }
}
