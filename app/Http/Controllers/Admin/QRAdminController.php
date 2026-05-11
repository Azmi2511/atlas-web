<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QRToken;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRAdminController extends Controller
{
    public function index()
    {
        $tokens = QRToken::with('classroom')->latest()->paginate(15);
        $classrooms = ClassRoom::all();
        return view('admin.qr.index', compact('tokens', 'classrooms'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classrooms,id',
            'valid_until' => 'nullable|date_format:H:i'
        ]);

        $token = Str::random(64);
        $validUntil = $request->valid_until ?: now()->addHours(2)->format('H:i');

        QRToken::create([
            'token' => $token,
            'class_id' => $request->class_id,
            'valid_for_date' => now()->toDateString(),
            'valid_until' => $validUntil,
            'is_active' => true
        ]);

        $qrImage = QrCode::size(300)->generate(route('api.qr.verify', $token));

        return view('admin.qr.show', compact('qrImage', 'token'));
    }

    public function deactivate(QRToken $qrToken)
    {
        $qrToken->update(['is_active' => false]);
        return redirect()->route('admin.qr.index')->with('success', 'QR code dinonaktifkan');
    }
}