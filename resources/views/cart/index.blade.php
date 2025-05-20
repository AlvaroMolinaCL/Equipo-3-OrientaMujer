@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tu Carrito</h2>

    @if ($items->isEmpty())
        <p>No hay productos en el carrito.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Producto eliminado' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ $item->price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
