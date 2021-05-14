<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\BookRequest;

class Book extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'books';

    // 可変項目
    protected $fillable = [
        'user_id', //ユーザーid //usersテーブルから引用
        'bookTitle', //本のタイトル
        'bookAuthor', //著者
        'progress', //進捗　1.未だ 2途中. 3.読了
        'media', //紙or電子媒体　1.紙 2.電子 3.青空文庫
        'note', //メモ、感想ほか
        'img_name', //画像
    ];

    /**
     * usersテーブルとの紐づけ
     *
     * @return hasMany()
     */
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }


    /**
     * 新規投稿
     *@param $input
     *
     */
    public function newSet($input)
    {
        \DB::beginTransaction();
        try {
            // 登録
            Book::create($input);
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(50);
        }
        \DB::commit();
    }


    /**
     * 投稿編集
     * @param $inputs
     *
     */
    public function upNewDate($inputs)
    {

        \DB::beginTransaction();
        try {
            // 登録
            $book = Book::find($inputs['id']);
            $book->fill([
                'bookTitle' => $inputs['bookTitle'],
                'bookAuthor' => $inputs['bookAuthor'],
                'progress' => $inputs['progress'],
                'media' => $inputs['media'],
                'note' => $inputs['note'],
                'img_name' => $inputs['img_name']
            ]);
            $book->save();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
        \DB::commit();
    }

    /**
     * 投稿削除
     * @param $id
     *
     */
    public function dataDelete($id)
    {


        try {
            // 削除
            Book::destroy($id);
        } catch (\Throwable $e) {
            abort(500);
        }
    }
}
