<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Store stocks from textarea input
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stockData' => 'required|string'
        ]);

        $productId = $request->product_id;
        $stockData = $request->stockData;
        $lines = explode("\n", $stockData);

        DB::beginTransaction();
        try {
            $addedCount = 0;
            $product = Product::findOrFail($productId);

            foreach ($lines as $line) {
                if (empty(trim($line))) continue;

                $parts = explode('|', $line, 2);
                if (count($parts) < 2) continue;

                $uuid = trim($parts[0]);
                $value = trim($parts[1]);

                // Kiểm tra xem UUID đã tồn tại chưa
                $existingStock = Stock::where('uuid', $uuid)->first();
                if (!$existingStock) {
                    Stock::create([
                        'product_id' => $productId,
                        'uuid' => $uuid,
                        'value' => $value
                    ]);
                    $addedCount++;
                }
            }

            // Cập nhật số lượng sản phẩm
            $product->quantity = $product->stocks()->count();
            $product->save();

            DB::commit();
            return redirect()->back()->with('success', "Đã thêm $addedCount sản phẩm vào kho thành công!");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function showProductStocks(Product $product)
    {
        $stocks = $product->stocks()->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.stocks.product-stocks', compact('product', 'stocks'));
    }


    public function destroy(Stock $stock)
    {
        $productId = $stock->product_id;
        $product = Product::findOrFail($productId);

        DB::beginTransaction();
        try {
            $stock->delete();

            // Cập nhật số lượng sản phẩm
            $product->quantity = $product->stocks()->count();
            $product->save();

            DB::commit();
            return redirect()->back()->with('success', 'Đã xóa stock thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'stock_ids' => 'required|array',
            'stock_ids.*' => 'exists:stocks,id'
        ]);

        $stockIds = $request->stock_ids;

        // Lấy product_id từ stock đầu tiên để cập nhật quantity sau khi xóa
        $firstStock = Stock::find($stockIds[0]);
        if (!$firstStock) {
            return redirect()->back()->with('error', 'Không tìm thấy stock.');
        }

        $productId = $firstStock->product_id;
        $product = Product::findOrFail($productId);

        DB::beginTransaction();
        try {
            Stock::whereIn('id', $stockIds)->delete();

            // Cập nhật số lượng sản phẩm
            $product->quantity = $product->stocks()->count();
            $product->save();

            DB::commit();
            return redirect()->back()->with('success', 'Đã xóa ' . count($stockIds) . ' stock thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
