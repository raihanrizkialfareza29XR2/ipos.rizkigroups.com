<?php

namespace App\Imports;

use App\Models\Produk;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProdukImport implements ToModel, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $produk = Produk::latest()->first() ?? new Produk();
        return Produk::create([
            'kode_produk' => 'P'. tambah_nol_didepan((int)$produk->id_produk +1, 6),
            'id_kategori' => $row[0],
            'nama_produk' => $row[1],
            'satuan' => $row[2],
            'harga_beli' => $row[3],
            'diskon' => $row[4],
            'harga_jual' => $row[5],
            'stok' => $row[6],
        ]);
    }
    public function rules(): array
    {
        return [
            '1' => 'required|string',
            '2' => 'required|string',
            '6' => 'required|numeric',
        ];
    }
}
