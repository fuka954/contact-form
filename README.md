## アプリケーション名
お問い合わせフォーム

## 環境構築
1.Dockerビルド
   docker-compose up -d --build
2.Laravel環境構築
   docker-compose exec php bash
3.パッケージのインストール
   composer install
4.環境ファイルのコピー
   cp .env.example .env　を実行し、環境変数を変更
5.アプリケーションキーの生成
   php artisan key:generate
6.マイグレーションとシーディング
   php artisan migrate 
   php artisan db:seed

## 使用技術(実行環境)
・PHP 7.4.9
・Laravel 8.83.29
・mysql 8.0.26
## ER図
![ER図](https://github.com/user-attachments/assets/e4a4e62d-9cd8-4f63-b932-ec31dcf7fa6c)


## URL
開発環境: [http://localhost/](http://localhost/)
phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)

