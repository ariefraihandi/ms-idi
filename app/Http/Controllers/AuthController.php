<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Instansi;
use App\Models\User;


class AuthController extends Controller
{
    // Metode untuk menampilkan formulir login    
    public function showLoginForm()
    {
        // Ambil semua data instansi dari database
        $instansiData = Instansi::all();

        // Inisialisasi array data
        $data = [
            'logo' => null,
            'shortname' => null,
            
                'title' => 'Auth', // Judul halaman
                'subtitle' => 'Login', // Judul halaman            

        ];

        // Jika ada data instansi
        if (!$instansiData->isEmpty()) {
            // Ambil logo dan short_name dari instansi pertama (sesuaikan dengan struktur model dan field di database Anda)
            $data['logo'] = $instansiData->first()->logo;
            $data['shortname'] = $instansiData->first()->short_name;
        }

        // Meneruskan data ke tampilan
        return view('Konten/Auth', $data);
    }

    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        // Attempt to log in the user with email or username
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]) ||
            Auth::attempt(['username' => $credentials['email'], 'password' => $credentials['password']])) {
            
            $user = Auth::user();
            
            if ($user) {        
                return redirect('/pengawasan')->with('user_role', $user->role);                
            } else {
                // Kredensial berhasil tetapi status tidak memenuhi syarat
                Auth::logout();
                return back()->withInput()->withErrors(['username' => 'Your account is not verified yet.']);
            }
        } else {
            session()->flash('error', 'Username atau Password Tidak Ditemukan');
            return back();
        }
    }

    public function showRegisForm()
    {                
        $data = [
            'title' => 'Auth', // Judul halaman
            'subtitle' => 'Register', // Judul halaman            
        ];
        return view('Konten/AuthRegister', $data);
    }

    public function register(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'token' => 'required|string',
                'terms' => 'accepted',
            ]);

            // Lakukan pengecekan user_key menggunakan HTTP Client Laravel
            $response = Http::post('https://ariefraihandi.biz.id/api/check-user-key', [
                'user_key' => $request->input('token'),
            ]);
            $responseData = $response->json();

            // Periksa apakah request ke API berhasil
            if ($response->successful() && $responseData['message'] === 'User key is valid') {
            
                $existingInstansi = Instansi::where('token', $request->input('token'))->first();

                if ($existingInstansi) {
                    // Token already exists, display an error message
                    session()->flash('error', 'Token is already registered. Contact Developer.');
                    return back();
                }
                
                $instansi = new Instansi();
                $instansi->name = 'default';
                $instansi->short_name = 'default';
                $instansi->long_name = 'default';
                $instansi->alamat = 'default';
                $instansi->email = 'default';
                $instansi->wa = 'default';
                $instansi->logo = 'default.webp';
                $instansi->kop_surat = 'default.webp';
                $instansi->token = $request->input('token');
                $instansi->zip_code = 'default';
                $instansi->country = 'default';
                $instansi->phone_number = 'default';
                $instansi->website = 'default';
                $instansi->description = 'default';
                $instansi->save();

                $admin = new User();
                $admin->name = 'Administrator';
                $admin->username = $request->input('username');
                $admin->email = $request->input('email');
                $admin->role = 1;
                $admin->wa = 'default';
                $admin->token = $request->input('token');
                $admin->image = 'default.webp';
                $admin->password = bcrypt($request->input('password'));
                $admin->save();

                session()->flash('success', 'Pendaftaran Berhasil');

                return redirect()->route('config.instansi')->with('success', 'Registration successful!');
            } else {
                // Set pesan flash error
                session()->flash('error', 'Invalid Token. Registration failed. Hubungi Developer');

                // Redirect kembali ke halaman registrasi
                return back();
            }
        } catch (\Exception $e) {
            // Tangkap exception dan lakukan sesuatu, misalnya log pesan kesalahan
            \Log::error($e->getMessage());

            // Set pesan flash error
            session()->flash('error', 'Terjadi kesalahan. Hubungi Developer');

            // Redirect kembali ke halaman registrasi
            return back();
        }
    }   

    public function addUser(Request $request)
    {
        try {
            // Validasi form input jika diperlukan
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'wa' => 'nullable|string|max:255',
            ]);

            // Buat user baru
            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'wa' => $request->input('wa'),
                'role' => $request->input('role'),
                'password' => Hash::make($request->input('password')),
                'token' => $request->input('token'),
                'image' => "default.webp",
            ]);

     
            session()->flash('success', 'Data berhasil ditambahkan.');
            return back();
        } catch (ValidationException $e) {
            // Redirect dengan pesan kesalahan validasi
            $emailErrorMessage = $e->errors()['email'][0] ?? 'Ada data yang TERDUPLIKASI, Atau Kesalahan PENGINPUTAN.';
            session()->flash('error', $emailErrorMessage);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Redirect dengan pesan kesalahan umum
            session()->flash('error', 'Gagal menambahkan hakim. ' . $e->getMessage());
            return back();
        }
    }

    public function editUser(Request $request)
{
    try {
        // Validasi form input jika diperlukan
        $request->validate([
            'id' => 'required|exists:users,id', // Validasi bahwa id ada dalam tabel users
            'name' => 'required|string|max:255', // Sesuaikan validasi dengan field yang ingin diubah
            'username' => 'required|string|max:255', // Sesuaikan validasi dengan field yang ingin diubah
            'email' => 'required|email|max:255', // Sesuaikan validasi dengan field yang ingin diubah
            'wa' => 'nullable|string|max:255', // Sesuaikan validasi dengan field yang ingin diubah
            // ... tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Ambil user berdasarkan id
        $user = User::findOrFail($request->input('id'));

        // Lakukan perubahan pada data pengguna
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->wa = $request->input('wa');
        // ... tambahkan field lainnya sesuai kebutuhan

        $user->save();

        // Berikan respons sukses
        session()->flash('success', 'Data pengguna berhasil diubah.');
        return back();
    } catch (\Exception $e) {
        // Berikan respons kesalahan
        session()->flash('error', 'Gagal mengubah data pengguna. ' . $e->getMessage());
        return back();
    }
}


    public function deleteUser($id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);

        if ($user) {
            // Hapus user
            $user->delete();

            // Redirect atau berikan respons sesuai kebutuhan
            session()->flash('success', 'User berhasil dihapus.');
            return back();
        } else {
            // Redirect dengan pesan jika user tidak ditemukan
            session()->flash('error', 'User tidak ditemukan.');
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function autoLogout(Request $request)
    {
        Auth::logout();    
        session()->flash('success', 'Logout Berhasil');
        return redirect()->route('login');
    }
}
