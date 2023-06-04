<?php

namespace App\Http\Controllers\Pakar;

use App\Http\Controllers\Controller;
use App\Models\Kepribadian;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
class KepribadianController extends Controller
{
    public function authPakar(){
        $role = User::find(Auth::id())->role;

        if ($role == "user") {
            return redirect()->route("home");
        } elseif ($role == "admin") {
            return redirect()->route("admin.index");
        }
    }
    public function index()
    {
        $this->authPakar();

        $data = [
            'kepribadians' => Kepribadian::all()
        ];
        return Inertia::render('Pakar/ManajemenKepribadian', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authPakar();
        
        return Inertia::render('Pakar/TambahKepribadian');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $path = Storage::url( ($request->ilustrasi)->store('','ilustrasi_disk'));
        $this->authPakar();
        $kepribadian = new Kepribadian;
        $kepribadian->jenis_kepribadian = $request->jenis_kepribadian;
        $kepribadian->deskripsi = $request->deskripsi;
        $kepribadian->ilustrasi = $path;
        $kepribadian->save();

        return redirect(route('pakar.kepribadian.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $this->authPakar();
        $data = [
            'id' => $id,
            'kepribadian' => Kepribadian::find($id)
        ];
        return Inertia::render('Pakar/TambahKepribadian', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kepribadian $kepribadian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authPakar();
        $kepribadian = Kepribadian::find($id);
        $kepribadian->delete();
        return redirect(route('pakar.kepribadian.index', $kepribadian));
    }
}
