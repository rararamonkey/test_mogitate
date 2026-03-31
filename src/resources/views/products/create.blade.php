<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録</title>

    <!-- フォント -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">

    <style>
        .preview img {
            width: 150px;
            margin-top: 10px;
            border-radius: 8px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #ccc;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- ヘッダー -->
    <div class="header">
        <h1>mogitate</h1>
    </div>

    <h2>商品登録</h2>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <p>商品名 <span class="required">必須</span></p>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
        @foreach ($errors->get('name') as $message)
            <p class="error">{{ $message }}</p>
        @endforeach

        <!-- 値段 -->
        <p>値段 <span class="required">必須</span></p>
        <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
        @foreach ($errors->get('price') as $message)
            <p class="error">{{ $message }}</p>
        @endforeach

        <!-- 商品画像 -->
        <p>商品画像 <span class="required">必須</span></p>

        <div class="file-upload">
            <label class="file-label">
                ファイルの選択
                <input type="file" name="image" id="image">
            </label>

            <!-- 初期は空 -->
            <span id="file-name"></span>
        </div>

        @foreach ($errors->get('image') as $message)
            <p class="error">{{ $message }}</p>
        @endforeach

        <!-- プレビュー -->
        <div class="preview">
            <img id="previewImage" style="display:none;">
        </div>

        <!-- 季節 -->
        <p>
        季節 
        <span class="required">必須</span>
        <span class="multi">複数選択可</span>
        </p>
        <div class="season-group">
            @foreach ($seasons as $season)
                <label class="season-item">
                    <input type="checkbox" name="season_ids[]" value="{{ $season->id }}"
                        {{ in_array($season->id, old('season_ids', [])) ? 'checked' : '' }}>
                    <span class="circle"></span>
                    <span class="text">{{ $season->name }}</span>
                </label>
            @endforeach
        </div>
        @foreach ($errors->get('season_ids') as $message)
            <p class="error">{{ $message }}</p>
        @endforeach

        <!-- 商品説明 -->
        <p>商品説明 <span class="required">必須</span></p>
        <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        @foreach ($errors->get('description') as $message)
            <p class="error">{{ $message }}</p>
        @endforeach

        <!-- ボタン -->
        <div class="buttons">
            <a href="{{ route('products.index') }}" class="back">戻る</a>
            <button type="submit" class="save">登録</button>
        </div>

    </form>

</div>

<!-- ⭐ JS（完全版） -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('image');
    const fileNameArea = document.getElementById('file-name');
    const preview = document.getElementById('previewImage');

    input.addEventListener('change', function (e) {
        const file = e.target.files[0];

        // ファイル名表示
        fileNameArea.textContent = file ? file.name : '';

        // プレビュー
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });

});
</script>

</body>
</html>