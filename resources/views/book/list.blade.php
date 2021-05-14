@extends('layout')
@section('title', '進捗管理システム')
@section('content')

<div class="container">
    <!-- フラッシュメッセージ -->
    @if (session('err_msg'))
    <div class="err_msg">
        {{ session('err_msg') }}
    </div>
    @endif
    <!-- フラッシュここまで -->
    <h1>積み本進捗管理</h1>
    <p><a href="{{ route('bookCreate') }}">新規投稿</a></p>
    <!-- 絞り込みフォーム -->
    <div class="search">
        {{Form::text('search_name', null, ['id'=>'search_name', 'placeholder'=>'絞り込み', 'size'=>30, 'value'=>'search_name'])}}
        {{Form::button('更新', ['id'=>'search_on', 'type'=>'button'])}}
    </div>
    <!-- フォームここまで -->
    <table class="table-sm">
        <tr>
            <th></th>
            <th>タイトル</th>
            <th>作者</th>
            <th>進捗</th>
        </tr>
        @foreach($books as $book)
        <tr>
            <td><a href="/book/{{ $book->id }}">▼</a></td>
            <td>{{ $book->bookTitle }}</td>
            <td>{{ $book->bookAuthor}}</td>
            <td>
                @if ($book->progress === 2)
                    読了！
                @elseif($book->user_id === $user)
                    <a href="/book/edit/{{ $book->id }}">未読</a>
                @else
                    未読
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <br>
</div>





@endsection

