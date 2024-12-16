## アプリケーション名
- お問い合わせフォーム

## 環境構築
- 1.リポジトリのクローン
   git clone リンク
- 2.Dockerビルド  
  docker-compose up -d --build
- 3.Laravel環境構築
  docker-compose exec php bash
- 4.パッケージのインストール
  composer install
- 5.環境ファイルのコピー
  cp .env.example .env　を実行し、環境変数を変更
- 6.アプリケーションキーの生成
  php artisan key:generate
- 7.マイグレーションとシーディング
  php artisan migrate
  php artisan db:seed

## ER図
![ER図](https://github.com/user-attachments/assets/73a5b601-8652-49f2-91d5-62b4404bec2b)

## URL
開発環境: [http://localhost/](http://localhost/)
phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)
