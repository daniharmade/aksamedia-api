<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Employee::with('division');

            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('division_id')) {
                $query->where('division_id', $request->division_id);
            }

            $employees = $query->paginate(10);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan data karyawan',
                'data' => [
                    'employees' => $employees->items(),
                    'pagination' => [
                        'current_page' => $employees->currentPage(),
                        'last_page' => $employees->lastPage(),
                        'per_page' => $employees->perPage(),
                        'total' => $employees->total(),
                    ],
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data karyawan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(EmployeeStoreRequest $request)
    {
        try {
            $imagePath = $request->file('image')->store('employees', 'public');

            $employee = Employee::create([
                'image' => Storage::url($imagePath),
                'name' => $request->name,
                'phone' => $request->phone,
                'position' => $request->position,
                'division_id' => $request->division,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan karyawan',
                'data' => $employee,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan karyawan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($employee->image && Storage::exists('public/employees/' . basename($employee->image))) {
                    Storage::delete('public/employees/' . basename($employee->image));
                }

                $path = $request->file('image')->store('public/employees');
                $employee->image = Storage::url($path);
            }

            $employee->update([
                'name' => $request->filled('name') ? $request->name : $employee->name,
                'phone' => $request->filled('phone') ? $request->phone : $employee->phone,
                'division_id' => $request->filled('division') ? $request->division : $employee->division_id,
                'position' => $request->filled('position') ? $request->position : $employee->position,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil memperbarui data karyawan',
                'data' => $employee,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Karyawan tidak ditemukan',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data karyawan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            if ($employee->image && Storage::disk('public')->exists('employees/' . basename($employee->image))) {
                Storage::disk('public')->delete('employees/' . basename($employee->image));
            }

            $employee->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus karyawan',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Karyawan tidak ditemukan',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data karyawan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
