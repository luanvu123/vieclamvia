<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function index()
    {
        $supports = Support::all();
        return view('admin.support.index', compact('supports'));
    }

    public function create()
    {
        return view('admin.support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $logoPath = $request->file('logo') ? $request->file('logo')->store('logos', 'public') : null;

        Support::create([
            'name' => $request->name,
            'logo' => $logoPath,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        return redirect()->route('support.index')->with('success', 'Hỗ trợ đã được thêm thành công.');
    }

    public function edit(Support $support)
    {
        return view('admin.support.edit', compact('support'));
    }

    public function update(Request $request, Support $support)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            if ($support->logo) {
                Storage::disk('public')->delete($support->logo);
            }
            $support->logo = $request->file('logo')->store('logos', 'public');
        }

        $support->update([
            'name' => $request->name,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        return redirect()->route('support.index')->with('success', 'Hỗ trợ đã được cập nhật thành công.');
    }

    public function destroy(Support $support)
    {
        if ($support->logo) {
            Storage::disk('public')->delete($support->logo);
        }

        $support->delete();

        return redirect()->route('support.index')->with('success', 'Hỗ trợ đã được xóa thành công.');
    }
}
