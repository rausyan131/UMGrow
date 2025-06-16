<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class CollaborationProduct extends Model
{
    protected $table = 'collaboration_product';
    protected $guarded = ['id'];

        public function collaboration(): BelongsTo
        {
            return $this->belongsTo(Collaboration::class);
        }
    
        public function product(): BelongsTo
        {
            return $this->belongsTo(Product::class);
        }
    
}
