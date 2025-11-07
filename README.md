# PiGLY

## 概要
Laravel を使用して作成した体重管理アプリです。  
日々の体重・摂取カロリー・運動時間などを記録し、一覧表示・編集・削除ができます。  
また、目標体重の設定機能も実装しています。


## 環境構築手順

1. リポジトリを clone する
   ```bash
   git clone git@github.com:Felina24/test3.git

2. docker-compose up -d --build
3. docker-compose exec php bash
4. composer install
5. cp .env.example .env（環境変数を変更）
6. php artisan key:generate
7. php artisan migrate

## 実行環境
- PHP 8.3.6
- Laravel 8.83.8
- MySQL 8.0.43

## ER図
![ER図](PiGLY.svg)

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/