{{-- FILE: resources/views/partials/table-dpm.blade.php --}}
{{-- PERBAIKAN: Menerjemahkan status 'Dipending' menjadi 'Dikembalikan' di tampilan. --}}
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead style="background-color: #253B7E;">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider" style="color: #E0E7FF;">Nama Usaha</th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider" style="color: #E0E7FF;">Alamat</th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider" style="color: #E0E7FF;">Modal Usaha</th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider" style="color: #E0E7FF;">Jenis Proyek</th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider" style="color: #E0E7FF;">Verifikasi DPMPTSP</th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider" style="color: #E0E7FF;">Status</th>
                <th scope="col" class="relative px-6 py-3"><span class="sr-only" style="color: #E0E7FF;">Aksi</span></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($permohonans as $p)
            @php
                $statusClasses = match ($p->status) {
                    'Diterima' => 'bg-green-100 text-green-800',
                    'Ditolak' => 'bg-red-100 text-red-800',
                    'Dipending' => 'bg-yellow-100 text-yellow-800',
                    default => 'bg-gray-100 text-gray-800',
                };
                $verificationClasses = match ($p->verifikasi_dpmptsp) { 'Berkas Disetujui' => 'bg-green-100 text-green-800', 'Berkas Diperbaiki' => 'bg-yellow-100 text-yellow-800', 'Pemohon Dihubungi' => 'bg-orange-100 text-orange-800', 'Berkas Diunggah Ulang' => 'bg-red-100 text-red-800', 'Pemohon Belum Dihubungi' => 'bg-purple-100 text-purple-800', default => '', };
            @endphp
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-gray-900">{{ $p->nama_usaha }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-700">{{ Str::limit($p->alamat_perusahaan, 30) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-700">Rp {{ is_numeric($p->modal_usaha) ? number_format($p->modal_usaha, 0, ',', '.') : $p->modal_usaha }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-700">{{ $p->jenis_proyek }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    @if($p->verifikasi_dpmptsp)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $verificationClasses }}">{{ $p->verifikasi_dpmptsp }}</span>
                    @else - @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
                        {{-- Logika untuk mengubah tampilan --}}
                        {{ $p->status == 'Dipending' ? 'Dikembalikan' : $p->status }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('permohonan.show', $p) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>