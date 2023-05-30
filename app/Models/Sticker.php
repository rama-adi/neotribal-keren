<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sticker extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stickerUsers(): HasMany
    {
        return $this->hasMany(StickerUser::class, 'sticker_id');
    }

    public function giveToUser(User $user)
    {
        if($this->stickerUsers()->where('user_id', $user->id)->exists()) {
            return;
        }

        $this->stickerUsers()->create([
            'user_id' => $user->id,
            'sticker_id' => $this->id,
        ]);
    }
}
