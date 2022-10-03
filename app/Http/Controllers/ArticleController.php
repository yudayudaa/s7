<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;//これでapp/Models/Article.php の処理が呼び出せます。
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
//use App\resources\views\layouts;


class ArticleController extends Controller
{
    public function showList() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getList();

        return view('list', ['articles' => $articles]);
    }  
    public function showRegistForm() {
        return view('regist');//🌟View.を追記
    }

    public function registSubmit(ArticleRequest $request) {//追記↓

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Article();
            $model->registArticle($request);
            DB::commit();
        } catch (\Exception $e) {
            //dd($e);✨デバック
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらregistにリダイレクト
        return redirect(route('regist'));
    }

    public function registArticle($data) {
        // 登録処理
        DB::table('articles')->insert([
            'title' => $data->title,
            'url' => $data->url,
            'comment' => $data->comment,
        ]);
    }
}

