@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-4 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route("user.index")}}">Employers</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Employer</li>
                            </ol>
                        </nav>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                        <div class="col-lg-8 col-sm-12 text-right">
                            <a href="{{route('user.print',['user'=>$user])}}"
                               class="btn btn-sm btn-success text-white col-2"><i class="fas fa-print"></i> Décharge</a>
                            <a href="{{route('user.restore',['user'=>$user])}}"
                               class="btn btn-sm btn-warning text-white col-2"><i class="fas fa-print"></i> Restitution</a>
                            <a href="{{route('user.edit',['user'=>$user])}}" class="btn btn-sm btn-neutral col-2"><i
                                    class="fas fa-edit"></i> Informations</a>
                        </div>
                    @endif
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
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Employer: {{$user->name}}
                                @if($user->active)
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
                        @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                            <div class="col text-right">
                                <form id="delete-user-form text-right"
                                      action="{{route('user.destroy',['user'=>$user])}}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir soumettre ce formulaire ?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning col-2"><i
                                            class="fas fa-eraser"></i> Supprimer</button>
                                    @method('DELETE')
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-md-start">
                        <div class="col-md-auto">
                            <h4>
                                Fonction: {{$user->employer->function}}
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-md-start">
                        <div class="col-md-auto">
                            <h4>
                                Département: {{$user->employer->department}}
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-md-start">
                        <div class="col-md-auto">
                            <h4>
                                Entité Légale: {{$user->employer->company}}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-md-start mt-0">
                        <div class="col-md-auto">
                            <h4>
                                Comptes utilisateurs:
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h4>
                                Numéro téléphone: {{$user->phone_number}}
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h4>
                                Windows username: {{$user->windows_username}}
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h4>
                                Messagerie: {{$user->email}}
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h4>
                                @if($user->sap)
                                    Sap username: {{$user->username}}
                                @else
                                    Sap username: N/A
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($laptops)>0)
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Laptops</h3>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Zi</th>
                                <th scope="col">constructeur</th>
                                <th scope="col">modele</th>
                                <th scope="col">numéro de série</th>
                                <th scope="col">Date affectation</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                    <th scope="col">Réstitution</th>
                                @endif
                                <th scope="col">Détails</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($laptops as $laptop)
                                <tr>
                                    <th>
                                        {{$laptop->zi}}
                                    </th>
                                    <td>
                                        {{$laptop->constructor}}
                                    </td>
                                    <td>
                                        {{$laptop->model}}
                                    </td>
                                    <td>
                                        {{$laptop->serial_number}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($laptop->date_affectation)->toDateString()}}
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                        <td class="text-left">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-danger"
                                                   href="{{route("stock.restore",['stock' => $laptop])}}" role="button">
                                                    <i class="ni ni-scissors"></i>
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                    <td class="text-left">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-primary"
                                               href="{{route("stock.show",['stock' => $laptop])}}" role="button">
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
            @endif

            @if(count($desktops)>0)
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Desktops</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Zi</th>
                                <th scope="col">constructeur</th>
                                <th scope="col">modele</th>
                                <th scope="col">numéro de série</th>
                                <th scope="col">Date affectation</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                    <th scope="col">Réstitution</th>
                                @endif
                                <th scope="col">Détails</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($desktops as $desktop)
                                <tr>
                                    <th scope="row">
                                        {{$desktop->zi}}
                                    </th>
                                    <td>
                                        {{$desktop->constructor}}
                                    </td>
                                    <td>
                                        {{$desktop->model}}
                                    </td>
                                    <td>
                                        {{$desktop->serial_number}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($desktop->date_affectation)->toDateString()}}
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                        <td class="text-left">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-danger"
                                                   href="{{route("stock.restore",['stock' => $desktop])}}"
                                                   role="button">
                                                    <i class="ni ni-scissors"></i>
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                    <td class="text-left">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-primary"
                                               href="{{route("stock.show",['stock' => $desktop])}}" role="button">
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
            @endif

            @if(count($screens)>0)
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Ecrans</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Zi</th>
                                <th scope="col">constructeur</th>
                                <th scope="col">modele</th>
                                <th scope="col">numéro de série</th>
                                <th scope="col">Date affectation</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                    <th scope="col">Réstitution</th>
                                @endif
                                <th scope="col">Détails</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($screens as $screen)
                                <tr>
                                    <th scope="row">
                                        {{$screen->zi}}
                                    </th>
                                    <td>
                                        {{$screen->constructor}}
                                    </td>
                                    <td>
                                        {{$screen->model}}
                                    </td>
                                    <td>
                                        {{$screen->serial_number}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($screen->date_affectation)->toDateString()}}
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                        <td class="text-left">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-danger"
                                                   href="{{route("stock.restore",['stock' => $screen])}}" role="button">
                                                    <i class="ni ni-scissors"></i>
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                    <td class="text-left">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-primary"
                                               href="{{route("stock.show",['stock' => $screen])}}" role="button">
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
            @endif

            @if(count($phones)>0)
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Téléphones</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Zi</th>
                                <th scope="col">constructeur</th>
                                <th scope="col">modele</th>
                                <th scope="col">numéro de série</th>
                                <th scope="col">Date affectation</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                <th scope="col">Réstitution</th>
                                @endif
                                <th scope="col">Détails</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($phones as $phone)
                                <tr>
                                    <th scope="row">
                                        {{$phone->zi}}
                                    </th>
                                    <td>
                                        {{$phone->constructor}}
                                    </td>
                                    <td>
                                        {{$phone->model}}
                                    </td>
                                    <td>
                                        {{$phone->serial_number}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($phone->date_affectation)->toDateString()}}
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                    <td class="text-left">
                                        <div class="dropdown">
                                            <a class="btn btn-sm  text-danger"
                                               href="{{route("stock.restore",['stock' => $phone])}}" role="button">
                                                <i class="ni ni-scissors">@if($phone->phone->cession) (cession) @endif</i>
                                            </a>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="text-left">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-primary"
                                               href="{{route("stock.show",['stock' => $phone])}}" role="button">
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
            @endif

            @if(count($ipads)>0)
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">IPads</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Zi</th>
                                <th scope="col">constructeur</th>
                                <th scope="col">modele</th>
                                <th scope="col">numéro de série</th>
                                <th scope="col">Date affectation</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                <th scope="col">Réstitution</th>
                                @endif
                                <th scope="col">Détails</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ipads as $ipad)
                                <tr>
                                    <th scope="row">
                                        {{$ipad->zi}}
                                    </th>
                                    <td>
                                        {{$ipad->constructor}}
                                    </td>
                                    <td>
                                        {{$ipad->model}}
                                    </td>
                                    <td>
                                        {{$ipad->serial_number}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($ipad->date_affectation)->toDateString()}}
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                    <td class="text-left">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-danger"
                                               href="{{route("stock.restore",['stock' => $ipad])}}" role="button">
                                                <i class="ni ni-scissors"></i>
                                            </a>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="text-left">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-primary"
                                               href="{{route("stock.show",['stock' => $ipad])}}" role="button">
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
            @endif

        </div>
    </div>

@endsection
