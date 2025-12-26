<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        confirmDelete('Hapus Data User', 'Apakah anda yakin menghapus data user ini?');
        return view('users.index', compact('users'));
    }

    public function store(Request $request){
    $id = $request->id;
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email' . $id,
    ],
    [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
    ]);

    $newRequest = $request->all();

    if (!$id) {
        $newRequest['password'] = Hash::make('12345678');
    }

    User::updateOrCreate(['id' => $id], $newRequest);
    toast()->success('Data user berhasil disimpan.', 'success');
    return redirect()->route('users.index');
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
        'old_password' => 'required',
        'password' => 'required|min:8|confirmed',
        // 'password' => [Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ],[
        'old_password.required' => 'Password lama wajib diisi.',
        'password.required' => 'Password baru wajib diisi.',
        'password.min' => 'Password baru minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',            
        ]);

        $user = User::find(Auth::id());

        // check old password
        if (!Hash::check($request->old_password, $user->password)) {
            toast()->error('Password lama tidak sesuai.', 'error');
            return redirect()->route('dashboard');
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        toast()->success('Password berhasil diubah.', 'success');
        return redirect()->route('dashboard');
    }

    public function destroy(String $id)
    {
        $user = User::findOrFail($id);

        if(Auth::id() == $id){
            toast()->error('Tidak dapat menghapus akun yang sedang login');
            return redirect()->route('users.index');
        }
        $user->delete();

        toast()->success('Data user berhasil dihapus.', 'success');
        return redirect()->route('users.index');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->id);
        $user->update([
            'password' => Hash::make('12345678')
        ]);

        toast()->success('Password user berhasil direset.', 'success');
        return redirect()->route('users.index');
    }
}