@extends('frontend.layouts.layouts')
@section($submenu, 'actived')
@section('ressource', 'active')
@section('content')
<section id="events" class="doctors" style="padding-top: 120px; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2" style="background: #f2f2f2;">
                @include('frontend.layouts.sidebar')
            </div>
            <div class="col-lg-10 mission pb-2">
                <h2 class="title" style="text-align: center;">{{ $title }}</h2>
                <hr>
                <div class="row">
                    @if($articles->count()>0)
                        @foreach($articles as $key => $article)
                            <div class="col-lg-4"><img src="{{ asset('images/articles/cover/'.$article->url_img) }}" class="img-fluid" alt=""></div>
                            <div class="col-lg-8">
                                <h4><a href="{{ route('article.show', $article->slug) }}">{{ $article->titre }}</a></h4>
                                <p>{!! \Illuminate\Support\Str::limit($article->content, 400, $end = '...') !!}</p>
                            </div>
                        @endforeach
                    @else
                        <p>Aucune ressource</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
