# YAMAURA CrowdWorks Sample

クラウドワークス応募用のホームページ制作サンプルです。

## GitHub Pages

GitHub Pagesで公開する場合は、このリポジトリのルートを公開対象にしてください。

- `index.html`: 公開用トップページ
- `admin.html`: 簡易更新画面サンプル

`admin.html` はブラウザの `localStorage` を使ったデモです。実案件ではWordPressの管理画面、STUDIO CMS、またはフォームサービスとの連携に置き換える想定です。

## WordPress Theme

WordPressテーマ版は以下に入っています。

- `wordpress-theme/yamaura-theme/`

テーマ版では、施工事例とお客様の声をカスタム投稿タイプとして管理できます。画像は `assets/img/` に実ファイルがあればそれを使い、なければサンプル画像URLを表示します。

## Included Fixes

- GitHub Pages向けに `index.html` をルートへ配置
- お問い合わせフォームを追加
- スマホ用ハンバーガーメニューを追加
- 管理画面リンクの整合性を整理
- WordPressテーマの画像欠けをフォールバックで回避
