@extends('frontend.layouts.layouts')
@section('content')
@section('corus', 'active')
@section('mission', 'actived')
<section id="mission" style="padding-top: 120px; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                @include('frontend.layouts.sidebar')
            </div>
            <div class="col-lg-10 mission" style="background: #f2f2f2; padding: 1rem;">
                <h2 class="title">{{ $article->titre }}</h2>
                <p>{!! $article->content !!}</p>
            </div>
        </div>
    </div>
</section>
@endsection
