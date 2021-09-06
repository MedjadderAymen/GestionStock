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
                                Réstitution Matériel Informatique [{{$class}}]: D{{$user->id}}
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
                                - Certifie avoir restitué, ce jour, auprès du département informatique, ce qui suit :
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
                            @if(isset($laptop))
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>Laptop</strong>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="budget">
                                        <h3>
                                            <strong>Constructeur: </strong>{{$laptop->inStockProduct->constructor}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Model: </strong>{{$laptop->inStockProduct->model}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>S/N: </strong>{{$laptop->inStockProduct->serial_number}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Code immo: </strong>{{$laptop->inStockProduct->zi}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Vc: </strong>VC{{$laptop->vc}}L
                                        </h3>
                                    </td>
                                </tr>
                            @endif
                            @if(isset($desktop))
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>Desktop</strong>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="budget">
                                        <h3>
                                            <strong>Constructeur: </strong>{{$desktop->inStockProduct->constructor}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Model: </strong>{{$desktop->inStockProduct->model}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>S/N: </strong>{{$desktop->inStockProduct->serial_number}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Code immo: </strong>{{$desktop->inStockProduct->zi}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Vc: </strong>VC{{$desktop->vc}}L
                                        </h3>
                                    </td>
                                </tr>
                            @endif
                            @if(isset($screen))
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>Ecran</strong>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="budget">
                                        <h3>
                                            <strong>Constructeur: </strong>{{$screen->inStockProduct->constructor}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Model: </strong>{{$screen->inStockProduct->model}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>S/N: </strong>{{$screen->inStockProduct->serial_number}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Code immo: </strong>{{$screen->inStockProduct->zi}}
                                        </h3>
                                    </td>
                                    <td class="budget">

                                    </td>
                                </tr>
                            @endif
                            @if(isset($phone))
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>SmartPhone</strong>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="budget">
                                        <h3>
                                            <strong>Constructeur: </strong>{{$phone->inStockProduct->constructor}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Model: </strong>{{$phone->inStockProduct->model}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>S/N: </strong>{{$phone->inStockProduct->serial_number}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Code immo: </strong>{{$phone->inStockProduct->zi}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        @if($phone->cession)
                                            <h3>
                                                <strong>Cession: </strong> Oui
                                            </h3>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            @if(isset($ipad))
                                <tr>
                                    <th scope="col" colspan="5" style="text-align:center">
                                        <strong>IPad</strong>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="budget">
                                        <h3>
                                            <strong>Constructeur: </strong>{{$ipad->inStockProduct->constructor}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Model: </strong>{{$ipad->inStockProduct->model}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>S/N: </strong>{{$ipad->inStockProduct->serial_number}}
                                        </h3>
                                    </td>
                                    <td class="budget">
                                        <h3>
                                            <strong>Code immo: </strong>{{$ipad->inStockProduct->zi}}
                                        </h3>
                                    </td>
                                    <td class="budget">

                                    </td>
                                </tr>
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
