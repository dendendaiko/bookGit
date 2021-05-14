@extends('layouts.app')
@section('title', '編集')
@section('content')

<div class="container">
    <h1>編集画面</h1>
    <form method=post action="{{ route('bookUpdate') }}" onSubmit="return checkSubmit()">
        @csrf
        <input id="id" type="hidden" name="id" value="{{ $book->id }}">
        <input id="user_id" type="hidden" name="user_id" value="{{ $book->user_id }}">
        <p>作品タイトル</p>
        <input id="bookTitle" type="text" name="bookTitle" value="{{ $book->bookTitle }}">
        @if ($errors->has('bookTitle'))
        {{$errors->first('bookTitle')}}
        @endif

        <p>著者</p>
        <input id="bookAuthor" type="text" name="bookAuthor" value="{{ $book->bookAuthor }}">
        @if ($errors->has('bookAuthor'))
        {{$errors->first('bookAuthor')}}
        @endif

        <p>進捗</p>
        {{Form::select('progress', ['積み本', '途中', '読了！'], $book->progress)}}
        @if ($errors->has('progress'))
        {{$errors->first('progress')}}
        @endif

        <p>媒体</p>
        {{Form::select('media', ['電子', '紙', '青空文庫！'], $book->media)}}
        @if ($errors->has('media'))
        {{$errors->first('media')}}
        @endif


        <p>進捗メモ／感想</p>
        <textarea name="note" cols="30" rows="10">{{ $book->note }}</textarea>
        @if ($errors->has('note'))
        {{$errors->first('note')}}
        @endif

        <p><button type=submit class="btn btn-primary">編集完了</button></p>
        <p><a href="{{ route('list') }}">戻る</a></p>
    </form>
</div>
<script>
    function checkSubmit() {
        if (window.confirm('更新してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection
