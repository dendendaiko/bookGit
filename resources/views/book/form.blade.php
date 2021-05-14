@extends('layouts.app')
@section('title', '新規投稿')
@section('content')
<div class="container">
    <h1>新規投稿</h1>
    <form enctype="multipart/form-data" method=post action="{{ route('newPost') }}" onSubmit="return checkSubmit()">
        @csrf
        <p>作品タイトル</p>
        <input id="bookTitle" type="text" name="bookTitle" value="{{ old('bookTitle') }}" >
        @if ($errors->has('bookTitle'))
        {{$errors->first('bookTitle')}}
        @endif

        <p>著者</p>
        <input id="bookAuthor" type="text" name="bookAuthor" value="{{ old('bookAuthor') }}" >
        @if ($errors->has('bookAuthor'))
        {{$errors->first('bookAuthor')}}
        @endif

        <p>進捗</p>
        <select name="progress" id="">
            <option value="0">積み本</option>
            <option value="1">途中</option>
            <option value="2">読了！</option>
        </select>
        @if ($errors->has('progress'))
        {{$errors->first('progress')}}
        @endif

        <p>媒体</p>
        <select name="media" id="">
            <option value="0">電子</option>
            <option value="1">紙</option>
            <option value="2">青空文庫</option>
        </select>
        @if ($errors->has('media'))
        {{$errors->first('media')}}
        @endif

        <p>進捗メモ／感想</p>
        <textarea name="note" cols="30" rows="10"></textarea>
        @if ($errors->has('note'))
        {{$errors->first('note')}}
        @endif

        @if (Auth::check())
        <p>表紙</p>
        <input id="img_name" type="file" name="img_name" accept="image/*" value="{{ old('img_name') }}">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
            @if ($errors->has('img_name'))
            {{$errors->first('img_name')}}
            @endif
        @endif

        <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
        @if ($errors->has('user_id'))
        {{$errors->first('user_id')}}
        @endif



        <p><button type=submit class="btn btn-primary">投稿する</button></p>
        <p><a href="{{ route('list') }}">戻る</a></p>

    </form>

</div>
<script>
    function checkSubmit() {
        if (window.confirm('投稿してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }


    
</script>
@endsection
