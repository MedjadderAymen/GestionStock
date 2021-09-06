<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Parc IT</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset("../assets/img/brand/Stock.png")}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset("../assets/vendor/nucleo/css/nucleo.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css")}}"
          type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset("../assets/css/argon.css?v=1.2.0")}}" type="text/css">

    <style>
        th {
            border: 1px solid black;
        }

        td {
            border: 1px solid #acacac;
        }
    </style>

    @yield('import')
</head>

<body class="bg-white">
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Page content -->
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col">
                <img alt="Image placeholder" src="{{asset("../assets/img/brand/Logo-Vitalcare.png")}}">
                <div class="container">
                    <div class="row justify-content-md-center mt-4">
                        <div class="col-md-auto">
                            <h1>
                                Décharge Matérielle Informatique: D{{$user->id}}
                            </h1>
                        </div>
                    </div>
                    <div class="row justify-content-md-end mt-3">
                        <div class="col-md-auto">
                            <h3>
                                Alger, le {{\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('LLLL')}}
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-2">
                        <div class="col-md-auto">
                            <h3>
                                Je soussigné,
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-3">
                        <div class="col-md-auto">
                            <h3>
                                <strong>Nom & Prénom: </strong> {{$user->name}}
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h3>
                                <strong>Fonction: </strong> {{$user->employer->function}}
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h3>
                                <strong>Département: </strong> {{$user->employer->department}}
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h3>
                                <strong>Entité Légale: </strong> {{$user->employer->company}}
                            </h3>
                        </div>
                    </div>
                    <hr class="my-1 border-darker"/>
                    <div class="row justify-content-md-start mt-3">
                        <div class="col-md-auto">
                            <h3>
                                - Certifie avoir Reçu, ce jour, auprès du département informatique, ce qui suit :
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-2">
                        <div class="col-md-auto">
                            <h3>
                                <strong style="text-underline: black" class="fa-underline">Matériel: </strong>
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table align-items-center table-flush">
                            <tbody class="list">
                            @if(count($laptops)>0)
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>Laptop</strong>
                                    </th>
                                </tr>
                                @foreach($laptops as $laptop)
                                    <tr>
                                        <td class="budget">
                                            <h3>
                                                <strong>Constructeur: </strong>{{$laptop->constructor}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Model: </strong>{{$laptop->model}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>S/N: </strong>{{$laptop->serial_number}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Code immo: </strong>{{$laptop->zi}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Vc: </strong>VC{{$laptop->laptop->vc}}L
                                            </h3>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(count($desktops)>0)
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>Desktop</strong>
                                    </th>
                                </tr>
                                @foreach($desktops as $desktop)
                                    <tr>
                                        <td class="budget">
                                            <h3>
                                                <strong>Constructeur: </strong>{{$desktop->constructor}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Model: </strong>{{$desktop->model}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>S/N: </strong>{{$desktop->serial_number}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Code immo: </strong>{{$desktop->zi}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Vc: </strong>VC{{$desktop->desktop->vc}}L
                                            </h3>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(count($screens)>0)
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>Ecran</strong>
                                    </th>
                                </tr>
                                @foreach($screens as $screen)
                                    <tr>
                                        <td class="budget">
                                            <h3>
                                                <strong>Constructeur: </strong>{{$screen->constructor}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Model: </strong>{{$screen->model}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>S/N: </strong>{{$screen->serial_number}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Code immo: </strong>{{$screen->zi}}
                                            </h3>
                                        </td>
                                        <td class="budget">

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(count($phones)>0)
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>SmartPhone</strong>
                                    </th>
                                </tr>
                                @foreach($phones as $phone)
                                    <tr>
                                        <td class="budget">
                                            <h3>
                                                <strong>Constructeur: </strong>{{$phone->constructor}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Model: </strong>{{$phone->model}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>S/N: </strong>{{$phone->serial_number}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Code immo: </strong>{{$phone->zi}}
                                            </h3>
                                        </td>
                                        <td class="budget">

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(count($ipads)>0)
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>IPad</strong>
                                    </th>
                                </tr>
                                @foreach($ipads as $ipad)
                                    <tr>
                                        <td class="budget">
                                            <h3>
                                                <strong>Constructeur: </strong>{{$ipad->constructor}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Model: </strong>{{$ipad->model}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>S/N: </strong>{{$ipad->serial_number}}
                                            </h3>
                                        </td>
                                        <td class="budget">
                                            <h3>
                                                <strong>Code immo: </strong>{{$ipad->zi}}
                                            </h3>
                                        </td>
                                        <td class="budget">

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                    <hr class="my-1 border-darker"/>
                    <div class="row justify-content-md-start mt-4">
                        <div class="col-md-auto">
                            <h3>
                                <strong style="text-underline: black" class="fa-underline">Comptes
                                    utilisateurs: </strong>
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h3>
                                <strong>Numéro téléphone: </strong> {{$user->phone_number}}
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h3>
                                <strong>Windows username: </strong> {{$user->windows_username}}
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h3>
                                <strong>Messagerie: </strong> {{$user->email}}
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-1">
                        <div class="col-md-auto">
                            <h3>
                                @if($user->sap)
                                    <strong>Sap username: </strong> {{$user->username}}
                                @else
                                    <strong>Sap username: </strong> N/A
                                @endif
                            </h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-start mt-3">
                        <div class="col-md-auto">
                            <h3>
                                NP: les Mots de Passe seront communiqués par le service IT.
                            </h3>
                        </div>
                    </div>
                </div>
                <hr class="my-1 mt-3 border-darker"/>
                <div class="container mt-1">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 "><strong>Fait par :</strong></div>
                        <div class="col-sm-6 "><strong>Le bénéficiaire :</strong></div>
                        <div class="col-sm-6 "><strong>{{Auth::user()->name}}</strong></div>
                        <div class="col-sm-6 "><strong>{{$user->name}}</strong></div>
                    </div>
                </div>
                <hr class="my-1 border-darker"/>
                <hr class="my-1 mt-9 border-darker"/>
                <div class="row justify-content-md-center mt-1">
                    <div class="col-md-auto text-body">
                        <h3>
                            Important : En cas de perte ou de dommage merci de le signaler au département IT.
                        </h3>
                    </div>
                </div>
                <div class="row justify-content-md-center mt-1">
                    <div class="col-md-auto text-body">
                        <h3>
                            Cette décharge annule et remplace les décharges précédentes.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Argon Scripts -->
<!-- Core -->
<script src="{{asset("../assets/vendor/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("../assets/vendor/js-cookie/js.cookie.js")}}"></script>
<script src="{{"../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"}}"></script>
<script src="{{asset("../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js")}}"></script>
<!-- Optional JS -->
<script src="{{asset("../assets/vendor/chart.js/dist/Chart.min.js")}}"></script>
<script src="{{asset("../assets/vendor/chart.js/dist/Chart.extension.js")}}"></script>
<!-- Argon JS -->
<script src="{{asset("../assets/js/argon.js?v=1.2.0")}}"></script>

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>

</body>

</html>
