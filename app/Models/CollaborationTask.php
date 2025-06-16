<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaborationTask extends Model
{
    protected $guarded = ['id'];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function completer()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

}
