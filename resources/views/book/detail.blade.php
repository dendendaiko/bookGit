@extends('layouts.app')
@section('title', '進捗管理システム')
@section('content')
<div class="container">
    <div class="set">
        <h1>{{ $book->bookTitle }}</h1>
        <h4>
            @if (!(is_null($user)))
            読者：{{$user->name}}
            @endif
        </h4>
        <h4>作者：{{$book->bookAuthor}}</h4>
        <p>{{$book->note}}</p>

        @if(Auth::id()===$user->id)
        <p><a href="/book/edit/{{ $book->id }}">編集する</a></p>
        <form method=post action="{{ route('bookDelete', $book->id) }}" onSubmit="return checkDelite()">
            @csrf
            <button type=submit onclick="">投稿削除する</button>
        </form>
        @endif

        <p><a href="{{ route('list')}}">戻る</a></p>
    </div>
    <div class="cover">
        <img src="{{ asset('/storage/'.$book->img_name)}}" alt="" width="300px" height="auto">
    </div>
</div>
<script>
    function checkDelite() {
        if (window.confirm('削除してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection
