<?php

namespace App\Models;//article.phpをmodels配下に移動したので\Modelsを追記

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;//DB処理を書くための宣言

class Article extends Model
{
    public function getList() {
        // articlesテーブルからデータを取得
        $articles = DB::table('articles')->get();

        return $articles;
    }

    public function registArticle($data) {//🌟仕様書にないやつ
        // 登録処理
        DB::table('articles')->insert([
            'title' => $data->title,
            'url' => $data->url,
            'comment' => $data->comment,
        ]);
    }
}