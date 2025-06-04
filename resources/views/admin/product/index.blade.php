@extends('layouts.master')

@section('title', 'Produtos')

@section('content_header')
    <div class="row">
        <span style="float: none">
            <a href="{{ route('product.create') }}" class="btn btn-success">Novo</a>
        </span>
        <span style="float: inline-start">
            <h1>Produtos Cadastrados</h1>
        </span>
    </div>
@stop

@section('content')
    @include('includes.alerts')
    <div class="card">
        <table class="table table-houver table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Criado em</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Slug</th>
                <th class="text-center">Preço</th>
                <th class="text-center">Ação</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="align-middle">{{ $product->id }}</td>
                    <td class="align-middle">{{ date( 'd/m/Y h:i:s' , strtotime($product->created_at)) }}</td>
                    <td class="align-middle">{{ $product->description }}</td>
                    <td class="align-middle">{{ $product->category }}</td>
                    <td class="align-middle">{{ $product->slug }}</td>
                    <td class="align-middle" style="text-align: right;">{{ formatQtd($product->price) }}</td>
                    <td class="text-center align-middle">
                        <a class="btn btn-info" href="{{ route('product.show', $product->id) }}">
                            Ver
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete({{ $product->id }}, '{{ $product->description }}')">
                            Excluir
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhum produto cadastrado!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete(productId, productName) {
            Swal.fire({
                title: "Tem certeza?",
                text: `Deseja excluir o produto "${productName}"? Esta ação não pode ser desfeita.`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement("form");
                    form.method = "POST";
                    form.action = "/admin/product/" + productId;

                    var csrfToken = document.createElement("input");
                    csrfToken.type = "hidden";
                    csrfToken.name = "_token";
                    csrfToken.value = "{{ csrf_token() }}";
                    form.appendChild(csrfToken);

                    var methodInput = document.createElement("input");
                    methodInput.type = "hidden";
                    methodInput.name = "_method";
                    methodInput.value = "DELETE";
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@stop
