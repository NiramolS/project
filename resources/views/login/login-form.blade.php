<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LOG-IN</h1>
    <main>
        <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <table>
            <tr>
                <td>E-mail</td>
                <td>::</td>
                <td><input type="text" name="email" required/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>::</td>
                <td><input type="password" name="password" required/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit">Login</button></td>
            </tr>
        @error('credentials')
            <div class="warn">{{ $message }}</div>
        @enderror
        </form>
    </main>
</body>
</html>