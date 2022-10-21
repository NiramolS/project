@extends('layouts.main')

@section('title', $title)

@section('content')
<main class=main-main>
    <form class="form" action="{{ route('user-list') }}" method="get">
        <table class="search-table">
            <tr>
                <td class="td1">Search</td>
                <td class="td1">::</td>
                <td><input type="text" name="term" value="{{ $search['term'] }}" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" class="primary">Search</button>
                    <a href="{{ route('user-list') }}">
                        <button type="button" class="accent">Clear</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>
    <table>
        <nav>
            <ul>
            @can('create', \App\Models\User::class)
                <li>
                    <button class="new-button"><a href="{{ route('user-create-form') }}">New User</a></button>
                </li>
            @endcan
            </ul>
        </nav>

        <thead>
            <tr>
                <th>E-mail</th>
                <th>Name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><a href="{{ route('user-view', [
                    'user' => $user->email, ]) }}">{{ $user->email }}</a></td>
                <td class="name">{{ $user->name }}</td>
                <td class="name">{{ $user->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection