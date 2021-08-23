@extends('layouts.app')

@section('header')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Stock</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Toners</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral col-4" data-toggle="modal"
                           data-target="#exampleModal">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered col-9" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Toner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route("toner.store")}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reference" class="form-control-label">Référence</label>
                            <input class="form-control" type="text" placeholder="Référence" name="reference"
                                   id="reference" required>
                        </div>
                        <div class="form-group">
                            <label for="color" class="form-control-label">Couleur</label>
                            <select class="form-control" id="color" name="color" required>
                                <option value="Noir">Noir</option>
                                <option value="Jaune">Jaune</option>
                                <option value="Magenta">Magenta</option>
                                <option value="Cyan">Cyan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="form-control-label">Quantité</label>
                            <input class="form-control" type="text" placeholder="quantité" name="quantity" id="quantity"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
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
                            <th scope="col" class="sort" data-sort="name">Référence</th>
                            <th scope="col" class="sort" data-sort="budget">Couleur</th>
                            <th scope="col" class="sort" data-sort="status">Quantité</th>
                            <th scope="col" class="sort" data-sort="status">Stock affecté</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($toners as $toner)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$toner->reference}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="budget">
                                    {{$toner->color}}
                                </td>
                                <td class="budget">
                                    {{$toner->quantity}}
                                </td>
                                <td class="budget">
                                    {{$toner->printers()->sum('quantity')}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Action</a>
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

