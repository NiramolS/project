@extends('layouts.main')

@section('title', $title)

@section('content')
<form action="{{ route('user-create') }}" method="post">
    @csrf

    <table class="create-table" border="0">
        <tr>
            <td class="td1">E-mail</td>
            <td class="td1">::</td>
            <td><input type="text" name="email" value="{{ old('email') }}" /></td>
        </tr>
        <tr>
            <td class="td1">Name</td>
            <td class="td1">::</td>
            <td><input type="text" name="name" value="{{ old('name') }}" /></td>
        </tr>
        <tr>
            <td class="td1">Password</td>
            <td class="td1">::</td>
            <td><input type="password" name="password" value="{{ old('password') }}" /></td>
        </tr>
        <tr>
            <td class="td1">Role</td>
            <td class="td1">::</td>
            <td><select name="role" required>
                    <option value="">-- Please select role--</option>
                    @foreach($roles as $role)
                    <option value="{{ $role }}" @selected(old('role')===$role)>{{$role}}</option>
                    @endforeach
                </select></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><button type="submit">Create</button></td>
        </tr>

    </table>

</form>
@endsection