@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('category-update', ['category' => $category->code,]) }}" method="post" enctype="multipart/form-data">
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
                <input type="text" name="code" value="{{ $category->code }}" />
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
                <input type="file" name="image">
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
                <input type="text" name="name"  value="{{ $category->name }}" />
            </td>
        </tr>
    </table>

    <button type="submit">Update</button>

</form>

@endsection