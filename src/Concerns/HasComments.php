<?php

namespace RyanChandler\Comments\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use RyanChandler\Comments\Contracts\IsComment;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasComments
{
    /** @return MorphMany<IsComment> */
    public function comments(): MorphMany
    {
        return $this->morphMany(config('comments.model'), 'commentable')
            ->orderByDesc('created_at')
            ->with('user');
    }

    public function comment(string $content, ?Model $user, ?IsComment $parent): IsComment
    {
        return $this->comments()->create([
            'content' => $content,
            'user_id' => $user ? $user->getKey() : Auth::id(),
            'parent_id' => $parent?->getKey(),
        ]);
    }
}
