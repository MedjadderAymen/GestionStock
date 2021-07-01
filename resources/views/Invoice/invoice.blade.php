@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Factures</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route("invoice.index")}}">Factures</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Ajouter Factures</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class=" col ">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Nouvelle facture</h3>
                </div>
                <div id="app">
                    <invoice csrf_token="{{csrf_token()}}" v-bind:materials="{{ json_encode($products) }}"></invoice>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset("./js/app.js")}}"></script>

@endsection

