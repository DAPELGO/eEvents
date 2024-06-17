@extends('frontend.layouts.layouts')
@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container" style="z-index: 1; text-align:center;">
    <div class="row">
      <div class="col-lg-6 offset-3" style="margin-top: 5rem;">
          <h1>Alertes ou urgences en cours </h1>
          <!-- ======= Testimonials Section ======= -->
          <div id="testimonials" class="testimonials">
              <div class="container">
                  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                      <div class="swiper-wrapper">
                      <div class="swiper-slide">
                          <div class="testimonial-wrap">
                          <div class="testimonial-item">
                              <h2>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</h2>
                              <a href="#about" class="btn-get-started scrollto">En savoir plus</a>
                          </div>
                          </div>
                      </div><!-- End testimonial item -->

                      <div class="swiper-slide">
                          <div class="testimonial-wrap">
                          <div class="testimonial-item">
                              <h2>
                              Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                              </h2>
                              <a href="#about" class="btn-get-started scrollto">En savoir plus</a>
                          </div>
                          </div>
                      </div><!-- End testimonial item -->

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
                <div class="col-xl-3 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <img src="{{ asset('frontend/assets/img/urgence1.jpg') }}" alt="URGENCE">
                    <h4>Urgence 1</h4>
                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                  </div>
                </div>
                <div class="col-xl-3 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <img src="{{ asset('frontend/assets/img/urgence2.jpeg') }}" alt="URGENCE">
                    <h4>Urgence 2</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                  </div>
                </div>
                <div class="col-xl-3 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <img src="{{ asset('frontend/assets/img/urgence3.jpeg') }}" alt="URGENCE">
                    <h4>Urgence 3</h4>
                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                  </div>
                </div>
                <div class="col-xl-3 d-flex align-items-stretch">
                    <div class="icon-box mt-4 mt-xl-0">
                      <img src="{{ asset('frontend/assets/img/urgence4.jpeg') }}" alt="URGENCE">
                      <h4>Urgence 4</h4>
                      <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                    </div>
                  </div>
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

            <div class="col-lg-3 col-md-6">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
                <p>Doctors</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
                <p>Departments</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
                <p>Research Labs</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
                <p>Awards</p>
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

                      <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
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
                            <input type="date" name="date" class="form-control datepicker" id="date" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                          </div>
                          <div class="col-md-4 form-group mt-3">
                            <select name="department" id="department" class="form-select">
                              <option value="">Catégorie</option>
                              <option value="Department 1">Department 1</option>
                              <option value="Department 2">Department 2</option>
                              <option value="Department 3">Department 3</option>
                            </select>
                            <div class="validate"></div>
                          </div>
                          <div class="col-md-4 form-group mt-3">
                            <select name="doctor" id="doctor" class="form-select">
                              <option value="">Localité</option>
                              <option value="Doctor 1">Doctor 1</option>
                              <option value="Doctor 2">Doctor 2</option>
                              <option value="Doctor 3">Doctor 3</option>
                            </select>
                            <div class="validate"></div>
                          </div>
                        </div>

                        <div class="form-group mt-3">
                          <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
                          <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                          <div class="loading">Loading</div>
                          <div class="error-message"></div>
                          <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">ENvoyer</button></div>
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
            <h2>Actualités</h2>
          </div>

          <div class="row">

            <div class="col-lg-3">
                <div class="member">
                    <img src="{{ asset('frontend/assets/img/corus.png') }}" class="img-fluid" alt="">
                    <h4>Santé au Burkina : Le Centre des opérations de réponse...</h4>
                    <span><small>{{ date('d/m/Y') }}</small></span>
                    <p>Le Burkina Faso dispose désormais d’un Centre des opérations de réponse aux urgences sanitaires (CORUS).
                        Bâti sur l’ex-siège de l’Organisation mondiale de la santé...
                    </p>
                    <a href="#" class="btn">Lire la suite <i class="bi bi-chevron-right"></i></a>
                </div>

            </div>

            <div class="col-lg-3 mt-0 mt-lg-0">
                <div class="member">
                    <img src="{{ asset('frontend/assets/img/news1.jpg') }}" class="img-fluid" alt="">
                    <h4>Dengue au Burkina Faso : La tendance des cas en...</h4>
                    <span><small>{{ date('d/m/Y') }}</small> | Anesthesiologist</span>
                    <p>Dr Joseph Soubeiga, médecin épidémiologiste et bio statisticien,
                        Directeur du Centre des opérations de réponse aux urgences sanitaires (CORUS) a présenté la situation
                        de...
                    </p>
                        <a href="#" class="btn">Lire la suite <i class="bi bi-chevron-right"></i></a>
                </div>


            </div>

            <div class="col-lg-3 mt-0">
                <div class="member">
                    <img src="{{ asset('frontend/assets/img/news2.jpg') }}" class="img-fluid" alt="">
                    <h4>Burkina Faso : Un centre de santé pour Zékézé </h4>
                    <span><small>{{ date('d/m/Y') }}</small> | Cardiology</span>
                    <p>Le samedi 12 septembre 2020, Zékézé dans commune de Bittou province du Boulgou,
                        a bénéficié d’un centre de santé et de promotion sociale. Financé par le budget de...
                    </p>
                    <a href="#" class="btn">Lire la suite <i class="bi bi-chevron-right"></i></a>
                </div>

            </div>

            <div class="col-lg-3 mt-0">
                <div class="member">
                    <img src="{{ asset('frontend/assets/img/news3.jpg') }}" class="img-fluid" alt="">
                    <h4>Covid-19 : L’Organisation Ouest-africaine de la Santé offre...</h4>
                    <span><small>{{ date('d/m/Y') }}</small> | Neurosurgeon</span>
                    <p>La CEDEAO, à travers son institution spécialisée qu’est l’Organisation Ouest-africaine de la Santé (OOAS),
                        a procédé, ce 8 avril 2020, à la remise d’un don au... </p>
                        <a href="#" class="btn">Lire la suite <i class="bi bi-chevron-right"></i></a>
                </div>

            </div>

          </div>

        </div>
      </section><!-- End Doctors Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Partenaires</h2>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-heartbeat"></i></div>
              <h4><a href="">MINISTERE DE LA SANTE ET DE L'HYGIENE PUBLIQUE</a></h4>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-pills"></i></div>
              <h4><a href="">INSTITUT NATIONAL DE SANTE PUBLIQUE du BURKINA FASO</a></h4>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">BANQUE MONDIALE</a></h4>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-dna"></i></div>
              <h4><a href="">AGENCE NATIONALE DE PROMOTION DES TIC</a></h4>
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
                        <i class="bx bx-mobile-vibration icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Outils de communications<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                          <p>
                            Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                          </p>
                        </div>
                      </li>
                      <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Exercices de simulations<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
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
            <p>Envoyer un message àl'équipe de CORUS</p>
          </div>
        </div>
        <div>
          <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
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

              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Envoyer Message</button></div>
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

