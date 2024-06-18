<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResultApi extends Controller
{
    public function index()
    {
        try {
            $alldata = DB::table('result')->get();
            return response()->json(['Data Result' => $alldata]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($result_id)
    {
        try {
            $dataResult = DB::table('result')->where('result_id', $result_id)->first();
            if (!$dataResult) {
                return response()->json(['message' => 'Data Result not found'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($dataResult);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showUser($user)
    {
        try {
            $dataResult = DB::table('result')->where('user', $user)->get();
            if ($dataResult->isEmpty()) {
                return response()->json(['message' => 'Data Result not found'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($dataResult);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'user' => 'required',
                'skor' => 'required|integer', // contoh validasi, sesuaikan dengan kebutuhan
            ]);
    
            // Membuat id hasil secara otomatis
            $newResult = new Result();
            $newResult->user = $request->input('user');
            $newResult->skor = $request->input('skor');
            $newResult->taken_at = now(); // now() untuk mendapatkan timestamp saat ini
            $newResult->save(); // Simpan entri ke dalam tabel Result
    
            // Berikan respons success bersama data yang baru dibuat
            return response()->json(['message' => 'Data Result berhasil ditambah', 'data' => $newResult], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            $errorMessage = 'Terjadi kesalahan: ' . $e->getMessage();
            // Jika validation exception
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                $errorMessage = 'Validasi gagal: ' . json_encode($e->errors());
            }
            return response()->json(['message' => $errorMessage], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    

    // public function store(Request $request)
    // {
    //     try {
    //         $this->validate($request, [
    //             'user' => 'required',
    //             'skor' => 'required|integer',
    //         ]);

    //         $result_id = DB::table('result')->insertGetId([
    //             'user' => $request->input('user'),
    //             'skor' => $request->input('skor'),
    //             'taken_at' => Carbon::now(),
    //         ]);

    //         $newResult = DB::table('result')->where('result_id', $result_id)->first();

    //         return response()->json(['message' => 'Data Result berhasil ditambah', 'data' => $newResult], Response::HTTP_CREATED);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    public function update(Request $request, $result_id)
    {
        try {
            $this->validate($request, [
                'user' => 'required',
                'skor' => 'required|integer',
            ]);

            $affected = DB::table('result')
                ->where('result_id', $result_id)
                ->update([
                    'user' => $request->input('user'),
                    'skor' => $request->input('skor'),
                    'taken_at' => Carbon::now(),
                ]);

            if ($affected > 0) {
                $updatedResult = DB::table('result')->where('result_id', $result_id)->first();
                return response()->json(['message' => 'Data Result berhasil diupdate', 'data' => $updatedResult], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Data Result not found'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
