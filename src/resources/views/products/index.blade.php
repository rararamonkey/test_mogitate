<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>

    <!-- フォント -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

<div class="container">

    <!-- ヘッダー -->
    <div class="header">
        <h1>mogitate</h1>
        <a href="{{ url('/products/register') }}" class="add-btn">+商品を追加</a>
    </div>

    <div class="content">

        <!-- サイドバー -->
        <form method="GET" action="{{ route('products.index') }}" class="sidebar">

            <!-- 検索 -->
            <input
                type="text"
                name="keyword"
                placeholder="商品で検索"
                value="{{ request('keyword') }}"
            >
            <button class="search-btn">検索</button>

            <!-- 並び替え -->
            <p class="sort-label">価格順で表示</p>

            <select
                name="sort"
                required
                onchange="this.form.submit()"
                class="sort-select"
            >
                <option value="" disabled {{ request('sort') ? '' : 'selected' }}>
                    価格で並び替え
                </option>

                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>
                    高い順に表示
                </option>

                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>
                    低い順に表示
                </option>
            </select>

            <!-- タグ -->
            @if (request('sort'))
                <div class="sort-tag">
                    {{ request('sort') == 'asc' ? '低い順に表示' : '高い順に表示' }}
                    <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" class="close">×</a>
                </div>
            @endif

        </form>

        <!-- 商品一覧 -->
        <div class="products">
            @foreach ($products as $product)
                <a href="{{ url('/products/detail/' . $product->id) }}" class="card">

                    <!-- 画像 -->
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}">
                    @endif

                    <div class="card-body">
                        <p class="name">{{ $product->name }}</p>
                        <p class="price">¥{{ number_format($product->price) }}</p>
                    </div>

                </a>
            @endforeach
        </div>

    </div>

    <!-- ページネーション -->
    <div class="pagination">
        {{ $products->onEachSide(0)->links('pagination::bootstrap-4') }}
    </div>

</div>

</body>
</html>