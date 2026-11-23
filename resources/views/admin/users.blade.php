@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('heading', 'Manajemen Pengguna')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Peran Saat Ini</th>
                <th>Ubah Peran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengguna as $u)
                <tr>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->no_hp ?? '-' }}</td>
                    <td><span class="badge">{{ ucfirst($u->role) }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.role', $u) }}" class="actions">
                            @csrf @method('PATCH')
                            <select name="role" style="width: auto; margin: 0; padding: 7px 10px;">
                                <option value="pengirim" @selected($u->role === 'pengirim')>Pengirim</option>
                                <option value="traveler" @selected($u->role === 'traveler')>Traveler</option>
                                <option value="admin" @selected($u->role === 'admin')>Admin</option>
                            </select>
                            <button class="btn sm" type="submit">Simpan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 14px;">{{ $pengguna->links() }}</div>
</div>
@endsection