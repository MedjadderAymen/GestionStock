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
                                <li class="breadcrumb-item"><a href="{{route("stock.index")}}">Parc</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Détail Matériel</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a onclick="event.preventDefault(); document.getElementById('delete-material-form').submit();"
                           class="btn btn-sm btn-danger col-4 text-white">Supprimer</a>
                        <form id="delete-material-form" action="{{route('stock.destroy',['stock'=>$inStockProduct])}}"
                              method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class=" col ">
            <form action="{{route('stock.update',['stock'=>$inStockProduct])}}" method="post">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Matériel:
                            <strong>{{$inStockProduct->class}}</strong>
                            [{{$inStockProduct->zi}}]
                            @if(isset($inStockProduct->employer) )
                                <span class="badge badge-dot mr-4">
                                <i class="bg-success"></i>
                                <span class="status"></span>
                            </span>
                            @else
                                <span class="badge badge-dot mr-4">
                                <i class="bg-danger"></i>
                                <span class="status"></span>
                            </span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($inStockProduct->class === 'phone' && isset($inStockProduct->employer->user))
                            <div class="row">
                                <div class="form-group col-lg-3 col-sm-6">
                                    <label for="zi" class="form-control-label">Zi</label>
                                    <input class="form-control" type="text" placeholder="Zi"
                                           name="zi" value="{{$inStockProduct->zi}}"
                                           id="zi">
                                </div>
                                <div class="form-group col-lg-3 col-sm-6">
                                    <label for="invoice" class="form-control-label">Facture</label>
                                    <input class="form-control" type="text" placeholder="Facture"
                                           name="invoice" value="{{$inStockProduct->invoice}}"
                                           id="invoice">
                                </div>
                                <div class="form-group col-lg-3 col-sm-12">
                                    <label for="employer" class="form-control-label">Affecté à</label>
                                    <select class="form-control" id="employer" name="user">
                                        @if(isset($inStockProduct->employer->user))
                                            <optgroup label="Autres">
                                                <option value="null">Non Affecté</option>
                                            </optgroup>
                                            <optgroup label="Employers">
                                                @foreach($users as $user)
                                                    <option
                                                        @if($user->id == $inStockProduct->employer->user->id)
                                                        selected
                                                        @endif
                                                        value="{{$user->id}}"
                                                    >
                                                        {{$user->name}}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <optgroup label="Autres">
                                                <option value="null">Non Affecté</option>
                                            </optgroup>
                                            <optgroup label="Employers">
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-lg-3 col-sm-6">
                                    <label for="phone_number" class="form-control-label">Numéro Tléléphone</label>
                                    <input disabled class="form-control" type="text" placeholder="Numéro Tléléphone"
                                           name="phone_number" value="{{$inStockProduct->employer->user->phone_number}}"
                                           id="phone_number">
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="zi" class="form-control-label">Zi</label>
                                    <input class="form-control" type="text" placeholder="Zi"
                                           name="zi" value="{{$inStockProduct->zi}}"
                                           id="zi">
                                </div>
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="invoice" class="form-control-label">Facture</label>
                                    <input class="form-control" type="text" placeholder="Facture"
                                           name="invoice" value="{{$inStockProduct->invoice}}"
                                           id="invoice">
                                </div>
                                <div class="form-group col-lg-4 col-sm-12">
                                    <label for="employer" class="form-control-label">Affecté à</label>
                                    <select class="form-control" id="employer" name="user">
                                        @if(isset($inStockProduct->employer->user))
                                            <optgroup label="Autres">
                                                <option value="null">Non Affecté</option>
                                            </optgroup>
                                            <optgroup label="Employers">
                                                @foreach($users as $user)
                                                    <option
                                                        @if($user->id == $inStockProduct->employer->user->id)
                                                        selected
                                                        @endif
                                                        value="{{$user->id}}"
                                                    >
                                                        {{$user->name}}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <optgroup label="Autres">
                                                <option value="null">Non Affecté</option>
                                            </optgroup>
                                            <optgroup label="Employers">
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="constructor" class="form-control-label">Constructeur</label>
                                <input class="form-control" type="text" placeholder="Constructeur" name="constructor"
                                       value="{{$inStockProduct->constructor}}"
                                       id="constructor" required>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="model" class="form-control-label">Modele</label>
                                <input class="form-control" type="text" placeholder="Modele"
                                       name="model" value="{{$inStockProduct->model}}"
                                       id="model" required>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="serial_number" class="form-control-label">Numéro de série</label>
                                <input class="form-control" type="text" placeholder="Numéro de série"
                                       name="serial_number" value="{{$inStockProduct->serial_number}}"
                                       id="serial_number" required>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="status" class="form-control-label">Etat</label>
                                <select class="form-control" id="status" name="status" required>
                                    @foreach(['neuf','bon','moyen','hors service'] as $status)
                                        <option
                                            @if($inStockProduct->status === $status)
                                            selected
                                            @endif
                                            value="{{$status}}"
                                        >
                                            {{$status}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr class="my-1"/>
                        @switch($inStockProduct->class)
                            @case("laptop")
                            <div class="row">
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="vc" class="form-control-label">VC</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">VC</span>
                                        </div>
                                        <input type="number" max="9999" value="{{$inStockProduct->laptop->vc}}" required
                                               class="form-control" id="vc" name="vc">
                                        <div class="input-group-append">
                                            <span class="input-group-text">L</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-sm-6">
                                    <label for="cpu" class="form-control-label">Cpu</label>
                                    <input class="form-control" type="text" placeholder="cpu" name="cpu"
                                           value="{{$inStockProduct->laptop->cpu}}"
                                           id="cpu" required>
                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="ram" class="form-control-label">Ram</label>
                                    <input class="form-control" type="text" placeholder="Ram"
                                           name="ram" value="{{$inStockProduct->laptop->ram}}"
                                           id="ram" required>
                                </div>
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="disk" class="form-control-label">Disque</label>
                                    <input class="form-control" type="text" placeholder="Disque"
                                           name="disk" value="{{$inStockProduct->laptop->disk}}"
                                           id="disk" required>
                                </div>
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="screen" class="form-control-label">Ecran</label>
                                    <input class="form-control" type="text" placeholder="Ecran"
                                           name="screen" value="{{$inStockProduct->laptop->screen}}"
                                           id="screen" required>
                                </div>

                            </div>
                            @break

                            @case("desktop")
                            <div class="row">
                                <div class="form-group col-lg-3 col-sm-12">
                                    <label for="vc" class="form-control-label">VC</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">VC</span>
                                        </div>
                                        <input type="number" max="9999" value="{{$inStockProduct->desktop->vc}}"
                                               required class="form-control" id="vc" name="vc">
                                        <div class="input-group-append">
                                            <span class="input-group-text">D</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3 col-sm-6">
                                    <label for="cpu" class="form-control-label">Cpu</label>
                                    <input class="form-control" type="text" placeholder="cpu" name="cpu"
                                           value="{{$inStockProduct->desktop->cpu}}"
                                           id="cpu" required>
                                </div>
                                <div class="form-group col-lg-3 col-sm-6">
                                    <label for="ram" class="form-control-label">Ram</label>
                                    <input class="form-control" type="text" placeholder="Ram"
                                           name="ram" value="{{$inStockProduct->desktop->ram}}"
                                           id="ram" required>
                                </div>
                                <div class="form-group col-lg-3 col-sm-6">
                                    <label for="disk" class="form-control-label">Disque</label>
                                    <input class="form-control" type="text" placeholder="Disque"
                                           name="disk" value="{{$inStockProduct->desktop->disk}}"
                                           id="disk" required>
                                </div>
                            </div>
                            @break

                            @case("screen")
                            <div class="row">
                                <div class="form-group col-lg-12 col-sm-6">
                                    <label for="screen" class="form-control-label">Ecran</label>
                                    <input class="form-control" type="text" placeholder="Ecran"
                                           name="screen" value="{{$inStockProduct->screen->screen}}"
                                           id="screen" required>
                                </div>
                            </div>
                            @break

                            @case('phone')
                            <div class="row">
                                <div class="form-group col-lg-1 col-sm-12">
                                    <div>
                                        <label for="cession" class="form-control-label">Cession?</label>
                                    </div>
                                    <label class="custom-toggle btn-block">
                                        <input id="cession" name="cession" type="checkbox"
                                               @if($inStockProduct->phone->cession)
                                               checked
                                            @endif
                                        >
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Non"
                                              data-label-on="Oui"></span>
                                    </label>
                                </div>
                            </div>
                            @break

                            @case('ipad')
                            <div class="row">
                                <div class="form-group col-lg-12 col-sm-6">
                                    <label for="dimension" class="form-control-label">Dimension</label>
                                    <input class="form-control" type="text" placeholder="Dimension"
                                           name="dimension" value="{{$inStockProduct->ipad->dimension}}"
                                           id="dimension" required>
                                </div>
                            </div>
                            @break

                        @endswitch

                        <div class="card-footer bg-transparent">
                            <button type="submit" class="btn btn-neutral">Mettre a jour</button>
                        </div>

                    </div>
                </div>
            </form>

            <div class="card">

                <div class="card-header bg-darker text-white">
                    <h3 class="mb-0 text-white">Historique des affectations</h3>
                </div>

                <div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Date Affectation</th>
                                <th scope="col" class="sort" data-sort="budget">Employer</th>
                                <th scope="col" class="sort" data-sort="status">Fonction</th>
                                <th scope="col" class="sort" data-sort="status">Département</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($inStockProduct->employersHistory as $employersHistory)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span
                                                    class="name mb-0 text-sm">{{\Carbon\Carbon::parse($employersHistory->pivot->created_at)->toDateString()}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-success"></i>
                                            <a href="{{route('user.show',['user'=>$employersHistory->user])}}"
                                               class="text-dark">
                                                <span class="status"> {{$employersHistory->user->name}}</span>
                                            </a>
                                        </span>

                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <span class="status">{{$employersHistory->function}}</span>
                                        </span>
                                    </td>
                                    <td class="budget">
                                        {{$employersHistory->department}}
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light"
                                               href="{{route('user.show',['user'=>$employersHistory->user])}}"
                                               role="button">
                                                <i class="fas fa-arrow-alt-circle-right"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">

                </div>

            </div>
        </div>
    </div>

@endsection

