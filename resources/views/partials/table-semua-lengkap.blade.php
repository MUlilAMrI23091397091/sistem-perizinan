{{-- FILE: resources/views/partials/table-semua-lengkap.blade.php --}}
{{-- PERBAIKAN: Menerjemahkan status 'Dipending' menjadi 'Dikembalikan' di tampilan. --}}

<table class="min-w-full divide-y divide-gray-200 bg-white rounded-md shadow">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No. Permohonan</th>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No. Proyek</th>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama Usaha</th>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Alamat Perusahaan</th>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse ($permohonans as $p)
        @php
            $statusClasses = match ($p->status) {
                'Diterima' => 'bg-green-100 text-green-800',
                'Ditolak' => 'bg-red-100 text-red-800',
                'Dipending' => 'bg-yellow-100 text-yellow-800',
                default => 'bg-gray-100 text-gray-800',
            };
        @endphp
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-700">{{ $p->no_permohonan }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-700">{{ $p->no_proyek }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-gray-900">{{ $p->nama_usaha }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-base text-gray-700">{{ Str::limit($p->alamat_perusahaan, 40) }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
                    {{-- Logika untuk mengubah tampilan --}}
                    {{ $p->status == 'Dipending' ? 'Dikembalikan' : $p->status }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="{{ route('permohonan.show', $p) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                @if($p->status_menghubungi)
                    <div class="text-xs text-gray-500 mt-1 italic">{{ $p->status_menghubungi }}</div>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                Tidak ada data permohonan yang ditemukan.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>