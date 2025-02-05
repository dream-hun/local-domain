<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingFeature extends Model
{


    public function hostingPlan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HostingPlan::class, 'hosting_plan_id'); // Adjust foreign key if needed
    }
}
