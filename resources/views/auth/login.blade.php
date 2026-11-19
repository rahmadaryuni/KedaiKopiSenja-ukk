
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kedai Kopi Senja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #F7EDE5, #E8D6C8);
        }

        .login-card {
            width: 100%;
            max-width: 515px;
            padding: 46px;
            background: #FFFFFF;
            border-radius: 22px;
            box-shadow: 0 15px 45px rgba(52, 59, 100, .15);
        }

        .logo {
            width: 62px;
            height: 62px;
            margin: 0 auto 18px;
            border-radius: 18px;
            background: #E8D6C8;
        }

        .brand-title {
            color: #343B64;
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 4px;
        }

        .subtitle {
            color: #817568;
            text-align: center;
            margin-bottom: 28px;
        }

        .form-label {
            color: #343B64;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            height: 58px;
            border: 1px solid #DCC5B3;
            border-radius: 15px;
            padding: 12px 18px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #B99F8D;
            box-shadow: 0 0 0 3px rgba(185, 159, 141, .18);
        }

        .role-button {
            width: 50%;
            height: 58px;
            border: 1px solid #DCC5B3;
            background: #FFFFFF;
            color: #817568;
            font-weight: 600;
            border-radius: 15px;
        }

        .role-button.active {
            background: #343B64;
            color: #FFFFFF;
            border-color: #343B64;
        }

        .btn-login {
            height: 58px;
            width: 100%;
            margin-top: 28px;
            border: none;
            border-radius: 15px;
            background: #343B64;
            color: #FFFFFF;
            font-size: 17px;
            font-weight: 700;
        }

        .btn-login:hover {
            background: #272D50;
            color: #FFFFFF;
        }

        @media(max-width: 500px) {
            .login-card {
                padding: 30px 24px;
            }
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="logo"></div>

    <h1 class="brand-title">Kedai Kopi Senja</h1>
    <p class="subtitle">Masuk untuk Kasir dan Manajer</p>

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <label class="form-label">Masuk sebagai</label>

        <div class="d-flex gap-2 mb-3">
            <button type="button" class="role-button active" id="btnKasir"
                onclick="pilihRole('kasir')">
                Kasir
            </button>

            <button type="button" class="role-button" id="btnManajer"
                onclick="pilihRole('manajer')">
                Manajer
            </button>
        </div>

        <label class="form-label">Username</label>
        <input
            type="text"
            name="username"
            class="form-control mb-3"
            placeholder="nama pengguna"
            value="{{ old('username') }}"
            required
            autofocus
        >

        <label class="form-label">Password</label>
        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Masukkan password"
            required
        >

        @if($errors->any())
            <div class="alert alert-danger mt-3 mb-0">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="btn-login">
            Masuk
        </button>
    </form>

</div>

<script>
    function pilihRole(role) {
        document.getElementById('btnKasir').classList.toggle(
            'active', role === 'kasir'
        );

        document.getElementById('btnManajer').classList.toggle(
            'active', role === 'manajer'
        );
    }
</script>

</body>
</html>
