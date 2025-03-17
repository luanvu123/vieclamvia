<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function edit()
    {
        $info = Info::first(); // Lấy bản ghi duy nhất
        return view('admin.info.edit', compact('info'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'big_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'small_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'url_facebook' => 'nullable|url',
            'notice' => 'nullable|string',
            'notice_modal' => 'nullable|string',
            'warranty_policy_success' => 'nullable|string',
            'warranty_policy_error' => 'nullable|string',
        ]);

        $info = Info::first();

        if ($request->hasFile('big_logo')) {
            $bigLogoPath = $request->file('big_logo')->store('logos', 'public');
            $info->big_logo = $bigLogoPath;
        }

        if ($request->hasFile('small_logo')) {
            $smallLogoPath = $request->file('small_logo')->store('logos', 'public');
            $info->small_logo = $smallLogoPath;
        }

        $info->url_facebook = $request->url_facebook;
        $info->notice = $request->notice;
        $info->notice_modal = $request->notice_modal;
        $info->warranty_policy_success = $request->warranty_policy_success;
        $info->warranty_policy_error = $request->warranty_policy_error;
        $info->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');
    }
}
