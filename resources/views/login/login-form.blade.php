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
            <label>
                E-mail :: <input type="text" name="email" required />
            </label><br />
            <label>
                Password :: <input type="password" name="password" required />
            </label><br />
            <button type="submit" onClick="return false;">Log in</button>
            @error('credentials')
            <div class="warn">{{ $message }}</div>
            @enderror
        </form>
    </main>
</body>
</html>