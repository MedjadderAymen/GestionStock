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
                                <li class="breadcrumb-item"><a href="{{route("printer.index")}}">Imprimantes</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$printer->designation}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Consommés</h5>
                                        <span
                                            class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Magenta',$consumableTonersColors))
                                                {{$consumableTonersColors['Magenta']}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Stocké</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Magenta',$printerColors))
                                                {{$printerColors['Magenta']}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape text-white rounded-circle shadow"
                                             style="background: magenta; cursor: pointer"
                                             onclick="event.preventDefault(); document.getElementById('addMagenta-form').submit();">
                                            <i class="ni ni-send"></i>
                                        </div>
                                        <form id="addMagenta-form" method="post"
                                              action="{{route('consumableToner.store')}}">
                                            @csrf
                                            <input type="hidden" value="Magenta" name="color">
                                            <input type="hidden" value="{{$printer->id}}" name="printer">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <p class="mt-0 mb-3 text-sm">
                                    <a class="text-black-50 btn-block" style="cursor: pointer" data-toggle="modal"
                                       data-target="#magentaModel"><i class="ni ni-fat-add"></i>Ajouter</a>
                                </p>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="magentaModel" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered col-9" role="document">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Toners - Magenta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{route("printer.update",['printer'=> $printer])}}">
                                        @csrf
                                        @method('PUT')
                                        <input value="megenta" name="color" type="hidden">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="reference" class="form-control-label">Réference</label>
                                                <select class="form-control" id="reference" name="reference" required>
                                                    @foreach($magentas as $magenta)
                                                        <option value="{{$magenta->id}}">{{$magenta->reference}}
                                                            - {{$magenta->quantity}} piéces
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="magentas_quantity"
                                                       class="form-control-label">Quantité</label>
                                                <input id="magentas_quantity" type="number" placeholder="Quantité"
                                                       class="form-control" name="quantity">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Consommés</h5>
                                        <span
                                            class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Cyan',$consumableTonersColors))
                                                {{$consumableTonersColors['Cyan']}}
                                            @else
                                                0
                                            @endif</span>
                                    </div>
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Stocké</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Cyan',$printerColors))
                                                {{$printerColors['Cyan']}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape text-white rounded-circle shadow"
                                             style="background: cyan; cursor: pointer"
                                             onclick="event.preventDefault(); document.getElementById('addCyan-form').submit();">
                                            <i class="ni ni-send"></i>
                                        </div>
                                        <form id="addCyan-form" method="post"
                                              action="{{route('consumableToner.store')}}">
                                            @csrf
                                            <input type="hidden" value="Cyan" name="color">
                                            <input type="hidden" value="{{$printer->id}}" name="printer">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <p class="mt-0 mb-3 text-sm">
                                    <a class="text-black-50 btn-block" style="cursor: pointer" data-toggle="modal"
                                       data-target="#cyanModel"><i class="ni ni-fat-add"></i>Ajouter</a>
                                </p>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="cyanModel" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered col-9" role="document">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Toners - Cyan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{route("printer.update",['printer'=> $printer])}}">
                                        @csrf
                                        @method('PUT')
                                        <input value="cyan" name="color" type="hidden">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="reference" class="form-control-label">Réference</label>
                                                <select class="form-control" id="reference" name="reference" required>
                                                    @foreach($cyans as $cyan)
                                                        <option value="{{$cyan->id}}">{{$cyan->reference}}
                                                            - {{$cyan->quantity}} piéces
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cyan_quantity" class="form-control-label">Quantité</label>
                                                <input id="cyan_quantity" type="number" placeholder="Quantité"
                                                       class="form-control" name="quantity">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Consommés</h5>
                                        <span
                                            class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Jaune',$consumableTonersColors))
                                                {{$consumableTonersColors['Jaune']}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Stocké</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Jaune',$printerColors))
                                                {{$printerColors['Jaune']}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape text-white rounded-circle shadow"
                                             style="background: yellow; cursor: pointer"
                                             onclick="event.preventDefault(); document.getElementById('addYellow-form').submit();">
                                            <i class="ni ni-send"></i>
                                        </div>
                                        <form id="addYellow-form" method="post"
                                              action="{{route('consumableToner.store')}}">
                                            @csrf
                                            <input type="hidden" value="Jaune" name="color">
                                            <input type="hidden" value="{{$printer->id}}" name="printer">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <p class="mt-0 mb-3 text-sm">
                                    <a class="text-black-50 btn-block" style="cursor: pointer" data-toggle="modal"
                                       data-target="#yellowModel"><i class="ni ni-fat-add"></i>Ajouter</a>
                                </p>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="yellowModel" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered col-9" role="document">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Toners - Jaune</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{route("printer.update",['printer'=> $printer])}}">
                                        @csrf
                                        @method('PUT')
                                        <input value="yellow" name="color" type="hidden">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="reference" class="form-control-label">Réference</label>
                                                <select class="form-control" id="reference" name="reference" required>
                                                    @foreach($yellows as $yellow)
                                                        <option value="{{$yellow->id}}">{{$yellow->reference}}
                                                            - {{$yellow->quantity}} piéces
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="yellow_quantity" class="form-control-label">Quantité</label>
                                                <input id="yellow_quantity" type="number" placeholder="Quantité"
                                                       class="form-control" name="quantity">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Consommés</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Noir',$consumableTonersColors))
                                                {{$consumableTonersColors['Noir']}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Stocké</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if(array_key_exists('Noir',$printerColors))
                                                {{$printerColors['Noir']}}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape text-white rounded-circle shadow"
                                             style="background: black; cursor: pointer"
                                             onclick="event.preventDefault(); document.getElementById('addBlack-form').submit();">
                                            <i class="ni ni-send"></i>
                                        </div>
                                        <form id="addBlack-form" method="post"
                                              action="{{route('consumableToner.store')}}">
                                            @csrf
                                            <input type="hidden" value="Noir" name="color">
                                            <input type="hidden" value="{{$printer->id}}" name="printer">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <p class="mt-0 mb-3 text-sm">
                                    <a class="text-black-50 btn-block" style="cursor: pointer" data-toggle="modal"
                                       data-target="#blackModel"><i class="ni ni-fat-add"></i>Ajouter</a>
                                </p>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="blackModel" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered col-9" role="document">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Toners - Noir</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{route("printer.update",['printer'=> $printer])}}">
                                        @csrf
                                        @method('PUT')
                                        <input value="black" name="color" type="hidden">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="reference" class="form-control-label">Réference</label>
                                                <select class="form-control" id="reference" name="reference" required>
                                                    @foreach($blacks as $black)
                                                        <option value="{{$black->id}}">{{$black->reference}}
                                                            - {{$black->quantity}} piéces
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="yellow_quantity" class="form-control-label">Quantité</label>
                                                <input id="yellow_quantity" type="number" placeholder="Quantité"
                                                       class="form-control" name="quantity">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Log de Consommation</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Référence Toner</th>
                            <th scope="col">Couleur</th>
                            <th scope="col">Par</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($consumableToners as $consumableToner)
                            <tr>
                                <th scope="row">
                                    {{$consumableToner->reference}}
                                </th>
                                <td>
                                    {{$consumableToner->color}}
                                </td>
                                <td>
                                    {{$consumableToner->helpDesk->user->name}}
                                </td>
                                <td>
                                    <i class="fas fa-calendar"></i> {{\Carbon\Carbon::parse($consumableToner->created_at)->diffForHumans()}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$consumableToners->links()}}
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Toners</h6>
                            <h5 class="h3 mb-0">Consommation totale</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="toner-bar" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        var lables = [];
        var data = [];

        @foreach($consumableTonersChart as $consumableTonersMonth => $consumableTonersData)

        lables.push('{{$consumableTonersMonth}}')
        data.push({{count($consumableTonersData)}})

        @endforeach

        var ctx = document.getElementById("toner-bar");

        var myBarsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lables,
                datasets: [{
                    label: 'Consommation',
                    data: data,
                    borderWidth: 1
                }]
            },
        });

    </script>
@endsection
