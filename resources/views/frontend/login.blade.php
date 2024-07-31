@extends('frontend.layouts.layouts')
@section('content')
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>INSCRIPTION</h2>
        <p>Création de compte profile</p>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mt-lg-0 offset-4 p-2" style="background: #FFF;">

          <form method="post" role="form" class="php-email-form" id="myform">
            <h5><img src="{{ asset('backend/assets/images/logocorus.png')}}" width="50" alt="LOGO">CONNEXION AU PROFILE</h5>
            <hr>
            <div class="form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="*********" required>
              </div>
            <div class="my-3">
              <div class="loading" id="loading">Loading</div>
              <div class="error-message" id="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-left"><button type="button" class="btn-get-started scrollto" id="auth-form" style="width: 100%;">Se connecter</button></div>
            <div class="row mt-3">
                <div class="col-lg-6"><a href="#"><small>Mot de passe oublié?</small></a></div>
                <div class="col-lg-6"><a href="#"><small>Créer un compte</small></a></div>
            </div>
          </form>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->
@endsection
