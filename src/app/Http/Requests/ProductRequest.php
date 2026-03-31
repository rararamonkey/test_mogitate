<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    protected function getRedirectUrl()
    {
        return route('products.create');
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required',
            'image' => 'nullable|image',
            'description' => 'required|max:120',
            'season_ids' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'name.max' => '255文字以内で入力してください',

            'price.required' => '値段を入力してください',

            'image.image' => '画像ファイルを選択してください',

            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',

            'season_ids.required' => '季節を選択してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            // ===== 値段 =====
            $price = $this->input('price');

            if ($price === null || $price === '') {
                $validator->errors()->add('price', '値段を入力してください');
            }

            if (!is_numeric($price)) {
                $validator->errors()->add('price', '数値で入力してください');
            }

            if (!is_numeric($price) || $price < 0 || $price > 10000) {
                $validator->errors()->add('price', '0〜10000円以内で入力してください');
            }

            // ===== 商品説明 =====
            $description = $this->input('description');

            if ($description === null || $description === '') {
                $validator->errors()->add('description', '商品説明を入力してください');
            }

            if (mb_strlen((string)$description) > 120) {
                $validator->errors()->add('description', '120文字以内で入力してください');
            }

            // ===== ⭐画像（最重要ロジック）=====
            $hasImage = $this->hasFile('image');
            $existingImage = $this->input('existing_image');

            // 新規登録
            if ($this->isMethod('post')) {

                if (!$hasImage) {
                    $validator->errors()->add('image', '商品画像を登録してください');
                    $validator->errors()->add('image', 'pngまたはjpeg形式でアップロードしてください');
                }

            // 更新
            } else {

                if (!$hasImage && !$existingImage) {
                    $validator->errors()->add('image', '商品画像を登録してください');
                    $validator->errors()->add('image', 'pngまたはjpeg形式でアップロードしてください');
                }

                if ($hasImage) {
                    $image = $this->file('image');

                    if (!in_array($image->extension(), ['png', 'jpeg', 'jpg'])) {
                        $validator->errors()->add('image', 'pngまたはjpeg形式でアップロードしてください');
                    }
                }
            }

        });
    }
}