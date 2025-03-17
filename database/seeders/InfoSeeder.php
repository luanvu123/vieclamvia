<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::create([
            'big_logo' => 'big_logo.png',
            'small_logo' => 'small_logo.png',
            'url_facebook' => 'https://facebook.com/yourpage',
            'notice' => 'Thông báo quan trọng cho khách hàng.',
            'notice_modal' => 'Nội dung thông báo hiện lên khi mở modal.',
            'warranty_policy_success' => 'Chính sách bảo hành khi giao dịch thành công.',
            'warranty_policy_error' => 'Chính sách bảo hành khi giao dịch thất bại.',
        ]);
    }
}
