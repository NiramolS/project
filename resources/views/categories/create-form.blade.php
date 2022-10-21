@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('category-create') }}" method="post">
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