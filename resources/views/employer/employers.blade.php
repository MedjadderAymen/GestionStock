@extends('layouts.app')

@section('search_form')
    <!-- Search form -->
    <form class="navbar-search navbar-search-light form-inline mb-0" id="navbar-search-main"
          action="{{route('user.search')}}" method="post">
        @csrf
        <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <label>
                    <input class="form-control" placeholder="Chercher un employé" type="text" name="name">
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
                                <li class="breadcrumb-item active" aria-current="page">Employers</li>
                            </ol>
                        </nav>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                        <div class="col-lg-6 col-5 text-right">
                            <a href="{{route("user.create")}}" class="btn btn-sm btn-neutral col-4">Ajouter Employer</a>
                        </div>
                    @endif
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
                    <table id="stocks" class="table table-flush ">
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
                                @if($user->active)
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                               <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i> <span
                                                       class="name mb-0 text-sm">{{$user->name}}</span>
                                                   </span>
                                            </div>
                                        </div>
                                    </th>
                                @else
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                <span class="name mb-0 text-sm">{{$user->name}}</span>
                                                    </span>
                                            </div>
                                        </div>
                                    </th>
                                @endif
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
                                @if(isset($user->employer))
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
                                @else
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">N/A</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">N/A</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">N/A</span>
                                            </div>
                                        </div>
                                    </th>
                                @endif

                                @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{route('user.show',['user'=>$user])}}">Détail</a>
                                                <a class="dropdown-item"
                                                   href="{{route('user.edit',['user'=>$user])}}">Modifier</a>
                                            </div>
                                        </div>
                                    </td>
                                @else

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light"
                                               href="{{route('user.show',['user'=>$user])}}"
                                               role="button">
                                                <i class="fas fa-arrow-alt-circle-right"></i>
                                            </a>
                                        </div>
                                    </td>

                                @endif


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

