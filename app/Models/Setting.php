<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'updated_by'
    ];
    public static function  setting($setting_key) {


        return Setting::where('setting_key', $setting_key)->pluck('setting_value');

    }
}
