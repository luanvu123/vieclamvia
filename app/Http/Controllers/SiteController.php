<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    const TRANSACTION_API = "https://script.googleusercontent.com/macros/echo?user_content_key=AehSKLjmaB-X8k60r8QxV_P6EJA6oRXkSUWWJdy0aLe9-2OJvxoKN_SVG8g8dunQ9JXJ88qLKXP68yk9BARlhvC4klhWQNI8tR2kgk9SbB784vtrASFOebtZvCuf54tmfuBEQEXLAcSaGsCLXHQd7PSRqvMA5egi3nlasRoVJFrPijLIAZgMPYnYb6Nj-m4pEgQru4ZgKL4g1XrTAEeZrsxpNK3F6KO3bwfjtgJY_mvOO8w3VRWsESf_OvRauwHUPHmlhNSLClTIZyVbIZTdpVL3QmdfMboVAA&lib=MzOuDQjTM3fNQyPqGwHfCGflRnzlbkUi4";
    public function index()
    {
        $gradients = [
            'linear-gradient(to right, #FF5F6D, #FFC371)',
            'linear-gradient(to right, #2193b0, #6dd5ed)',
            'linear-gradient(to right, #cc2b5e, #753a88)',
            'linear-gradient(to right, #00d2ff, #3a7bd5)',
            'linear-gradient(to right, #ee9ca7, #ffdde1)',
            'linear-gradient(to right, #FF6B6B, #F0E68C)'
        ];

        // Lấy các Category, Subcategory và Product kích hoạt (status = 1)
        $categories = Category::where('status', 1)
            ->with([
                'subcategories' => function ($query) {
                    $query->where('status', 1)
                        ->with([
                            'products' => function ($query) {
                                $query->where('status', 1);
                            }
                        ]);
                }
            ])
            ->get();
        $deposits = Deposit::where('type', 'nạp tiền')
            ->latest()
            ->take(5)
            ->with('customer')
            ->get();

        // Lấy lịch sử mua hàng mới nhất
        $orders = Order::where('status', 'completed')
            ->latest()
            ->take(5)
            ->with(['customer', 'product'])
            ->get();
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            $this->checkTransactions($customer);
            // Reload customer to get updated balance if needed
            $customer = $customer->fresh();
        }

        return view('pages.home', compact('categories', 'gradients', 'deposits', 'orders'));
    }
    private function checkTransactions(Customer $customer)
    {
        try {
            // Fetch transaction data from Google Apps Script
            $response = Http::get(self::TRANSACTION_API);

            if ($response->successful()) {
                $result = $response->json();

                if (!empty($result['data']) && $result['error'] === false) {
                    $transactions = $result['data'];

                    foreach ($transactions as $transaction) {
                        // Check if description contains customer ID
                        $customerIdPattern = '/\b' . $customer->idCustomer . '\b/';

                        if (
                            isset($transaction['Mô tả']) &&
                            preg_match($customerIdPattern, $transaction['Mô tả'])
                        ) {

                            // Generate a unique transaction reference
                            $transactionRef = 'GS-' . ($transaction['Mã GD'] ?? '');

                            // Check if this transaction has already been processed
                            $existingDeposit = Deposit::where('transaction_reference', $transactionRef)->first();

                            if (!$existingDeposit && isset($transaction['Giá trị'])) {
                                // Create new deposit record
                                $deposit = new Deposit();
                                $deposit->customer_id = $customer->id;
                                $deposit->money = $transaction['Giá trị'];
                                $deposit->type = 'nạp tiền';
                                $deposit->content = $transaction['Mô tả'] ?? '';
                                $deposit->status = 'thành công';
                                $deposit->transaction_reference = $transactionRef;
                                $deposit->save();

                                // Update customer balance
                                $customer->Balance += $deposit->money;
                                $customer->save();

                                Log::info("Created deposit for customer {$customer->idCustomer}, amount: {$deposit->money}, transaction: {$transactionRef}");
                            }
                        }
                    }
                } else {
                    Log::warning('API returned error or empty data', [
                        'error' => $result['error'] ?? 'unknown error'
                    ]);
                }
            } else {
                Log::error('Failed to fetch transaction data: ' . $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Error checking transactions: ' . $e->getMessage());
        }
    }
    public function category($categoryId, $subcategoryId)
    {
        $category = Category::where('id', $categoryId)->where('status', 1)->firstOrFail();
        $subcategory = Subcategory::where('id', $subcategoryId)
            ->where('category_id', $categoryId)
            ->where('status', 1)
            ->with([
                'products' => function ($query) {
                    $query->where('status', 1);
                }
            ])
            ->firstOrFail();

        return view('pages.category', compact('category', 'subcategory'));
    }
    public function indexSupport()
    {
        $supports = Support::where('status', 'active')->get();
        return view('pages.contact', compact('supports'));
    }
    public function warrantyPolicy()
    {
        return view('pages.warranty');
    }
}
