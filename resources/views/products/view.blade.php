@extends('layouts.main')

@section('title', $title)

@section('content')
<main>
    <nav>
        <ul>
            <li>
                <a href="{{ route('product-update-form', ['product' => $product->code,]) }}">Update</a>
            </li>
            <li>
                <a href="{{ route('product-delete', ['product' => $product->code,]) }}">Delete</a>
            </li>
        </ul>
    </nav>

    <table width="50%">
        <tr>
        <td rowspan="4">
            <img src="{{ Storage::url($product->image) }}" alt=""  class="img-product-view" >
        </td>
        <tr>
            <td>Code ::</td>
            <td>{{ $product->code }}</td>
        </tr>
        <tr>
            <td>Product :: </td>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <td>Category ::</td>
            <td>{{ $product->category->name }}</td>
        </tr>
        <td>Price ::</td>
        <td>{{ number_format((float) $product->price,2) }}</td>
        </tr>

    </table>
</main>

@endsection