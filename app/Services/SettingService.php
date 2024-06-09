<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    private $setting;
    public function __construct(Setting $setting) {
        $this->setting = $setting;
    }

    public function get() {
        return $this->setting->first();
    }

    public function update($data) {
        $admin = $this->setting::findOrFail($data['setting_id']);
        return $admin->fill($data)->save();
    }

    public function updateTax($data) {
        return $this->setting->whereNotNull('id')->update($data);
    }
}

?>
