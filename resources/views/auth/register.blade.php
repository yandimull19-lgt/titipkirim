<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - TitipKirim</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f6f2e8; display: grid; place-items: center; min-height: 100vh; color: #26352d; margin: 0; padding: 20px; }
        .box { background: white; padding: 30px; border-radius: 16px; width: 100%; max-width: 420px; box-shadow: 0 4px 16px #26352d0d; border: 1px solid #e7e8df; }
        h1 { margin-top: 0; color: #285943; }
        label { font-size: 13px; font-weight: 700; display: block; margin-top: 8px; }
        input { width: 100%; padding: 11px; border: 1px solid #d9ded8; border-radius: 8px; margin: 6px 0 10px; box-sizing: border-box; }
        button { width: 100%; background: #285943; color: white; border: 0; border-radius: 9px; padding: 12px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        a { color: #285943; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Buat Akun TitipKirim</h1>
        @if($errors->any())
            <ul style="color: #a94442; font-size: 13px; padding-left: 18px;">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <label>Nama lengkap</label>
            <input name="name" value="{{ old('name') }}" required>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            <label>Nomor HP</label>
            <input name="no_hp" value="{{ old('no_hp') }}">
            <label>Kata sandi</label>
            <input type="password" name="password" required>
            <label>Ulangi kata sandi</label>
            <input type="password" name="password_confirmation" required>
            <button type="submit">Daftar</button>
        </form>
        <p style="font-size: 14px; margin-top: 18px;">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </div>
</body>
</html>