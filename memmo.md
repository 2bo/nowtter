プロジェクト生成

```shell
$ php ./lib/vendor/symfony/data/bin/symfony generate:project [projcet name]
```

アプリ生成

```shell
$ ./symfony generate:app [app_name]
```

権限設定

```shell
$ ./symfony project:permissions
```

schema.ymlに基づき、DBに関連する以下の処理をまとめて実行

* データベース作成
* モデル生成
* フィルタ生成
* フォーム生成
* テーブル作成用SQL生成(data/sql/schema.sql)
* テーブル生成

```shell
$ ./symfony doctrine:build --all
```

モジュール生成

```shell
$ ./symfony generate:module [app_name] [module_name]
```


schema.ymlについて

* 1つのテーブルの複数カラムに同一のテーブルへの外部キーを設定するのは難しそう
* テーブル名はアッパーキャメルケースで記載する。生成されるDBテーブルはスネークケースになる

参考

[symfony 1.4 メモ（schemaの書き方）](https://qiita.com/shotets/items/f55d9e625c78bb8f05e6)

[2011-08-03 Symfony1.4で認証機能をつける](http://d.hatena.ne.jp/Kmusiclife/20110803/1312344314)


実装する機能

* ログイン
* ツイート(自分の)
* ツイート(人の)
* 投稿フォーム
* ユーザ管理画面

