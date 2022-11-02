<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/project.css')}}">
</head>

<body style="background-color:#A02228;">

    <main class="login-form" >
    <header>
        <center>
        <h1 class="cmp-title">
            LOGIN
        </h1>
        </center>
    </header>
            <form action="{{ route('authenticate') }}" method="post">
                @csrf
                <table>
                    <tr>
                        <td>E-mail</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="email"  /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password"  /></td>
                    </tr>
                    <tr>
                        <td>
                            <center><button type="submit">Login</button></center>
                        </td>
                    </tr>
                </table>

                @error('credentials')
                <div class="warn">{{ $message }}</div>
                @enderror
        </div>
        </form>

    </main>

</body>

</html>