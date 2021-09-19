@extends('layouts.app')

@section('search_form')
    <!-- Search form -->
    <form class="navbar-search navbar-search-light form-inline mb-0" id="navbar-search-main"
          action="{{route('stock.search')}}" method="post">
        @csrf
        <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <label>
                    <input class="form-control" placeholder="Chercher un ZI" type="text" name="zi_search">
                </label>
            </div>
        </div>
        <button type="button" class="close" data-action="search-close"
                data-target="#navbar-search-main" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </form>
@endsection

@section('search_input')
    <li class="nav-item d-sm-none">
        <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
            <i class="ni ni-zoom-split-in"></i>
        </a>
    </li>
@endsection

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
                                <li class="breadcrumb-item active" aria-current="page">Parc</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Search form -->
                </div>

            </div>
        </div>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-laptops-tab" data-toggle="tab"
                                   href="#tabs-laptops" role="tab" aria-controls="tabs-laptops"
                                   aria-selected="true"><i class="ni ni-laptop mr-2"></i>Laptops</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-desktops-tab" data-toggle="tab"
                                   href="#tabs-desktops" role="tab" aria-controls="tabs-desktops"
                                   aria-selected="false"><i class="fas fa-desktop mr-2"></i>Desktops</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-screens-tab" data-toggle="tab"
                                   href="#tabs-screens" role="tab" aria-controls="tabs-screens"
                                   aria-selected="false"><i class="fas fa-tv mr-2"></i>Ecrans</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-phones-tab" data-toggle="tab"
                                   href="#tabs-phones" role="tab" aria-controls="tabs-phones"
                                   aria-selected="false"><i class="ni ni-mobile-button mr-2"></i>Smart Phones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-ipads-tab" data-toggle="tab"
                                   href="#tabs-ipads" role="tab" aria-controls="tabs-ipads"
                                   aria-selected="false"><i class="ni ni-mobile-button mr-2"></i>IPad</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card shadow">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-laptops" role="tabpanel"
                                 aria-labelledby="tabs-laptops-tab">
                                <!-- Light table -->
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="mb-0">Inventaire laptop</h3>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                                <div class="col text-right">
                                                    <a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                                                       data-target="#laptopModal">Ajouter</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Code immo</th>
                                                <th scope="col">constructeur</th>
                                                <th scope="col">modele</th>
                                                <th scope="col">numéro de série</th>
                                                <th scope="col">Site d'affectation</th>
                                                <th scope="col">Employer</th>
                                                <th scope="col">Date affectation</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($laptops as $laptop)
                                                <tr>
                                                    <th scope="row">
                                                        {{$laptop->inStockProduct->zi}}
                                                    </th>
                                                    <td>
                                                        {{$laptop->inStockProduct->constructor}}
                                                    </td>
                                                    <td>
                                                        {{$laptop->inStockProduct->model}}
                                                    </td>
                                                    <td>
                                                        {{$laptop->inStockProduct->serial_number}}
                                                    </td>

                                                    @if(isset($laptop->inStockProduct->location->site))
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$laptop->inStockProduct->location->site->address}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    @if(isset($laptop->inStockProduct->employer->user))
                                                        <td>
                                                        <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$laptop->inStockProduct->employer->user->name}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                        <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        {{isset($laptop->inStockProduct->date_affectation) ? \Carbon\Carbon::parse($laptop->inStockProduct->date_affectation)->toDateString() : "N/A"}}
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light"
                                                               href="{{route("stock.show",['stock' => $laptop->inStockProduct])}}"
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
                                    <div class="card-footer">
                                        {{$laptops->links()}}
                                    </div>
                                </div>
                                <!-- Modal laptops-->
                                <div class="modal fade" id="laptopModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered col-lg-12" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ajouter inventaire -
                                                    Laptop </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{route("stock.store")}}"
                                                  onsubmit="return confirm('Êtes-vous sûr?');">
                                                @csrf
                                                <input name="class" value="laptop" type="hidden">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="zi" class="form-control-label">Code immo</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Code immo" value="ZI-"
                                                                   name="zi" id="zi">
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="invoice"
                                                                   class="form-control-label">Facture</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Facture"
                                                                   name="invoice" id="invoice">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="vc" class="form-control-label">VC</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">VC</span>
                                                                </div>
                                                                <input type="number" max="9999" class="form-control"
                                                                       required id="vc" name="vc">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">L</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="serial_number"
                                                                   class="form-control-label">Numéro de série</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Numéro de série" name="serial_number"
                                                                   id="serial_number" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="constructor"
                                                                   class="form-control-label">Constructeur</label>
                                                            <select class="form-control" id="constructor"
                                                                    name="constructor"
                                                                    required>
                                                                @foreach(['Hp','Lenovo'] as $constructor)
                                                                    <option
                                                                        value="{{$constructor}}">{{$constructor}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="model"
                                                                   class="form-control-label">Model</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Model" name="model"
                                                                   id="model" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="cpu"
                                                                   class="form-control-label">CPU</label>
                                                            <select class="form-control" id="cpu" name="cpu"
                                                                    required>
                                                                @foreach(['I3','I5','I7'] as $cpu)
                                                                    <option
                                                                        value="{{$cpu}}">{{$cpu}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="ram"
                                                                   class="form-control-label ">RAM</label>
                                                            <select class="form-control" id="ram" name="ram"
                                                                    required>
                                                                @foreach(['4Go','6Go','8Go','12Go','16Go','32Go'] as $ram)
                                                                    <option
                                                                        value="{{$ram}}">{{$ram}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="disk"
                                                                   class="form-control-label">Disque</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Disque" name="disk"
                                                                   id="disk" required>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="screen"
                                                                   class="form-control-label">Ecran</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Ecran" name="screen"
                                                                   id="screen" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="status" class="form-control-label">Etat</label>
                                                        <select class="form-control" id="status" name="status" required>
                                                            @foreach(['neuf','bon','moyen','hors service'] as $status)
                                                                <option
                                                                    value="{{$status}}">{{$status}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="laptop_employer">Affectation</label>
                                                        <select class="form-control" id="laptop_employer" name="user"
                                                                onchange="affectDataLaptop()">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="Employers">
                                                                @foreach($users as $user)
                                                                    <option
                                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="form-group " id="laptop_date_div" style="display: none">
                                                        <label for="date_affectation"
                                                               class="form-control-label">Date d'affectation</label>
                                                        <input class="form-control" type="date" name="date_affectation"
                                                               id="date_affectation" value="{{now()->toDateString()}}"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="site">Site</label>
                                                        <select class="form-control" id="site" name="site">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="VitalCare">
                                                                @foreach($sites as $site)
                                                                    <option
                                                                        value="{{$site->id}}">{{$site->address}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="tabs-desktops" role="tabpanel"
                                 aria-labelledby="tabs-desktops-tab">

                                <!-- Light table -->
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="mb-0">Inventaire Desktop</h3>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                                <div class="col text-right">
                                                    <a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                                                       data-target="#desktopModal">Ajouter</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Code immo</th>
                                                <th scope="col">constructeur</th>
                                                <th scope="col">modele</th>
                                                <th scope="col">Numéro de série</th>
                                                <th scope="col">Site d'affectation</th>
                                                <th scope="col">Employer</th>
                                                <th scope="col">Date affectation</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($desktops as $desktop)
                                                <tr>
                                                    <th scope="row">
                                                        {{$desktop->inStockProduct->zi}}
                                                    </th>
                                                    <td>
                                                        {{$desktop->inStockProduct->constructor}}
                                                    </td>
                                                    <td>
                                                        {{$desktop->inStockProduct->model}}
                                                    </td>
                                                    <td>
                                                        {{$desktop->inStockProduct->serial_number}}
                                                    </td>

                                                    @if(isset($desktop->inStockProduct->location->site))
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$desktop->inStockProduct->location->site->address}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    @if(isset($desktop->inStockProduct->employer->user))
                                                        <td>
                                                        <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$desktop->inStockProduct->employer->user->name}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                        <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        {{isset($desktop->inStockProduct->date_affectation) ? \Carbon\Carbon::parse($desktop->inStockProduct->date_affectation)->toDateString() : "N/A"}}
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light"
                                                               href="{{route("stock.show",['stock' => $desktop->inStockProduct])}}"
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
                                    <div class="card-footer">
                                        {{$desktops->links()}}
                                    </div>
                                </div>

                                <!-- Modal laptops-->
                                <div class="modal fade" id="desktopModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered col-lg-12" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ajouter inventaire -
                                                    Desktop </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{route("stock.store")}}"
                                                  onsubmit="return confirm('Êtes-vous sûr?');">
                                                @csrf
                                                <input name="class" value="desktop" type="hidden">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="zi" class="form-control-label">Code immo</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Code immo" value="ZI-"
                                                                   name="zi" id="zi">
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="invoice"
                                                                   class="form-control-label">Facture</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Facture"
                                                                   name="invoice" id="invoice">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="vc" class="form-control-label">VC</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">VC</span>
                                                                </div>
                                                                <input type="number" max="9999" class="form-control"
                                                                       required id="vc" name="vc">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">D</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="serial_number"
                                                                   class="form-control-label">Numéro de série</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Numéro de série" name="serial_number"
                                                                   id="serial_number" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="constructor"
                                                                   class="form-control-label">Constructeur</label>
                                                            <select class="form-control" id="constructor"
                                                                    name="constructor"
                                                                    required>
                                                                @foreach(['Hp','Lenovo'] as $constructor)
                                                                    <option
                                                                        value="{{$constructor}}">{{$constructor}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="model"
                                                                   class="form-control-label">Model</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Model" name="model"
                                                                   id="model" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-4 col-sm-12">
                                                            <label for="cpu"
                                                                   class="form-control-label">CPU</label>
                                                            <select class="form-control" id="cpu" name="cpu"
                                                                    required>
                                                                @foreach(['I3','I5','I7'] as $cpu)
                                                                    <option
                                                                        value="{{$cpu}}">{{$cpu}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-4 col-sm-12">
                                                            <label for="ram"
                                                                   class="form-control-label ">RAM</label>
                                                            <select class="form-control" id="ram" name="ram"
                                                                    required>
                                                                @foreach(['4Go','6Go','8Go','12Go','16Go','32Go'] as $ram)
                                                                    <option
                                                                        value="{{$ram}}">{{$ram}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-4 col-sm-12">
                                                            <label for="disk"
                                                                   class="form-control-label">Disque</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Disque" name="disk"
                                                                   id="disk" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="status" class="form-control-label">Etat</label>
                                                        <select class="form-control" id="status" name="status" required>
                                                            @foreach(['neuf','bon','moyen','hors service'] as $status)
                                                                <option
                                                                    value="{{$status}}">{{$status}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="desktop_employer">Affectation</label>
                                                        <select class="form-control" id="desktop_employer" name="user"
                                                                onchange="affectDataDesktop()">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="Employers">
                                                                @foreach($users as $user)
                                                                    <option
                                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="form-group " id="desktop_date_div"
                                                         style="display: none">
                                                        <label for="date_affectation"
                                                               class="form-control-label">Date d'affectation</label>
                                                        <input class="form-control" type="date" name="date_affectation"
                                                               id="date_affectation" value="{{now()->toDateString()}}"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="site">Site</label>
                                                        <select class="form-control" id="site" name="site">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="VitalCare">
                                                                @foreach($sites as $site)
                                                                    <option
                                                                        value="{{$site->id}}">{{$site->address}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="tabs-screens" role="tabpanel"
                                 aria-labelledby="tabs-screens-tab">

                                <!-- Light table -->
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="mb-0">Inventaire Ecrans</h3>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                                <div class="col text-right">
                                                    <a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                                                       data-target="#screenModal">Ajouter</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Code immo</th>
                                                <th scope="col">constructeur</th>
                                                <th scope="col">modele</th>
                                                <th scope="col">Numéro de série</th>
                                                <th scope="col">Site d'affectation</th>
                                                <th scope="col">Employer</th>
                                                <th scope="col">Date affectation</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($screens as $screen)
                                                <tr>
                                                    <th scope="row">
                                                        {{$screen->inStockProduct->zi}}
                                                    </th>
                                                    <td>
                                                        {{$screen->inStockProduct->constructor}}
                                                    </td>
                                                    <td>
                                                        {{$screen->inStockProduct->model}}
                                                    </td>
                                                    <td>
                                                        {{$screen->inStockProduct->serial_number}}
                                                    </td>

                                                    @if(isset($screen->inStockProduct->location->site))
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$screen->inStockProduct->location->site->address}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    @if(isset($screen->inStockProduct->employer->user))
                                                        <td>
                                                        <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$screen->inStockProduct->employer->user->name}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                        <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        {{isset($screen->inStockProduct->date_affectation) ? \Carbon\Carbon::parse($screen->inStockProduct->date_affectation)->toDateString() : "N/A"}}
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light"
                                                               href="{{route("stock.show",['stock' => $screen->inStockProduct])}}"
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
                                    <div class="card-footer">
                                        {{$screens->links()}}
                                    </div>
                                </div>

                                <!-- Modal laptops-->
                                <div class="modal fade" id="screenModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered col-lg-12" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ajouter inventaire -
                                                    Ecran </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{route("stock.store")}}"
                                                  onsubmit="return confirm('Êtes-vous sûr?');">
                                                @csrf
                                                <input name="class" value="screen" type="hidden">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="zi" class="form-control-label">Code immo</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Code immo" value="ZI-"
                                                                   name="zi" id="zi">
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="invoice"
                                                                   class="form-control-label">Facture</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Facture"
                                                                   name="invoice" id="invoice">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="serial_number"
                                                               class="form-control-label">Numéro de série</label>
                                                        <input class="form-control" type="text"
                                                               placeholder="Numéro de série" name="serial_number"
                                                               id="serial_number" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="constructor"
                                                                   class="form-control-label">Constructeur</label>
                                                            <select class="form-control" id="constructor"
                                                                    name="constructor"
                                                                    required>
                                                                @foreach(['Hp','Lenovo','LG', 'Samsung'] as $constructor)
                                                                    <option
                                                                        value="{{$constructor}}">{{$constructor}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="model"
                                                                   class="form-control-label">Model</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Model" name="model"
                                                                   id="model" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-sm-12">
                                                            <label for="screen"
                                                                   class="form-control-label">Ecran</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Ecran" name="screen"
                                                                   id="screen" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="status" class="form-control-label">Etat</label>
                                                        <select class="form-control" id="status" name="status" required>
                                                            @foreach(['neuf','bon','moyen','hors service'] as $status)
                                                                <option
                                                                    value="{{$status}}">{{$status}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="screen_employer">Affectation</label>
                                                        <select class="form-control" id="screen_employer" name="user"
                                                                onchange="affectDataScreen()">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="Employers">
                                                                @foreach($users as $user)
                                                                    <option
                                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="form-group " id="screen_date_div" style="display: none">
                                                        <label for="date_affectation"
                                                               class="form-control-label">Date d'affectation</label>
                                                        <input class="form-control" type="date" name="date_affectation"
                                                               id="date_affectation" value="{{now()->toDateString()}}"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="site">Site</label>
                                                        <select class="form-control" id="site" name="site">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="VitalCare">
                                                                @foreach($sites as $site)
                                                                    <option
                                                                        value="{{$site->id}}">{{$site->address}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="tabs-phones" role="tabpanel"
                                 aria-labelledby="tabs-screens-tab">

                                <!-- Light table -->
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="mb-0">Inventaire Téléphone</h3>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                                <div class="col text-right">
                                                    <a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                                                       data-target="#phoneModal">Ajouter</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Code immo</th>
                                                <th scope="col">constructeur</th>
                                                <th scope="col">modele</th>
                                                <th scope="col">Numéro de série</th>
                                                <th scope="col">Site d'affectation</th>
                                                <th scope="col">Employer</th>
                                                <th scope="col">Date affectation</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($phones as $phone)
                                                <tr>
                                                    <th scope="row">
                                                        {{$phone->inStockProduct->zi}}
                                                    </th>
                                                    <td>
                                                        {{$phone->inStockProduct->constructor}}
                                                    </td>
                                                    <td>
                                                        {{$phone->inStockProduct->model}}
                                                    </td>
                                                    <td>
                                                        {{$phone->inStockProduct->serial_number}}
                                                    </td>

                                                    @if(isset($phone->inStockProduct->location->site))
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$phone->inStockProduct->location->site->address}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    @if(isset($phone->inStockProduct->employer->user))
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$phone->inStockProduct->employer->user->name}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    <td>
                                                        {{isset($phone->inStockProduct->date_affectation) ? \Carbon\Carbon::parse($phone->inStockProduct->date_affectation)->toDateString() : "N/A"}}
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light"
                                                               href="{{route("stock.show",['stock' => $phone->inStockProduct])}}"
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
                                    <div class="card-footer">
                                        {{$phones->links()}}
                                    </div>
                                </div>

                                <!-- Modal laptops-->
                                <div class="modal fade" id="phoneModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered col-lg-12" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ajouter inventaire -
                                                    Téléphone </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{route("stock.store")}}"
                                                  onsubmit="return confirm('Êtes-vous sûr?');">
                                                @csrf
                                                <input name="class" value="phone" type="hidden">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="zi" class="form-control-label">Code immo</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Code immo" value="ZI-"
                                                                   name="zi" id="zi">
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="invoice"
                                                                   class="form-control-label">Facture</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Facture"
                                                                   name="invoice" id="invoice">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="serial_number"
                                                               class="form-control-label">Numéro de série</label>
                                                        <input class="form-control" type="text"
                                                               placeholder="Numéro de série" name="serial_number"
                                                               id="serial_number" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="constructor"
                                                                   class="form-control-label">Constructeur</label>
                                                            <select class="form-control" id="constructor"
                                                                    name="constructor"
                                                                    required>
                                                                @foreach(['Samsung','Xiaomi', 'Apple','Condor', 'Nokia', 'Wiko','Huawei', 'StarLight'] as $constructor)
                                                                    <option
                                                                        value="{{$constructor}}">{{$constructor}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="model"
                                                                   class="form-control-label">Model</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Model" name="model"
                                                                   id="model" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="status" class="form-control-label">Etat</label>
                                                        <select class="form-control" id="status" name="status" required>
                                                            @foreach(['neuf','bon','moyen','hors service'] as $status)
                                                                <option
                                                                    value="{{$status}}">{{$status}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone_employer">Affectation</label>
                                                        <select class="form-control" id="phone_employer" name="user"
                                                                onchange="affectDataPhone()">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="Employers">
                                                                @foreach($users as $user)
                                                                    <option
                                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="form-group " id="phone_date_div" style="display: none">
                                                        <label for="date_affectation"
                                                               class="form-control-label">Date d'affectation</label>
                                                        <input class="form-control" type="date" name="date_affectation"
                                                               id="date_affectation" value="{{now()->toDateString()}}"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="site">Site</label>
                                                        <select class="form-control" id="site" name="site">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="VitalCare">
                                                                @foreach($sites as $site)
                                                                    <option
                                                                        value="{{$site->id}}">{{$site->address}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-ipads" role="tabpanel"
                                 aria-labelledby="tabs-screens-tab">

                                <!-- Light table -->
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="mb-0">Inventaire IPad</h3>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                                <div class="col text-right">
                                                    <a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                                                       data-target="#ipadModal">Ajouter</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Projects table -->
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Code immo</th>
                                                <th scope="col">constructeur</th>
                                                <th scope="col">modele</th>
                                                <th scope="col">Numéro de série</th>
                                                <th scope="col">Site d'affectation</th>
                                                <th scope="col">Employer</th>
                                                <th scope="col">Date affectation</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ipads as $ipad)
                                                <tr>
                                                    <th scope="row">
                                                        {{$ipad->inStockProduct->zi}}
                                                    </th>
                                                    <td>
                                                        {{$ipad->inStockProduct->constructor}}
                                                    </td>
                                                    <td>
                                                        {{$ipad->inStockProduct->model}}
                                                    </td>
                                                    <td>
                                                        {{$ipad->inStockProduct->serial_number}}
                                                    </td>

                                                    @if(isset($ipad->inStockProduct->location->site))
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$ipad->inStockProduct->location->site->address}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    @if(isset($ipad->inStockProduct->employer->user))
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span
                                                                    class="status"> {{$ipad->inStockProduct->employer->user->name}}</span>
                                                            </span>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Non Affecté</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    <td>
                                                        {{isset($ipad->inStockProduct->date_affectation) ? \Carbon\Carbon::parse($ipad->inStockProduct->date_affectation)->toDateString() : "N/A"}}
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light"
                                                               href="{{route("stock.show",['stock' => $ipad->inStockProduct])}}"
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
                                    <div class="card-footer">
                                        {{$ipads->links()}}
                                    </div>
                                </div>

                                <!-- Modal laptops-->
                                <div class="modal fade" id="ipadModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered col-lg-12" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ajouter inventaire -
                                                    IPads </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{route("stock.store")}}"
                                                  onsubmit="return confirm('Êtes-vous sûr?');">
                                                @csrf
                                                <input name="class" value="ipad" type="hidden">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="zi" class="form-control-label">Code immo</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Code immo" value="ZI-"
                                                                   name="zi" id="zi">
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="invoice"
                                                                   class="form-control-label">Facture</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Facture"
                                                                   name="invoice" id="invoice">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="serial_number"
                                                               class="form-control-label">Numéro de série</label>
                                                        <input class="form-control" type="text"
                                                               placeholder="Numéro de série" name="serial_number"
                                                               id="serial_number" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="constructor"
                                                                   class="form-control-label">Constructeur</label>
                                                            <select class="form-control" id="constructor"
                                                                    name="constructor"
                                                                    required>
                                                                @foreach(['Apple'] as $constructor)
                                                                    <option
                                                                        value="{{$constructor}}">{{$constructor}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="model"
                                                                   class="form-control-label">Model</label>
                                                            <input class="form-control" type="text"
                                                                   placeholder="Model" name="model"
                                                                   id="model" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="dimension"
                                                                   class="form-control-label">Dimension</label>
                                                            <input class="form-control" type="number"
                                                                   placeholder="Dimension" name="dimension"
                                                                   id="dimension" required>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-sm-12">
                                                            <label for="status" class="form-control-label">Etat</label>
                                                            <select class="form-control" id="status" name="status"
                                                                    required>
                                                                @foreach(['neuf','bon','moyen','hors service'] as $status)
                                                                    <option
                                                                        value="{{$status}}">{{$status}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ipad_employer">Affectation</label>
                                                        <select class="form-control" id="ipad_employer" name="user"
                                                                onchange="affectDataIPad()">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="Employers">
                                                                @foreach($users as $user)
                                                                    <option
                                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="form-group " id="ipad_date_div" style="display: none">
                                                        <label for="date_affectation"
                                                               class="form-control-label">Date d'affectation</label>
                                                        <input class="form-control" type="date" name="date_affectation"
                                                               id="date_affectation" value="{{now()->toDateString()}}"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="site">Site</label>
                                                        <select class="form-control" id="site" name="site">
                                                            <optgroup label="Autres">
                                                                <option value="null">Non Affecté</option>
                                                            </optgroup>
                                                            <optgroup label="VitalCare">
                                                                @foreach($sites as $site)
                                                                    <option
                                                                        value="{{$site->id}}">{{$site->address}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes
                                                    </button>
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
        </div>
    </div>

@endsection

@section('script')

    <script>
        if (location.hash) {
            $('a[href=\'' + location.hash + '\']').tab('show');
        }
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('a[href="' + activeTab + '"]').tab('show');
        }

        $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
            e.preventDefault()
            var tab_name = this.getAttribute('href')
            if (history.pushState) {
                history.pushState(null, null, tab_name)
            } else {
                location.hash = tab_name
            }
            localStorage.setItem('activeTab', tab_name)

            $(this).tab('show');
            return false;
        });
        $(window).on('popstate', function () {
            var anchor = location.hash ||
                $('a[data-toggle=\'tab\']').first().attr('href');
            $('a[href=\'' + anchor + '\']').tab('show');
        });
    </script>

    <script>

        function affectDataLaptop() {

            var x = document.getElementById('laptop_employer');
            var y = document.getElementById('laptop_date_div');

            if (x.value === 'null') {
                y.style.display = "none";
            } else {
                y.style.display = "block"
            }

        }
    </script>

    <script>

        function affectDataDesktop() {

            var x = document.getElementById('desktop_employer');
            var y = document.getElementById('desktop_date_div');

            if (x.value === 'null') {
                y.style.display = "none";
            } else {
                y.style.display = "block"
            }

        }
    </script>

    <script>

        function affectDataScreen() {

            var x = document.getElementById('screen_employer');
            var y = document.getElementById('screen_date_div');

            if (x.value === 'null') {
                y.style.display = "none";
            } else {
                y.style.display = "block"
            }

        }
    </script>

    <script>

        function affectDataPhone() {

            var x = document.getElementById('phone_employer');
            var y = document.getElementById('phone_date_div');

            if (x.value === 'null') {
                y.style.display = "none";
            } else {
                y.style.display = "block"
            }

        }
    </script>

    <script>

        function affectDataIPad() {

            var x = document.getElementById('ipad_employer');
            var y = document.getElementById('ipad_date_div');

            if (x.value === 'null') {
                y.style.display = "none";
            } else {
                y.style.display = "block"
            }

        }
    </script>

@endsection
