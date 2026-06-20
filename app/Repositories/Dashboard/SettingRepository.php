<?php

namespace App\Repositories\Dashboard;

use App\Models\Setting;

class SettingRepository
{
      // get setting
    public function getSetting($id)
    {
        return Setting::find($id);
    }

    // update settings
    public function updateSettings($setting, $data)
    {
        $setting->update($data);
        return $setting;
    }
}
