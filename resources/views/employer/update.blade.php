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
                                <li class="breadcrumb-item"><a href="{{route("employer.index")}}">Employers</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Modifier employer</li>
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
            <form action="{{route('employer.update',['employer'=>$employer])}}" method="post">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Modifier employer</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="last_name" class="form-control-label">Nom</label>
                                <input class="form-control" type="text" placeholder="Nom" name="last_name"
                                       value="{{$employer->user->last_name}}"
                                       id="last_name" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="first_name" class="form-control-label">Prénom</label>
                                <input class="form-control" type="text" placeholder="Prénom"
                                       value="{{$employer->user->first_name}}"
                                       name="first_name"
                                       id="first_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="email" class="form-control-label">Email</label>
                                <input class="form-control" type="text" placeholder="Email" name="email"
                                       value="{{$employer->user->email}}"
                                       id="email" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="phone_number" class="form-control-label">Numéro téléphone</label>
                                <input class="form-control" type="text" placeholder="Numéro téléphone"
                                       value="{{$employer->user->phone_number}}"
                                       name="phone_number"
                                       id="phone_number" required>
                            </div>
                        </div>
                        <hr class="my-1"/>
                        <h6 class="heading-small text-muted mb-4">Information professionnelle</h6>
                        <div class="row">
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="function" class="form-control-label">Fonction</label>
                                <input class="form-control" type="text" placeholder="Fonction" name="function"
                                       value="{{$employer->function}}"
                                       id="function" required>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="department" class="form-control-label">Département</label>
                                <select class="form-control" id="department" name="department">
                                    @foreach(['DFC','DSI'] as $department)
                                        <option
                                            @if($employer->department == $department)
                                            selected
                                            @endif
                                            value="{{$department}}"
                                        >{{$department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="company" class="form-control-label">Entité Légale</label>
                                <input class="form-control" type="text" placeholder="Entité Légale"
                                       value="{{$employer->company}}"
                                       name="company"
                                       id="company" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-neutral">Modifier employer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset("./js/app.js")}}"></script>

@endsection

