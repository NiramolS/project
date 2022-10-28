@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('product-update', ['product' => $product->code,]) }}" method="post" enctype="multipart/form-data">
    @csrf

    <table>
        <tr>
            <td>
                Code
            </td>
            <td>
                ::
            </td>
            <td>
                <input type="text" name="code" required value="{{ old('code', $product->code) }}"/>
            </td>
        </tr>
        <tr>
            <td>
                Image
            </td>
            <td>
                ::
            </td>
            <td>
                <input type="file" name="image" >
            </td>
        </tr>
        <tr>
            <td>
                Name
            </td>
            <td>
                ::
            </td>
            <td>
                <input type="text" name="name" required value="{{ old('name', $product->name) }}" />
            </td>
        </tr>
        <tr>
            <td>
                Category
            </td>
            <td>
                ::
            </td>
            <td>
            <select name="category" id="inp-category" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->code }}"
                        @selected (old('category', $product->category->code === $category->code))>
                        [{{ $category->code }}] {{ $category->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Price
            </td>
            <td>
                ::
            </td>
            <td>
                <input type="number" step="any" name="price" required value="{{ old('price', $product->price) }}" />
            </td>
        </tr>
    </table>

    <button type="submit">Update</button>

</form>

@endsection