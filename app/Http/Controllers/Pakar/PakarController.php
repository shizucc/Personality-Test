<?php

namespace App\Http\Controllers\Pakar;
use App\Http\Controllers\Controller;
use App\Models\CiriCiri;
use App\Models\DaftarPertanyaan;
use App\Models\UserKepribadian;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\Kepribadian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PakarController extends Controller
{
    public function authPakar(){
        $role = User::find(Auth::id())->role;

        if ($role == "user") {
            return redirect()->route("home");
        } elseif ($role == "admin") {
            return redirect()->route("admin.index");
        }
    }
    public function index(){
        // Redirect apabila role user tidak sesuai

        $this->authPakar();
        $pertanyaans = DaftarPertanyaan::with('ciri')->get();
        $data = [
            'columns' => [
                'pertanyaans' => $pertanyaans->map(function($pertanyaan){
                    return $pertanyaan->pertanyaan;
                }),
                'ciri_ciris' => $pertanyaans->map(function($pertanyaan){
                    return $pertanyaan->ciri->ciri;
                }),
                'kepribadians' => $pertanyaans->map(function($pertanyaan){
                    $kepribadian = Kepribadian::where('id', $pertanyaan->ciri->kepribadian_id)->value('jenis_kepribadian');
                    return $kepribadian;
                })      
            ]
            ];
        return Inertia::render('Pakar/Index',$data);
    }

    public function histori(){
        // Redirect apabila role user tidak sesuai
        $this->authPakar();

        $data = [
            'historis'=> User::with('kepribadians')->orderBy('id', 'asc')->get()
        ];
        return Inertia::render('Pakar/HistoriDiagnosa', $data);
    }
}
