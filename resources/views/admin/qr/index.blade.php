<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-3xl font-extrabold text-blue-900">Manajemen QR Code</h1>
            <button onclick="openModal()" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl shadow-md">+ Generate QR Baru</button>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-blue-100">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700">Token</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700">Berlaku Sampai</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tokens as $token)
                    <tr>
                        <td class="px-6 py-4 font-mono text-sm">{{ substr($token->token, 0, 16) }}...</td>
                        <td class="px-6 py-4">{{ $token->class->name }}</td>
                        <td class="px-6 py-4">{{ $token->valid_until ? \Carbon\Carbon::parse($token->valid_until)->format('H:i') : '-' }}</td>
                        <td class="px-6 py-4">
                            @if($token->is_active)
                                <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                                <span class="text-red-600">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($token->is_active)
                            <form action="{{ route('admin.qr.deactivate', $token) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Nonaktifkan QR ini?')">Nonaktifkan</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $tokens->links() }}
    </div>
</div>

<div id="qrModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Generate QR Code</h2>
        <form action="{{ route('admin.qr.generate') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-blue-800 font-semibold mb-1">Kelas</label>
                <select name="class_id" class="w-full border rounded-xl p-2" required>
                    @foreach($classrooms as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-blue-800 font-semibold mb-1">Berlaku Sampai Jam</label>
                <input type="time" name="valid_until" class="w-full border rounded-xl p-2" value="{{ now()->addHours(2)->format('H:i') }}">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-xl">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl">Generate</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() { document.getElementById('qrModal').classList.remove('hidden'); }
    function closeModal() { document.getElementById('qrModal').classList.add('hidden'); }
</script>
</x-app-layout>