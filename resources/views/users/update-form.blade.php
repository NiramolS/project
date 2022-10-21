@extends('layouts.main')

@section('title', $title)

@section('content')
<form action="{{ route('user-update', [
'user' => $user->email,
]) }}" method="post">
    @csrf
    <table class="update-table" border="0">
        <tr>
            <td>E-mail</td>
            <td class="td1">::</td>
            <td><input type="text" name="email" value="{{ old('email', $user->email) }}" /></td>
        </tr>
        <tr>
            <td>Name</td>
            <td class="td1">::</td>
            <td><input type="text" name="name" value="{{ old('name', $user->name) }}" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td class="td1">::</td>
            <td><input type="password" name="password" placeholder="Leave blank if you don't need to edit" /></td>
        </tr>
        <tr>
            <td>Role</td>
            <td class="td1">::</td>
            <td><select name="role" required>
                    @foreach($roles as $role)
                    <option value="{{ $role }}" @selected(old('role', $user->role)) === $role)>
                        {{ $role }}
                    </option>
                    @endforeach
                </select></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><button type="submit">Update</button></td>
        </tr>
    </table>
</form>
@endsection