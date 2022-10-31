@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('category-create') }}" method="post" enctype="multipart/form-data">
    @csrf

    <table align="center">
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
    </table>

    <button type="submit">Create</button>

</form>

@endsection