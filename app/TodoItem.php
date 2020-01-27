<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    public function toggle()
    {
        if($this->completed_at) {
            $this->completed_at = null;
        } else {
            $this->completed_at = now();
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
