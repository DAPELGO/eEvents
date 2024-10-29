@extends('frontend.layouts.layouts')
@section('accueil', 'active')
@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container" style="z-index: 1; text-align:center;">
    <div class="row">
      <div class="col-lg-6 offset-3" style="margin-top: 5rem;">
          <h1>Actualités corus </h1>
          <!-- ======= Testimonials Section ======= -->
          <div id="testimonials" class="testimonials">
              <div class="container">
                  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                      <div class="swiper-wrapper">
                        @foreach($actus as $actu)
                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <h2>{{ $actu->titre }}</h2>
                                <a href="{{ route('article.show', $actu->slug)}}" class="btn-get-started scrollto">En savoir plus</a>
                            </div>
                            </div>
                        </div><!-- End testimonial item -->
                        @endforeach
                      </div>
                  </div>
              </div>
          </div><!-- End Testimonials Section -->
      </div>
  </div>
  </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us" style="padding-bottom: 0;">
      <div class="container">
        <div class="row">

          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="icon-boxes d-flex justify-content-center">
              <div class="row">
                @foreach($urgences as $urgence)
                <div class="col-xl-3 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <img src="{{ asset('images/events/'.$urgence->url_img) }}" alt="URGENCE">
                    <h4>{{ $urgence->libelle }}</h4>
                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                  </div>
                </div>
                @endforeach
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts" style="padding-top: 0;">
        <div class="container">

          <div class="row">

            <div class="col-lg-2 col-md-6">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="19" data-purecounter-duration="1" class="purecounter"></span>
                <p>Nombre d’activation total</p>
              </div>
            </div>

            <div class="col-lg-2 col-md-6 mt-5 mt-md-0">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
                <p>Régions à défis sécuritaires et humanitaires</p>
              </div>
            </div>

            <div class="col-lg-2 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="1018" data-purecounter-duration="1" class="purecounter"></span>
                <p>Nombre de formés en Système des Gestions d’Incident de base </p>
              </div>
            </div>

            <div class="col-lg-2 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="128" data-purecounter-duration="1" class="purecounter"></span>
                <p>Nombre de formés en Système des Gestions d’Incident intermédiaire </p>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                  <span data-purecounter-start="0" data-purecounter-end="09" data-purecounter-duration="1" class="purecounter"></span>
                  <p>Nombre de formés en Système des Gestions d’Incident niveau avancé </p>
                </div>
              </div>
              <div class="col-lg-2 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                  <span data-purecounter-start="0" data-purecounter-end="4" data-purecounter-duration="1" class="purecounter"></span>
                  <p>Nombre d’exercices de simulation grandeur nature</p>
                </div>
              </div>
          </div>
        </div>
      </section><!-- End Counts Section -->

      <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>Déclarer une alerte ou une urgence</h2>
                        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                      </div>

                      <form action="#" method="post" role="form" class="php-email-form">
                        <div class="row">
                          <div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nom" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                          </div>
                          <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email">
                            <div class="validate"></div>
                          </div>
                          <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="+226 06004422" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 form-group mt-3">
                            <input type="date" name="date_event" class="form-control datepicker" id="date_event" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                          </div>
                          <div class="col-md-4 form-group mt-3">
                            <select id="id_categorie" name="id_categorie" class="form-select">
                              <option value="">Catégorie</option>
                              @foreach($categories as $categorie)
                                <option value="{{ $categorie->id}}">{{ $categorie->nom_categorie }}</option>
                              @endforeach
                            </select>
                            <div class="validate"></div>
                          </div>
                          <div class="col-md-4 form-group mt-3">
                            <select name="id_localite" id="id_localite" class="form-select">
                              <option value="">Localité</option>
                              @foreach($structures as $structure)
                                <option value="{{ $structure->id}}">{{ $structure->nom_structure }}</option>
                              @endforeach
                            </select>
                            <div class="validate"></div>
                          </div>
                        </div>

                        <div class="form-group mt-3">
                          <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)" id="message"></textarea>
                          <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                          <div class="loading" id="loading">Loading</div>
                          <div class="error-message" id="error-message"></div>
                          <div class="sent-message" id="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="button" id="btn-event">Envoyer</button></div>
                      </form>
                </div>
                <div class="col-lg-6 text-center pt-5">
                    <img src="{{ asset('frontend/assets/img/alert.png') }}"alt="">
                </div>
            </div>
        </div>
      </section><!-- End Appointment Section -->


      <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
        <div class="container">

          <div class="section-title">
            <h2>L'Actualité du Centre</h2>
          </div>

          <div class="row">
            @foreach($actus as $actu)


            <div class="col-lg-3">
                <div class="member">
                    <img src="{{ asset('images/articles/cover/'.$actu->url_img) }}" class="img-fluid" alt="">
                    <h4>{{ $actu->titre }}</h4>
                    <span><small>{{ date('d/m/Y') }}</small></span>
                    <p>{!! $actu->titre !!}
                    </p>
                    <a href="{{ route('article.show', $actu->slug)}}" class="btn">Lire la suite <i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
            @endforeach
          </div>

        </div>
      </section><!-- End Doctors Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2 class="text-uppercase">Les Partenaires du CORUS</h2>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-6 align-items-stretch" style="border: 2px solid #fff; border-right: 0;">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset('frontend/assets/img/burkina.webp') }}" alt="MSHP"></div>
              <h4><a href="https://sante.bf" target="_blank">MINISTERE DE LA SANTE ET DE L'HYGIENE PUBLIQUE</a></h4>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 align-items-stretch" style="border: 2px solid #fff; border-right: 0;">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset('frontend/assets/img/insp.png') }}" alt="INSP"></div>
              <h4><a href="https://insp.bf/" target="_blank">INSTITUT NATIONAL DE SANTE PUBLIQUE du BURKINA FASO</a></h4>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 align-items-stretch" style="border: 2px solid #fff; border-right: 0;">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset('frontend/assets/img/bm.png') }}" alt="BM"></div>
              <h4><a href="https://www.banquemondiale.org/fr/home" target="_blank">BANQUE MONDIALE</a></h4>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 align-items-stretch" style="border: 2px solid #fff;">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset('frontend/assets/img/logo_anptic_ok.png') }}" alt="ANPTIC"></div>
              <h4><a href="" target="_blank">AGENCE NATIONALE DE PROMOTION DES TIC</a></h4>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="faq-list">
                    <ul>
                      <li data-aos="fade-up">
                        <i class="bx bx-home icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Le CORUS <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-1" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                          </p>
                        </div>
                      </li>

                      <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-user-voice icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Urgences de santé publique<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                          </p>
                        </div>
                      </li>

                      <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-error icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Prévention et préparation aux urgences de santé publique<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                          </p>
                        </div>
                      </li>

                      <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-folder icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Ressources documentaires<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                          </p>
                        </div>
                      </li>
                    </ul>
                  </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-list">
                    <ul>
                      <li data-aos="fade-up">
                        <i class="bx bx-phone icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-5">Contact et assistance<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                          </p>
                        </div>
                      </li>
                      <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-book-reader icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">Gestions des recrutements, formations et des intervenants<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                          </p>
                        </div>
                      </li>
                      <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-mobile-vibration icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">Outils de communications<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                          </p>
                        </div>
                      </li>
                      <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-8" class="collapsed">Exercices de simulations<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                          </p>
                        </div>
                      </li>
                    </ul>
                  </div>
            </div>
        </div>
      </div>
    </section><!-- End Frequently Asked Questions Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <h2>Contacter le CORUS</h2>
            <p>Envoyer un message à l'équipe de CORUS</p>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="info">
                <div class="address">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Localisation:</h4>
                  <p>BP 10 278 Ouagadougou Zogona</p>
                </div>
                <div class="email">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>secretariat.dg@insp.bf</p>
                </div>
                <div class="phone">
                  <i class="bi bi-phone"></i>
                  <h4>Téléphone:</h4>
                  <p>+226 01 90 58 58</p>
                </div>
                <div class="phone">
                    <i class="bi bi-phone-vibrate"></i>
                    <h4>Urgence</h4>
                    <p>3535</p>
                  </div>

              </div>

            </div>

            <div class="col-lg-8 mt-5 mt-lg-0">

              <form method="post" role="form" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name_contact" class="form-control" id="name_contact" placeholder="Nom" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email_contact" id="email_contact" placeholder="Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Objet" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message_contact" id="message_contact" rows="5" placeholder="Message" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading-contact">Loading</div>
                  <div class="error-message-contact"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="button" id="btn-contact">Envoyer Message</button></div>
              </form>

            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->



    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>Gallery photo</h2>
          <p>Le CORUS en images</p>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/news1.jpg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/news1.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/news2.jpg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/news2.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/urgence1.jpg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/urgence1.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/urgence2.jpeg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/urgence2.jpeg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/urgence3.jpeg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/urgence3.jpeg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/urgence4.jpeg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/urgence4.jpeg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/gallery/gallery-7.jpg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/gallery/gallery-7.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('frontend/assets/img/gallery/gallery-8.jpg') }}" class="galelry-lightbox">
                <img src="{{ asset('frontend/assets/img/gallery/gallery-8.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Section -->



  </main><!-- End #main -->
  @endsection

