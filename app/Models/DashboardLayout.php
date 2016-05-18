<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardLayout extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_dashboard_layout';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'layout_json',
        'visible_json',
        'user_dashboard_id',
        'active_user_id',
    ];
}
