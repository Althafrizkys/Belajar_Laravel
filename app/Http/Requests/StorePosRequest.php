<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty'        => 'required|integer|min:1',
            'pay'                => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required'              => 'Keranjang belanja tidak boleh kosong.',
            'items.*.product_id.required' => 'Produk wajib dipilih.',
            'items.*.product_id.exists'   => 'Produk tidak ditemukan di database.',
            'items.*.qty.required'        => 'Jumlah barang wajib diisi.',
            'items.*.qty.min'             => 'Jumlah barang minimal 1.',
            'pay.required'                => 'Nominal pembayaran wajib diisi.',
            'pay.numeric'                 => 'Nominal pembayaran harus berupa angka.',
        ];
    }
}