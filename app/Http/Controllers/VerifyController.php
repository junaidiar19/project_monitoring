<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $tugas = Tugas::find($request->id);

        if($request->val == 'true'){
            $tugas->update(['status' => 1]);

            $data = [
                'status' => 'success',
                'message' => 'Tugas Berhasil di Verifikasi',
            ];
        }else{
            $tugas->update(['status' => 2]);

            $data = [
                'status' => 'success',
                'message' => 'Verifikasi tugas berhasil dibatalkan',
            ];
        }
        
        return response()->json($data);
    }
}
