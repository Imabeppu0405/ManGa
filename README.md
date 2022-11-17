# 目次
1. ManGaの説明
1. docker環境構築手順

# 1. ManGa

様々なプラットフォームのゲームをステータス毎に管理できるアプリです。

## 画面イメージ
![image](https://user-images.githubusercontent.com/72291454/188461649-c50f66f2-cf4e-4c33-9cf3-cfb52c986c91.png)

## 機能
- ゲーム記録の登録・編集・削除機能
- ゲームの登録・編集・削除機能
- ステータス毎の管理機能
- ログイン・ログアウト機能(Laravel Breezeで実装)
- ほかのユーザーのゲームのプレイ状況を把握できる機能
- 一部ゲームのニュースを表示

## 機能予定
- ゲームの登録・編集・削除を特定のユーザーしかできないようにする

<hr>

# 2. docker環境構築手順
cloneしたプロジェクトのdocker環境構築にてこずったので、メモ
1. gitからcloneする
```
git@github.com:Imabeppu0405/ManGa.git
```
2. dockerコンテナを起動
```
docker compose up -d (--buildオプションが必要だったかも)
```
3. composer自体はあったが、venderフォルダが作成されていなかったので、composer installを実行
```
docker compose exec app bash
composer install
```
4. .example.envファイルを編集して.envファイルを作成
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gamedb
DB_USERNAME=gameuser
DB_PASSWORD=gameuser123
```
5. DB等の構築
```
php artisan key:generate
php artisan migrate
php artisan db:seed
```
6. nom関連
```
docker compose exec web bash
npm install
npm run build
exit
```

7. permission関連でエラーが出たので権限変更
```
// cloneしたディレクトリにて
sudo chmod 777 -R src/storage
```

## SSL化の手順
### ドメイン名設定
1. ドメイン名を購入(mangaapp.click)  
2. Router53にドメイン名を登録。
### ssh化
1. ACMでSSL証明書を作成する
1. ロードバランサー用のターゲットグループを作成
2. ロードバランサーを作成し、証明書を紐付ける
3. ロードバランサーからの接続のみを許可するようにインスタンスのセキュリティグループのインバウントルールを変更

### 参考
- https://dev.classmethod.jp/articles/aws-web-server-https-for-beginner/
- https://qiita.com/himorishuhei/items/7426cab6cd83c3d8e4e3

### AWS構成図
![image](https://user-images.githubusercontent.com/72291454/202555179-c5ca2497-db1c-4a54-a8e4-2841bdb7a686.png)

