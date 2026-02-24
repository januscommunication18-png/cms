<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Check if security code is enabled.
     */
    public static function isSecurityCodeEnabled(): bool
    {
        $value = static::get('security_code_enabled', '1');
        return $value === '1' || $value === 'true' || $value === true;
    }
}
