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
                                <li class="breadcrumb-item"><a href="{{route("user.index")}}">Employers</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('user.show',['user'=>$user])}}">Employer</a>
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
            <form action="{{route('user.update',['user'=>$user])}}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir soumettre ce formulaire ?');">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">Modifier employer</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-12 col-sm-12">
                                <label for="name" class="form-control-label">Nom</label>
                                <input class="form-control" type="text" placeholder="Nom" name="name"
                                       value="{{$user->name}}"
                                       id="name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="email" class="form-control-label">Email</label>
                                <input class="form-control" type="text" placeholder="Email" name="email"
                                       value="{{$user->email}}"
                                       id="email" >
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="phone_number" class="form-control-label">Numéro téléphone</label>
                                <input class="form-control" type="text" placeholder="Numéro téléphone"
                                       value="{{$user->phone_number}}"
                                       name="phone_number"
                                       id="phone_number" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-1 col-sm-12">
                                <div>
                                    <label for="sap" class="form-control-label">Sap?</label>
                                </div>
                                <label class="custom-toggle btn-block">
                                    <input id="sap" name="sap" type="checkbox"
                                           @if($user->sap)
                                           checked
                                           @endif
                                           onchange="activate()">
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="Non"
                                          data-label-on="Oui"></span>
                                </label>
                            </div>
                            <div id="hide_div" class="form-group col-lg-5 col-sm-12"
                                 @if(!$user->sap)
                                 style="display: none"
                                @endif
                            >
                                <label for="username" class="form-control-label">Sap username</label>
                                <input class="form-control" type="text" placeholder="Sap username" name="username"
                                       value="{{$user->username}}"
                                       id="username">
                            </div>
                            <div id="expand_div"
                                 @if(!$user->sap)
                                 class="form-group col-lg-11 col-sm-12"
                                 @else
                                 class="form-group col-lg-6 col-sm-12"
                                @endif
                            >
                                <label for="windows_username" class="form-control-label">Windows username</label>
                                <input class="form-control" type="text" placeholder="Windows username"
                                       value="{{$user->windows_username}}"
                                       name="windows_username"
                                       id="windows_username" >
                            </div>
                        </div>
                        <hr class="my-1"/>
                        <h6 class="heading-small text-muted mb-4">Information professionnelle</h6>
                        <div class="row">
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="function" class="form-control-label">Fonction</label>
                                <input class="form-control" type="text" placeholder="Fonction" name="function"
                                       value="@if(isset($user->employer)) {{$user->employer->function}} @endif"
                                       id="function" required>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="department" class="form-control-label">Département</label>
                                <select class="form-control" id="department" name="department">
                                    @foreach($departments as $department)
                                        <option
                                            @if(isset($user->employer))
                                            @if($user->employer->department == $department)
                                            selected
                                            @endif
                                            @endif
                                            value="{{$department}}">{{$department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label for="company" class="form-control-label">Entité Légale</label>
                                <input class="form-control" type="text" placeholder="Entité Légale"
                                       value="@if(isset($user->employer)) {{$user->employer->company}} @else VitalCare @endif"
                                       name="company"
                                       id="company" required>
                            </div>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                            <button type="submit" class="btn btn-neutral">Modifier employer</button>
                        @endif
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
                document.getElementById('username').setAttribute("required", true);
                y.classList.remove('col-lg-11');
                y.classList.add('col-lg-6');


            } else {

                x.style.display = "none";
                document.getElementById('username').removeAttribute("required");
                y.classList.remove('col-lg-6');
                y.classList.add('col-lg-11');

            }
        }
    </script>

@endsection

