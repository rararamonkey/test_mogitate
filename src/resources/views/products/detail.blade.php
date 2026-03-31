<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品編集</title>

    <!-- フォント -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
</head>
<body>

<div class="container">

    <!-- ヘッダー -->
    <div class="header">
        <h1>mogitate</h1>
    </div>

    <div class="inner">

        <!-- パンくず -->
        <p class="breadcrumb">
            <a href="{{ route('products.index') }}">商品一覧</a> ＞ {{ $product->name }}
        </p>

        <!-- ⭐ 更新フォーム -->
        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ⭐⭐⭐ これが命（絶対必要） -->
            <input type="hidden" name="existing_image" value="{{ $product->image }}">

            <div class="form-row">

                <!-- 画像 -->
                <div class="image-area">
                    <p>商品画像 <span class="required">必須</span></p>

                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="product-image">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="product-image">
                    @endif

                    <div class="file-upload">
                        <label class="file-label">
                            ファイルの選択
                            <input type="file" name="image" id="image">
                        </label>
                        <span id="file-name"></span>
                    </div>

                    @foreach ($errors->get('image') as $message)
                        <p class="error">{{ $message }}</p>
                    @endforeach
                </div>

                <!-- 入力 -->
                <div class="form-area">

                    <!-- 商品名 -->
                    <p>商品名 <span class="required">必須</span></p>
                    <input type="text" name="name"
                        value="{{ old('name', $product->name) }}"
                        placeholder="商品名を入力">
                    @foreach ($errors->get('name') as $message)
                        <p class="error">{{ $message }}</p>
                    @endforeach

                    <!-- 値段 -->
                    <p>値段 <span class="required">必須</span></p>
                    <input type="text" name="price"
                        value="{{ old('price', $product->price) }}"
                        placeholder="値段を入力">
                    @foreach ($errors->get('price') as $message)
                        <p class="error">{{ $message }}</p>
                    @endforeach

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
                                    {{ in_array($season->id, old('season_ids', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <span class="circle"></span>
                                <span class="text">{{ $season->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    @foreach ($errors->get('season_ids') as $message)
                        <p class="error">{{ $message }}</p>
                    @endforeach

                </div>

            </div>

            <!-- 商品説明 -->
            <div class="description-area">
                <p>商品説明 <span class="required">必須</span></p>
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @foreach ($errors->get('description') as $message)
                    <p class="error">{{ $message }}</p>
                @endforeach
            </div>

            <!-- ボタン -->
            <div class="action-area">
                <div class="center-buttons">
                    <a href="{{ route('products.index') }}" class="back">戻る</a>
                    <button type="submit" class="save">変更を保存</button>
                </div>
            </div>

        </form>

    </div>

    <!-- 削除 -->
    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="delete-form">
        @csrf
        @method('DELETE')

        <button type="submit" class="delete-btn">
            🗑
        </button>
    </form>

</div>

<!-- JS -->
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    document.getElementById('file-name').textContent =
        file ? file.name : '';
});
</script>

</body>
</html>