@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Employer</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route("user.index")}}">Employers</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Employer</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('user.print',['user'=>$user])}}" class="btn btn-sm btn-dark text-white col-3">Imprimer décharge</a>
                        <a href="{{route('user.edit',['user'=>$user])}}" class="btn btn-sm btn-neutral col-3">Modifier Informations</a>
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
                    <h3 class="mb-0">Employer: {{$user->name}}</h3>
                </div>
            </div>
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
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($laptops as $laptop)
                            <tr>
                                <th scope="row">
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
                                    {{\Carbon\Carbon::parse($laptop->updated_at)->toDateString()}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light"
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
                            <th scope="col"></th>
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
                                    {{\Carbon\Carbon::parse($desktop->updated_at)->toDateString()}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light"
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
                            <th scope="col"></th>
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
                                    {{\Carbon\Carbon::parse($screen->updated_at)->toDateString()}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light"
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
                            <th scope="col"></th>
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
                                    {{\Carbon\Carbon::parse($phone->updated_at)->toDateString()}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light"
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
                            <th scope="col"></th>
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
                                    {{\Carbon\Carbon::parse($ipad->updated_at)->toDateString()}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light"
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
        </div>
    </div>

@endsection
