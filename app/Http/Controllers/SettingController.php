<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(
        protected SettingService $settingService
    )
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Application|View|Factory
    {
        $setting = Setting::query()
            ->where('company_id', $this->companyId)
            ->get()
            ->first();

        return view('pages.setting', [
            'setting' => $setting
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $result = $this->settingService
            ->createOrUpdate(
                $request->all(),
                $this->companyId
            );

        return response()->json([
            'success' => $result,
            'message' => 'Setting successfully updated'
        ]);
    }
}
