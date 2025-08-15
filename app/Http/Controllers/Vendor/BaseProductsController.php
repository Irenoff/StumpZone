<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait BaseProductsController
{
    protected array $sports = [
        'cricket'    => 'cricket_equipment',
        'football'   => 'football_equipment',
        'basketball' => 'basketball_equipment',
        'badminton'  => 'badminton_equipment',
        'boxing'     => 'boxing_equipment',
    ];

    protected function tableFor(string $sport): string
    {
        $sport = strtolower($sport);
        if (!isset($this->sports[$sport])) {
            abort(404, "Unknown sport: {$sport}");
        }
        return $this->sports[$sport];
    }

    protected function insertOrUpdate(string $table, array $data, ?int $id = null): int
    {
        $payload = [
            'name'     => $data['name'],
            'size'     => $data['size'] ?? 'N/A',
            'price'    => (float) $data['price'],
            'quantity' => (int) $data['quantity'],
            'updated_at' => now(),
        ];

        if (Schema::hasColumn($table, 'image_path') && !empty($data['image_path'])) {
            $payload['image_path'] = $data['image_path'];
        }

        if ($id) {
            DB::table($table)->where('id', $id)->update($payload);
            return $id;
        }

        $payload['created_at'] = now();
        return (int) DB::table($table)->insertGetId($payload);
    }
}
