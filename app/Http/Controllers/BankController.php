<?php


namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('admin.banks.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'qr_code' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('qr_code')) {
            $data['qr_code'] = $request->file('qr_code')->store('qr_codes', 'public');
        }

        Bank::create($data);

        return redirect()->route('banks.index')->with('success', 'Ngân hàng được thêm thành công.');
    }

    public function show(Bank $bank)
    {
        return view('admin.banks.show', compact('bank'));
    }

    public function edit(Bank $bank)
    {
        return view('admin.banks.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'account_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'qr_code' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('qr_code')) {
            $data['qr_code'] = $request->file('qr_code')->store('qr_codes', 'public');
        }

        $bank->update($data);

        return redirect()->route('banks.index')->with('success', 'Ngân hàng được cập nhật thành công.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('banks.index')->with('success', 'Ngân hàng đã được xóa.');
    }
}
