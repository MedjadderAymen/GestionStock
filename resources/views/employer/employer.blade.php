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
                                <li class="breadcrumb-item active" aria-current="page">Ajouter employer</li>
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
            <form action="{{route('user.store')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Nouveau employer</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="last_name" class="form-control-label">Nom</label>
                                <input class="form-control" type="text" placeholder="Nom" name="last_name"
                                       id="last_name" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="first_name" class="form-control-label">Prénom</label>
                                <input class="form-control" type="text" placeholder="Prénom"
                                       name="first_name"
                                       id="first_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="email" class="form-control-label">Email</label>
                                <input class="form-control" type="text" placeholder="Email" name="email"
                                       id="email" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="phone_number" class="form-control-label">Numéro téléphone</label>
                                <input class="form-control" type="text" placeholder="Numéro téléphone"
                                       name="phone_number"
                                       id="phone_number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-1 col-sm-12">
                                <div>
                                    <label for="sap" class="form-control-label">Sap?</label>
                                </div>
                                <label class="custom-toggle btn-block">
                                    <input id="sap" name="sap" type="checkbox" checked
                                           onchange="activate()">
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="Non"
                                          data-label-on="Oui"></span>
                                </label>
                            </div>
                            <div id="hide_div" class="form-group col-lg-5 col-sm-12">
                                <label for="username" class="form-control-label">Sap username</label>
                                <input class="form-control" type="text" placeholder="Sap username" name="username"
                                       id="username">
                            </div>
                            <div id="expand_div" class="form-group col-lg-6 col-sm-12">
                                <label for="windows_username" class="form-control-label">Windows username</label>
                                <input class="form-control" type="text" placeholder="Windows username"
                                       name="windows_username"
                                       id="windows_username" required>
                            </div>
                        </div>
                        <hr class="my-1"/>
                        <h6 class="heading-small text-muted mb-4">Information professionnelle</h6>
                        <div class="row">
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="function" class="form-control-label">Fonction</label>
                                <input class="form-control" type="text" placeholder="Fonction" name="function"
                                       id="function" required>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="department" class="form-control-label">Département</label>
                                <select class="form-control" id="department" name="department">
                                    @foreach(['DSI','DFC'] as $department)
                                        <option value="{{$department}}">{{$department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="company" class="form-control-label">Entité Légale</label>
                                <input class="form-control" type="text" placeholder="Entité Légale" value="Vitalcare"
                                       name="company"
                                       id="company" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-neutral">Ajouter employer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')


    <script type="text/javascript">

        function activate() {

            var x = document.getElementById('hide_div');
            var y = document.getElementById('expand_div');

            if (x.style.display === "none") {

                x.style.display = "block";
                x.required = true;
                y.classList.remove('col-lg-11');
                y.classList.add('col-lg-6');


            } else {

                x.style.display = "none";
                x.required = false;
                y.classList.remove('col-lg-6');
                y.classList.add('col-lg-11');

            }
        }
    </script>

@endsection

