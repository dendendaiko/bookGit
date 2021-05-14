<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session;
use App\Models\Book;
use App\Models\User;
use Auth;
use App\Http\Requests\BookRequest;
use App\Models\User\UserRequest;

class BookController extends Controller
{




    /**
     * トップ画面表示
     *
     * @return view
     */
    public function top()
    {
        return view('book.top');
    }


    /**
     *一覧画面表示
     *@param
     *@return view
     */
    public function bookList()
    {
        // DBから全てのデータを取得
        $books = Book::all();
        // ユーザーデータ取得
        $user = Auth::id();

        return view('book.list', ['books' => $books, 'user' => $user]);
    }

    /**
     *一覧画面表示 + 検索結果表示
     *@param $request
     *@return view
     */
    public function bookSearch($request)
    {
        $keyword = $request->input('keyword');
        $query = Book::query();

        // DBから絞り込み単語のデータを取得
        if(!empty($keyword)) {
            $query->where('bookTitle', 'LIKE', '%'.$keyword.'%')
                      ->orWHERE('bookAuthor', 'LIKE', '%'.$keyword.'%');
        }

        $books = $query->get();

       // ユーザーデータ取得
       $user = Auth::id();

       return response()->json($books, $user);
    }

    /**
     * 詳細画面表示
     * @param int $id
     * @return view
     */
    public function bookDetail($id)
    {
        // DBからデータを取得
        
        $book = Book::find($id);
        // ユーザーデータ取得
        $user = User::find($book->user_id);

        // データの有無の確認
        if (is_null($book)) {
            \Session::flash('err_msg', config('message.noData'));
            return redirect(route('list'));
        }
        // ユーザデータの有無の確認
        if (is_null($user)) {
            \Session::flash('err_msg', config('message.noData'));
            return redirect(route('list'));
        }

        return view('book.detail', ['book' => $book, 'user' => $user]);
    }



    /**
     * 新規投稿画面
     *
     * @return view
     */
    public function bookCreate()
    {
        // 現在ログインしているユーザーのidを取得する
        $user_id = Auth::id();

        return view('book.form', ['user_id' => $user_id]);
    }


    /**
     * 新規投稿
     *
     * @return view
     */
    public function bookPost(BookRequest $request)
    {
        // データを受け取る
        $input = $request->all();

        // 画像データ処理
        $img_name = $request->file('img_name')->store('public');
        $input['img_name'] = str_replace('public/', '', $img_name);

        // DBへ登録する
        $book = new Book();
        $book->newSet($input);

        // フラッシュメッセージ表示
        \Session::flash('err_msg', config('message.complete'));
        //トップページへリダイレクト
        return redirect(route('list'));
    }

    /**
     * 投稿編集画面
     * @param $id
     * @return view
     */
    public function bookEdit($id)
    {
        //データをDBから取得する
        $book = Book::find($id);

        //データの有無を確認
        if (is_null($book)) {
            \Session::flash('err_msg', config('message.noData'));
            return redirect(route('list'));
        }

        return view('book.edit', ['book' => $book]);
    }

    /**
     * 投稿編集
     * @param BookRequest $request
     * @return view
     */
    public function bookUpdate(BookRequest $request)
    {
        // データを受け取る
        $inputs = $request->all();

        // DBへ登録する
        $book = new Book();
        $book->upNewDate($inputs);

        // フラッシュメッセージ表示
        \Session::flash('err_msg', config('message.upDate'));
        // トップページへリダイレクト
        return redirect(route('list'));
    }

    /**
     * 投稿削除
     * @param int $id
     * @return view
     */
    public function bookDelete($id)
    {
        //データの有無の確認
        if (empty($id)) {
            \Session::flash('err_msg', config('noData'));
            return redirect(route('list'));
        }

        // DBから削除する
        $book = new Book();
        $book->dataDelete($id);

        //フラッシュメッセージ表示
        \Session::flash('err_msg', config('message.delete'));
        //トップページへリダイレクト
        return redirect(route('list'));
    }
}
