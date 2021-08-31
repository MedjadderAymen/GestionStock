@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Factures</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route("invoice.index")}}">Factures</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Détail Facture</li>
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
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Facture: <strong>{{$invoice->created_at->toDateString()}}</strong></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="provider" class="form-control-label">Fourniseur</label>
                            <input class="form-control" type="text" placeholder="Fourniseur" name="provider"
                                   v-model="provider" disabled value="{{$invoice->provider}}"
                                   id="provider" required>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="serial_number" class="form-control-label">Numéro Facture</label>
                            <input class="form-control" type="text" placeholder="Numéro Facture" v-model="serial_number"
                                   name="serial_number" disabled value="{{$invoice->serial_number}}"
                                   id="serial_number" required>
                        </div>
                    </div>
                    <hr class="my-1"/>
                    <h6 class="heading-small text-muted mb-4">List des toners</h6>
                    @foreach($invoice->toners as $toner)
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-control-label">Référence</label>
                                <input class="form-control" type="text" placeholder="Numéro Facture"
                                       name="serial_number"
                                       value="{{$toner->reference}} - {{$toner->color}}" disabled>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label class="form-control-label">prix</label>
                                <input class="form-control" type="text" placeholder="prix" name="provider"
                                       value="{{$toner->pivot->toner_price}}"
                                       disabled>
                            </div>
                            <div class="form-group col-lg-2 col-sm-12">
                                <label class="form-control-label">Quantité</label>
                                <input class="form-control" type="text" placeholder="Quantité" name="provider"
                                       value="{{$toner->pivot->quantity}}"
                                       disabled>
                            </div>
                            <hr class="my-1"/>
                        </div>
                    @endforeach
                    <hr class="my-1"/>
                    <h6 class="heading-small text-muted mb-4">List des produits</h6>
                    @foreach($invoice->inStockProducts as $inStockProduct)
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-control-label">Produit</label>
                                <input class="form-control" type="text" placeholder="Numéro Facture"
                                       name="serial_number"
                                       value="{{$inStockProduct->material}}" disabled>
                            </div>
                            <div class="form-group col-lg-4 col-sm-12">
                                <label class="form-control-label">prix</label>
                                <input class="form-control" type="text" placeholder="prix" name="provider"
                                       value="{{$inStockProduct->pivot->product_price}}"
                                       disabled>
                            </div>
                            <div class="form-group col-lg-2 col-sm-12">
                                <label class="form-control-label">Quantité</label>
                                <input class="form-control" type="text" placeholder="Quantité" name="provider"
                                       value="{{$inStockProduct->pivot->quantity}}"
                                       disabled>
                            </div>
                            <hr class="my-1"/>
                        </div>
                    @endforeach
                    <hr class="my-1"/>

                    <div class="card-footer bg-transparent">
                        <h3 class="mb-0">Facturé par: <strong>{{$invoice->helpDesk->user->name}}</strong></h3>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>

@endsection

