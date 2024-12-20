@extends('backend.layouts.layouts')
@section('article', 'active')
@section('title', 'Modifier un article')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Articles</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
            <li class="breadcrumb-item">Articles</li>
            <li class="breadcrumb-item active">Modifier</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- <div class="card-group"> -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body collapse show">
                    <h4 class="card-title">MODIFIER UN ARTICLE</h4>
                    <hr>
                    <div class="row g-4">
                        <div class="col-12">
                            <form action="{{ route('articles.update', $article->id) }}" method="POST" class="g-3 border p-4 rounded-2" enctype="multipart/form-data" novalidate>
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="row mb-3">
                                    <div class="col-9">
                                        <div class="form-group mb-3">
                                            <label class="col-form-label" for="titre">Titre <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" placeholder="Titre de l'article..." value="{{$article->titre ? $article->titre : old('titre') }}" required>
                                            @error('titre')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="col-form-label" for="contenu">Contenu <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                            <textarea class="form-control @error('contenu') is-invalid @enderror" id="contenu" name="contenu" rows="15" placeholder="Contenu de l'article..." required>{{ $article->content ? $article->content :old('contenu') }}</textarea>
                                            @error('contenu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-3">
                                            <label class="col-form-label" for="categorie">Catégorie <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                            <select class="custom-select @error('categorie') is-invalid @enderror" id="categorie" name="categorie" required>
                                                <option value="">Choisir une catégorie...</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}" @if($categorie->id == $article->id_categorie) selected @endif>{{ $categorie->nom_categorie }}</option>
                                                @endforeach
                                            </select>
                                            @error('categorie')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="col-form-label" for="date_article">Date de publication <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                            <input type="date" class="form-control @error('date_article') is-invalid @enderror" id="date_article" name="date_article" value="{{ $article->date_article ? $article->date_article : old('date_article') }}" required>
                                            @error('date_article')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="col-form-label" for="status">Status <b><span class="me-1 mb-2 text-danger">*</span></b></label>
                                            <select class="custom-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="">Choisir un status...</option>
                                                <option value="1" @if($article->statut) selected="selected" @endif>Publié</option>
                                                <option value="0" @if(!$article->statut) selected="selected" @endif>Brouillon</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="col-form-label">Image</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event)">
                                            <img id="imagePreview" src="{{ asset('images/articles/cover/'.$article->url_img) }}" class="mt-2 mb-2" style="max-width: 100%; border: 1px solid #ddd; padding: 5px;">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Annuler</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@endsection
@section('script')
<!-- TinyMCE -->
<script src="{{ asset('backend/assets/plugins/tinymce/tinymce.min.js') }}"></script>
<!-- ============================================================== -->
<script>
    function previewImage(event) {
        const input = event.target;
        const file = input.files[0];
        if (file.size > 5 * 1024 * 1024) {
            swal({
                title: 'Attention !',
                text: 'L\'image ne doit pas dépasser 5 Mo.',
                icon: 'warning',
                button: 'Fermer'
            });

            input.value = '';
            return;
        }

        const img = new Image();
        img.src = URL.createObjectURL(file);
        img.onload = function() {
            if (img.width < 1920 || img.height < 1080) {
                swal({
                    title: 'Attention !',
                    text: 'Les dimensions de l\'image doivent être de 1920x1080 pixels au minimum.',
                    icon: 'warning',
                    button: 'Fermer'
                });

                input.value = '';
                return;
            }

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
    }

    $(document).ready(function() {
        function f_image_upload_handler (blobInfo, success, failure, progress) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route('article.upload_image') }}');

            xhr.upload.onprogress = function (e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function() {
                var json;

                if (xhr.status === 403) {
                failure('HTTP Error: ' + xhr.status, { remove: true });
                return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                failure('HTTP Error: ' + xhr.status);
                return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
                }

                success(json.location);
            };

            xhr.onerror = function () {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            formData.append('_token', '{{ csrf_token() }}');

            xhr.send(formData);
        };

        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            selector: '#contenu',
            language: 'fr_FR',
            branding: false,
            plugins: 'print preview paste searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable charmap emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table',
            toolbar: 'restoredraft | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap emoticons | fullscreen  preview print | insertfile image media link',
            toolbar_sticky: true,
            image_advtab: false,
            image_caption: true,
            verify_html: false,
            autosave_interval: '30s',
            autosave_prefix: 'tinymce-article-autosave-{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '120m',
            toolbar_mode: 'sliding',
            contextmenu: false,
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            contextmenu: false,
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            relative_urls: false,
            automatic_uploads: true,
            images_upload_handler: f_image_upload_handler,
            remove_script_host: false,
            document_base_url: '{{ config('app.url') }}',
        });
    });
</script>
@endsection
