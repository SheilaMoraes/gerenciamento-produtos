@extends('layouts.master')

@section('title', 'Produto - Editar')

@section('content_header')
    <div class="row">
        <span style="float: none">
            <a href="{{ route('product.index') }}" class="btn btn-primary">Voltar</a>
        </span>
        <span style="float: inline-start">
            <h1> Detalhes do Produto</h1>
        </span>
    </div>
@stop

@section('content')
    @include('includes.alerts')

    <div class="card card-body">
        <div class="card-body">
            <h5 class="card-title" style="font-size: 18pt"><strong>Produto: </strong> {{ $product->description }}</h5>
            <br>
            <br>
            <ul class="list-unstyled" style="font-size: 12pt">
                <li>
                    <p class="card-text"><strong>Criado em:</strong> {{ date( 'd/m/Y h:i:s' , strtotime($product->created_at)) }}</p>
                </li>
                <hr>

                <li>
                    <p class="card-text"><strong>Atualizado em:</strong> {{ date( 'd/m/Y h:i:s' , strtotime($product->updated_at)) }}</p>
                </li>
                <hr>

                <li>
                    <p class="card-text"><strong>Slug:</strong> {{ $product->slug }}</p>
                </li>
                <hr>

                <li>
                    <p class="card-text"><strong>Categoria:</strong> {{ $product->category }}</p>
                </li>
                <hr>

                <li>
                    <p class="card-text"><strong>Preço:</strong> R$ {{ formatQtd($product->price) }}</p>
                </li>
            </ul>
        </div>
    </div>
@endsection
