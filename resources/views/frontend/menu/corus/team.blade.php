@extends('frontend.layouts.layouts')
@section('team', 'actived')
@section('corus', 'active')
@section('content')
<section id="team" class="doctors" style="padding-top: 120px; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2" style="background: #f2f2f2;">
                @include('frontend.layouts.sidebar')
            </div>
            <div class="col-lg-10 mission">
                <h2 class="title" style="text-align: center;">EQUIPE ET EXPERTISE</h2>
                <hr>
                  <div class="row">
                    @foreach($articles as $key => $article)
                    <div class="col-lg-6">
                      <div class="member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('images/articles/cover/'.$article->url_img) }}" class="img-fluid" alt="" style="height: 8rem;"></div>
                        <div class="member-info">
                          <h4><a {{ route('evenement.show', $article->slug) }}>{{ $article->titre }}</a></h4>
                             {!! \Illuminate\Support\Str::limit($article->content, 130, $end = '...') !!}
                        </div>
                      </div>
                    </div>
                    @endforeach

                  </div>
            </div>
        </div>
    </div>
</section>
@endsection
