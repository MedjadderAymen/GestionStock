@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Imprimantes</li>
                            </ol>
                        </nav>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral col-4" data-toggle="modal" data-target="#exampleModal">Ajouter</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered col-9" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter imprimante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("printer.store")}}" onsubmit="return confirm('Êtes-vous sûr de vouloir soumettre ce formulaire ?');">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="designation" class="form-control-label">Désignation</label>
                            <input class="form-control" type="text" placeholder="Désignation" name="designation"
                                   id="designation" required>
                        </div>
                        <div class="form-group">
                            <label for="site" class="form-control-label">Emplacement</label>
                            <input class="form-control" type="text" placeholder="Emplacement" name="site" id="site"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="ip" class="form-control-label">Adresse IP</label>
                            <input class="form-control" type="text" placeholder="Adresse IP" name="ip" id="ip" value="0.0.0.0" required>
                        </div>
                        <div class="form-group">
                            <label for="affectation" class="form-control-label">Date Affectation</label>
                            <input class="form-control" type="date" placeholder="Date Affectation" name="affectation" value="{{now()->toDateString()}}"
                                   id="affectation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Light table -->
                <div id="app_printers">
                    <printers csrf_token="{{csrf_token()}}" v-bind:printers="{{json_encode($printers)}}" role="{{Auth::user()->role}}"></printers>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset("./js/app_printers.js")}}"></script>
@endsection
