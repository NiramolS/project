<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" herf="{{ asset('css/project') }}" />
</head>

<body>
    <header>
        <h1 class="cmp-title">
            LOGIN
        </h1>
    </header>
    <main>
        <form action="{{ route('authenticate') }}" method="post">
        @csrf
            <div class="login">
                <label>
                    <b>Email</b>
                    <input type="text" name="email" require />
                </label><br>

                <label>
                    <b>Password</b>
                    <input type="password" name="password" require />
                </label><br>

                <button type="submit">Login</button>
                @error('credentials')
                <div class="warn">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </main>
</body>
</html>