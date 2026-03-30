# laravel-docker-template
# mogitate（商品管理アプリ）

## アプリ概要

商品を登録・一覧表示・検索できるシンプルな商品管理アプリです。
画像付きで商品情報を管理することができます。

---

## 環境構築

### Dockerビルド

1. リポジトリをクローン

```bash
git clone https://github.com/あなたのユーザー名/mogitate.git
```

2. Dockerを起動

```bash
docker-compose up -d --build
```

---

## Laravel環境構築

1. コンテナに入る

```bash
docker-compose exec php bash
```

2. パッケージインストール

```bash
composer install
```

3. 環境ファイル作成

```bash
cp .env.example .env
```

4. アプリケーションキー生成

```bash
php artisan key:generate
```

5. マイグレーション実行

```bash
php artisan migrate
```

6. シーディング実行

```bash
php artisan db:seed
```

7. ストレージリンク作成（画像表示用）

```bash
php artisan storage:link
```

---

## 使用技術（実行環境）

* PHP 8.x
* Laravel 8.x
* MySQL 8.x
* Docker

---

## 機能一覧

* 商品一覧表示
* 商品検索機能（キーワード検索）
* 商品並び替え（価格順）
* 商品詳細表示
* 商品登録機能
* 画像アップロード・表示

---

## ER図

※ ER図の画像を配置してください

```md
![ER図](scr/public/er.png)
```

---

## URL

* 開発環境：http://localhost/
* phpMyAdmin：http://localhost:8080/

---

## 補足

画像は以下のディレクトリに保存されています。

```
storage/app/public/products/
```

表示には以下を使用しています。

```php
<img src="{{ asset('storage/' . $product->image) }}">
```

