@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route("printer.index")}}">Imprimantes</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Imprimante</li>
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
            <form action="{{route('printer.updateData',['printer'=>$printer])}}" method="post"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir soumettre ce formulaire ?');">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Modifier imprimante</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="designation" class="form-control-label">Désignation</label>
                                <input class="form-control" type="text" placeholder="Désignation" name="designation"
                                       value="{{$printer->designation}}"
                                       id="designation" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="site" class="form-control-label">Emplacement</label>
                                <input class="form-control" type="text" placeholder="Emplacement" name="site" id="site"
                                       value="{{$printer->site}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="ip" class="form-control-label">Adresse IP</label>
                                <input class="form-control" type="text" placeholder="Adresse IP" name="ip" id="ip"
                                       value="{{$printer->ip}}"
                                       required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="affectation" class="form-control-label">Date Affectation</label>
                                <input class="form-control" type="date"
                                       name="affectation" value="{{\Carbon\Carbon::parse($printer->affectation)->toDateString()}}"
                                       id="affectation" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-neutral">Modifier imprimante</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


