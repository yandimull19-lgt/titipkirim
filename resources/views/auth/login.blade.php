<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - TitipKirim</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f6f2e8; display: grid; place-items: center; min-height: 100vh; color: #26352d; margin: 0; }
        .box { background: white; padding: 30px; border-radius: 16px; width: 100%; max-width: 400px; box-shadow: 0 4px 16px #26352d0d; border: 1px solid #e7e8df; }
        h1 { margin-top: 0; color: #285943; }
        label { font-size: 13px; font-weight: 700; display: block; margin-top: 10px; }
        input { width: 100%; padding: 11px; border: 1px solid #d9ded8; border-radius: 8px; margin: 6px 0 12px; box-sizing: border-box; }
        button { width: 100%; background: #285943; color: white; border: 0; border-radius: 9px; padding: 12px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        a { color: #285943; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h1>TitipKirim</h1>
        <p>Masuk ke akun Anda</p>
        @if($errors->any())
            <p style="color: #a94442; font-size: 13px;">{{ $errors->first() }}</p>
        @endif
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            <label>Kata sandi</label>
            <input type="password" name="password" required>
            <label style="font-weight: normal;"><input type="checkbox" name="remember" value="1" style="width: auto; margin-right: 6px;"> Ingat saya</label>
            <button type="submit">Masuk</button>
        </form>
        <p style="font-size: 14px; margin-top: 18px;">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
    </div>
</body>
</html>