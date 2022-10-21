@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('product-create') }}" method="post" enctype="multipart/form-data">
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
                <input type="text" name="code" />
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
                <input type="file" name="image" />
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
                <input type="text" name="name" />
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
                    <option value="">--Please Select Category--</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->code }}">[{{ $category->code }}] {{ $category->name }}</option>
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
                <input type="number" step="any" name="price" />
            </td>
        </tr>
    </table>

    <button type="submit">Create</button>

</form>

@endsection