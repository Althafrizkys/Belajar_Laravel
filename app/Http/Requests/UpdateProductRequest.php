<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Mendapatkan ID produk yang sedang diperbarui dari route binding
        $productId = $this->route('product')->id ?? $this->product->id;

        return [
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'code'        => 'required|string|max:50|unique:products,code,' . $productId,
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'unit'        => 'required|string|max:20',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Nama produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists'   => 'Kategori tidak valid.',
            'code.required'        => 'Kode produk wajib diisi.',
            'code.unique'          => 'Kode produk sudah digunakan oleh produk lain.',
            'price.required'       => 'Harga produk wajib diisi.',
            'stock.required'       => 'Stok produk wajib diisi.',
            'unit.required'        => 'Satuan unit produk wajib diisi.',
            'image.image'          => 'Berkas harus berupa gambar.',
            'image.max'            => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}