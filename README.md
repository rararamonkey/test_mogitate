# laravel-docker-template
# mogitate（商品管理アプリ）

## アプリ概要
商品を登録・一覧表示・検索できるシンプルな商品管理アプリです。  
画像付きで商品情報を管理することができます。

---

## 環境構築

### Dockerビルド
リポジトリをクローン
git clone https://github.com/あなたのユーザー名/mogitate.git

Dockerを起動
docker-compose up -d --build

※ Mac（M1・M2）の場合  
エラーが出る場合は docker-compose.yml に以下を追記してください

mysql:
  platform: linux/x86_64
  image: mysql:8.0.26

---

### Laravel環境構築

コンテナに入る
docker-compose exec php bash

パッケージインストール
composer install

環境ファイル作成
cp .env.example .env

.envに以下を記載

DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass  

---

### アプリケーションキー生成
php artisan key:generate

---

### マイグレーション実行
php artisan migrate

---

### シーディング実行
php artisan db:seed

---

### ストレージリンク作成（画像表示用）
php artisan storage:link

---

## 使用技術（実行環境）
- PHP 8.x
- Laravel 8.x
- MySQL 8.x
- Docker

---

## 機能一覧
- 商品一覧表示
- 商品検索機能（キーワード検索）
- 商品並び替え（価格順）
- 商品詳細表示
- 商品登録機能
- 画像アップロード・表示

---

## ER図
![ER図](src/public/er.png)

---

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/

---

## 補足
画像は以下のディレクトリに保存されています。

storage/app/public/products/

表示には以下を使用しています。

```blade
<img src="{{ asset('storage/' . $product->image) }}">
