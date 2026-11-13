<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Kedai kopi Senja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #142b60, #294fc1)
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .login-card{
            width: 100%;
            max-width: 515px;
            background: white;
            padding: 48px;
            border-radius: 22px;
        }

        .login-icon{
            width: 62px;
            height: 62px;
            background: #4169f5;
            border-radius: 18px;
            margin: auto auto 20px;
        }

        .login-title{
            color: #142750;
            font-size: 30px;
            font-weight: 700;
        }

        .login-subtitle{
            color: #7b89a8;
            font-size:16px;
        }

        .form-label{
            color: #4b5b7c;
            font-weight: 600;
            font-size: 15px;
        }

        .form-control{
            height: 59px;
            border: 1.5px solid #d4def5;
            border-radius: 15px;
            padding: 12px 18px;
            font-size:16px;
        }

        .form-control:focus{
            border-color: #4169f5;
            box-shadow: 0 0 0 3px rgba(65,105,245,.12);
        }

        .role-button{
            height: 50px;
            border: 1.5px solid #d4def5;
            border-radius: 15px;
            color: #71809f;
            font-weight:600;
            display:flex;
            justify-content:center;
            align-items: center;
        }

        .btn-check:checked + .role-button{
            background: #4169f5;
            color: white;
            border-color: #4169f5;
        }

        .btn-login{
            height: 58px;
            background: #4169f5;
            color: white;
            border:none;
            border-radius:15px;
            font-weight: 600;
            font-size:17px;
        }

        .btn-login:hover{
            background: #3157d5;
            color:white;
        }

        @media(max-width: 576px) {
            .login-card{
                margin:20px;
                padding: 30px 24p;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="text-center mb-3">
            <div class="login-icon"></div>

            <h1 class="login-title mb-1">
                Kedai Kopi Senja
            </h1>

            <p class="login-subtitle">
                Masuk untuk Kasir dan manajer
            </p>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            {{$errors->first()}}
        </div>
        @endif
        <form action="{{route('login.process') }}" method="POST">
            @csrf
        <label class="form-label mb2">Masuk sebagai</label>
        <div class="row g-2 mb-3">
            <div class="col -6">
                <input type="radio"
                    class="btn-check"
                    name="role"
                    id="kasir"
                    value="kasir"
                    checked
                    >

                    <label class="role-button w-100" for="kasir">kasir</label>
            </div>
            <div class="col-6">
                <input 
                type="radio"
                class="btn-check"
                name="role"
                id="manajer"
                value="manajer"
                >
                <label class="role-button w-100" for="manajer">Manajer</label>
            </div>

        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text"
            name="username"
            class="form-control"
            placeholder="nama pengguna"
            value="{{old('username') }}"
            required
            >
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>

            <input type="password"
            name="password"
            class="form-control"
            placeholder="Masukkan Password"
            required
            >
        </div>

        <button type="submit" class="btn btn-login w-100">Masuk</button>
        </form>
    </div>
    
</body>
</html>