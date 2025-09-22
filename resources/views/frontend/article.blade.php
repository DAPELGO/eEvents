@extends('frontend.layouts.layouts')
@section('evenement', 'actived')
@section('urgence', 'active')
@section('content')
<section class="doctors" style="padding-top: 120px; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2" style="background: #f2f2f2;">
                @include('frontend.layouts.sidebar')
            </div>
            <div class="col-lg-10 mission pb-2">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{ asset('images/articles/cover/'.$article->url_img) }}" style="height: 50rem;" alt="ARTICLE IMG">
                    </div>
                    <div class="col-lg-10">
                        <h2 class="title" style="text-align: center;">{{ $article->titre }}</h2>
                    </div>
                </div>
                <hr>
                <h4><a href="#">{{ $article->titre }}</a></h4>
                <p>{!! $article->content !!}</p>
            </div>
        </div>
    </div>
</section>
@endsection
