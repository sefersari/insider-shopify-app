<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{

    /**
     * @param array $data
     * @param string|int $companyId
     * @return true
     */
    public function createOrUpdate(array $data, string|int $companyId): true
    {
        $setting = Setting::query()
            ->where('company_id', $companyId);

        if ($setting->exists()) {
            $setting->update([
                'shopify_store' => $data['shopify_store'],
                'shopify_token' => $data['shopify_token']
            ]);

            return true;
        }

        Setting::query()
            ->create([
                'shopify_store' => $data['shopify_store'],
                'shopify_token' => $data['shopify_token'],
                'company_id' => $companyId
            ]);

        return true;
    }

}
