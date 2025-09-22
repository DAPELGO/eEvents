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
      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Localisation:</h4>
              <p>A108 Trypano, Ouagadougou</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>info@corus.bf</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Téléphone:</h4>
              <p>+226 06002255</p>
            </div>
            <div class="phone">
                <i class="bi bi-phone-vibrate"></i>
                <h4>Urgence</h4>
                <p>3535</p>
              </div>

          </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">

          <form action="{{ route('inscription.store') }}" method="post" role="form" class="php-email-form">
            @csrf
            <div class="form-group">
                <input type="text" name="nom_prenom" class="form-control" id="nom_prenom" placeholder="Nom & Prénom" required>
            </div>
            <div class="form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                  <input type="password" name="password" class="form-control" id="password" placeholder="*********" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="*******" required>
                </div>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">S'inscrire</button></div>
          </form>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->
@endsection