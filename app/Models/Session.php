<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Session extends Model
{
    use UsesUuid, HasFactory;

    /**
     * The property rules
     *
     * @var string[]
     */
    public $rules = [
        'name' => 'required',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * All users attached to the session
     *
     * @return BelongsToMany
     */
    public function invitees()
    {
        return $this->belongsToMany(User::class)->withPivot('is_moderator');
    }
}
