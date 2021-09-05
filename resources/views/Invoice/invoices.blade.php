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
                                <li class="breadcrumb-item active" aria-current="page">Factures</li>
                            </ol>
                        </nav>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                        <div class="col-lg-6 col-5 text-right">
                            <a href="{{route("invoice.create")}}" class="btn btn-sm btn-neutral col-4">Ajouter
                                Facture</a>
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
                    <table id="stocks" class="table align-items-center table-flush text-center">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Facture</th>
                            <th scope="col" class="sort" data-sort="name">Fourniseur</th>
                            <th scope="col" class="sort" data-sort="budget">Créer par</th>
                            <th scope="col" class="sort" data-sort="status">Date de création</th>
                            <th scope="col" class="sort" data-sort="status">Prix Total</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($invoices as $invoice)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$invoice->serial_number}}</span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$invoice->provider}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="budget">
                                    {{$invoice->helpDesk->user->first_name}} {{$invoice->helpDesk->user->last_name}}
                                </td>
                                <td class="budget">
                                    {{ $invoice->created_at->toDateString() }}
                                </td>
                                <td class="budget">
                                    {{ $invoice->total_price }}
                                </td>
                                @if(\Illuminate\Support\Facades\Auth::user()->role==="help desk")
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="{{route('invoice.show',['invoice'=>$invoice])}}">Détail</a>
                                                <a class="dropdown-item" href=""
                                                   onclick="event.preventDefault(); document.getElementById('invoice-delete-form').submit();">Supprimer</a>
                                                <form id="invoice-delete-form"
                                                      action="{{route('invoice.destroy',['invoice'=>$invoice])}}"
                                                      method="POST" class="d-none">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light"
                                               href="{{route('invoice.show',['invoice'=>$invoice])}}"
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
            </div>
        </div>
    </div>
@endsection

