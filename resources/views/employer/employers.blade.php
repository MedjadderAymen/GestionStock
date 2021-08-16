@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Employers</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Employers</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route("employer.create")}}" class="btn btn-sm btn-neutral col-4">Ajouter Employer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">

                <!-- Light table -->
                <div class="table-responsive">
                    <table id="stocks" class="table align-items-center table-flush text-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Nom & Prénom</th>
                            <th scope="col" class="sort" data-sort="name">Email</th>
                            <th scope="col" class="sort" data-sort="name">Numéro téléphone</th>
                            <th scope="col" class="sort" data-sort="name">Fonction</th>
                            <th scope="col" class="sort" data-sort="budget">Département</th>
                            <th scope="col" class="sort" data-sort="status">Entité Légale</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$user->first_name}} {{$user->last_name}}</span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$user->email}}</span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$user->phone_number}}</span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$user->employer->function}}</span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$user->employer->department}}</span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$user->employer->company}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{route('employer.edit',['employer'=>$user->employer])}}">Modifier</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
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

