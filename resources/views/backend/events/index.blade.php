@extends('backend.layouts.layouts')
@section('event', 'active')
@section('title', 'Evènements')
@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Evènements</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                        <li class="breadcrumb-item">Evènements</li>
                        <li class="breadcrumb-item active">Liste</li>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <div class="row m-b-10">
                                        <div class="col-6">
                                            <h4 class="card-title">Les évènements</h4>
                                            <h6 class="card-subtitle">Surveillance épidémiologique, Urgence, Alerte, ...</h6>
                                        </div>
                                        <div class="col-6 d-flex align-items-center justify-content-end">
                                            <a href="{{ route('events.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-0">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Evênement</th>
                                                <th>Date</th>
                                                <th>Localité</th>
                                                <th>Structure</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($evenements as $evenement)
                                            <tr>
                                                <td>{{ $evenement->libelle }}</td>
                                                <td>{{ $evenement->date_event }}</td>
                                                <td>{{ $evenement->localite->name }}</td>
                                                <td>{{ $evenement->structure->name }}</td>
                                                <td>
                                                    {{-- View button for modal --}}
                                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewEvent{{ $evenement->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <a href="{{ route('events.edit', $evenement->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('events.destroy', $evenement->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection
