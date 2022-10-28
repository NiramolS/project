@extends('layouts.main')

@section('title', $title)

@section('content')
<nav>
    <ul>
       
        <li>
            <a href="{{ route('user-update-form', ['user' => $user->email,]) }}">Update</a>
        </li>
        
        <li>
            <a href="{{ route('user-delete', ['user' => $user->email,]) }}">Delete</a>
        </li>
    </ul>
</nav>
<main>
    <p>
        <b>E-mail ::</b>
        <span>{{ $user->email }}</span><br>
        <b>Name ::</b>
        <span><i>{{ $user->name }}</i></span><br>
        <b>Role ::</b>
        <span>{{ $user->role  }}</span><br>
    </p>
</main>

@endsection