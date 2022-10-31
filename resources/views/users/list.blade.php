@extends('layouts.main')

@section('title', $title)

@section('content')

<body>
    <form action="{{ route('user-list') }}" method="get" class="search-form">
        <label for="search">
            <input type="text" placeholder="Search..." name="term" value="{{ $search['term'] }}" />
        </label>
        <button type="submit" class="btn-submit-search">Search</button>
        <a href="{{ route('user-list') }}">
            <button type="button" class="accent">Clear</button>
        </a><br />
    </form>


    <button>
        <a href="{{ route('user-create-form') }}">New User</a>
    </button>

    <div class="paginate">{{ $users->withQueryString()->links() }}</div>

    <main class=main-main>
        <table class="user-table">
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
                    <td>
                        <nav><a href="{{ route('user-view', [
                    'user' => $user->email, ]) }}">{{ $user->email }}</a>
                            <nav>
                    </td>
                    <td class="name">{{ $user->name }}</td>
                    <td class="name">{{ $user->role }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
@endsection