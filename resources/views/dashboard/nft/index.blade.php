@extends('layouts.dasboard')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <div class="container mt-5">
            <h1>Liste des Nfts</h1>
            <table id="userTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>artiste</th>
                        <th>proprietaire</th>
                        <th>price</th>
                        <th>categorie</th>
                        <th>status</th>
                        <th>image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nfts as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->artiste }}</td>
                            <td>{{ $item->owner->name }}</td>
                            <td>{{ number_format($item->price, 2) }} Eth</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->for_sale ? 'A vendre' : 'vendu' }}</td>
                            <td><img src="{{ $item->image }}" height="100" width="100" /></td>
                            <td></td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
