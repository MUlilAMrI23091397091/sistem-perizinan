<x-sidebar-layout>
    <x-slot name="header">
        Dashboard Penerbitan Berkas
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header dengan Judul Laporan -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-center text-gray-900 mb-2">
                    PERIZINAN BERUSAHA DISETUJUI
                </h1>
                <h2 class="text-xl font-semibold text-center text-gray-800 mb-1">
                    DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU
                </h2>
                <h3 class="text-lg font-medium text-center text-gray-700">
                    KOTA SURABAYA TAHUN {{ date('Y') }}
                </h3>
            </div>

            <!-- Tabel Data Permohonan -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 3%;">NO</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 12%;">NO. PERMOHONAN</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 12%;">NO. PROYEK</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 10%;">TANGGAL PERMOHONAN</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 8%;">NIB</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 6%;">KBLI</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 12%;">NAMA USAHA</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 12%;">KEGIATAN</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 8%;">JENIS PERUSAHAAN</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 10%;">PEMILIK</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 8%;">MODAL USAHA</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 12%;">ALAMAT</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 6%;">JENIS PROYEK</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 12%;">NAMA PERIZINAN</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 8%;">SKALA USAHA</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 8%;">RISIKO</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 15%;">PEMROSES DAN TGL. E SURAT DAN TGL PERTEK</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($permohonans->count() > 0)
                                @foreach($permohonans as $index => $permohonan)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->no_permohonan ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->no_proyek ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $permohonan->tanggal_permohonan ? \Carbon\Carbon::parse($permohonan->tanggal_permohonan)->format('d F Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->nib ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->kbli ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->nama_usaha ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->inputan_teks ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->jenis_pelaku_usaha ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->nama_usaha ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $permohonan->modal_usaha ? 'Rp ' . number_format($permohonan->modal_usaha, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->alamat_perusahaan ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->jenis_proyek ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permohonan->inputan_teks ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($permohonan->modal_usaha)
                                            @if($permohonan->modal_usaha <= 1000000000)
                                                Mikro
                                            @elseif($permohonan->modal_usaha <= 5000000000)
                                                Usaha Kecil
                                            @elseif($permohonan->modal_usaha <= 10000000000)
                                                Usaha Menengah
                                            @else
                                                Usaha Besar
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">Menengah Tinggi</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU<br>
                                        No: BAP/OSS/IX/{{ $permohonan->no_permohonan ?? 'N/A' }}/436.7.15/{{ date('Y') }}<br>
                                        tanggal BAP: {{ date('d F Y') }}
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="17" class="px-4 py-8 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data permohonan</h3>
                                            <p class="mt-1 text-sm text-gray-500">Belum ada data permohonan yang tersedia.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Input Data Baru -->
            <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-6">Tambah Data Permohonan Baru</h3>
                
                <form method="POST" action="{{ route('permohonan.store') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- No. Permohonan -->
                        <div>
                            <x-input-label for="no_permohonan" value="No. Permohonan" />
                            <x-text-input id="no_permohonan" class="block mt-1 w-full" type="text" name="no_permohonan" :value="old('no_permohonan')" required />
                            <x-input-error :messages="$errors->get('no_permohonan')" class="mt-2" />
                        </div>

                        <!-- No. Proyek -->
                        <div>
                            <x-input-label for="no_proyek" value="No. Proyek" />
                            <x-text-input id="no_proyek" class="block mt-1 w-full" type="text" name="no_proyek" :value="old('no_proyek')" required />
                            <x-input-error :messages="$errors->get('no_proyek')" class="mt-2" />
                        </div>

                        <!-- Tanggal Permohonan -->
                        <div>
                            <x-input-label for="tanggal_permohonan" value="Tanggal Permohonan" />
                            <x-text-input id="tanggal_permohonan" class="block mt-1 w-full" type="date" name="tanggal_permohonan" :value="old('tanggal_permohonan')" required />
                            <x-input-error :messages="$errors->get('tanggal_permohonan')" class="mt-2" />
                        </div>

                        <!-- NIB -->
                        <div>
                            <x-input-label for="nib" value="NIB" />
                            <x-text-input id="nib" class="block mt-1 w-full" type="text" name="nib" :value="old('nib')" required />
                            <x-input-error :messages="$errors->get('nib')" class="mt-2" />
                        </div>

                        <!-- KBLI -->
                        <div>
                            <x-input-label for="kbli" value="KBLI" />
                            <x-text-input id="kbli" class="block mt-1 w-full" type="text" name="kbli" :value="old('kbli')" required />
                            <x-input-error :messages="$errors->get('kbli')" class="mt-2" />
                        </div>

                        <!-- Nama Usaha -->
                        <div>
                            <x-input-label for="nama_usaha" value="Nama Usaha" />
                            <x-text-input id="nama_usaha" class="block mt-1 w-full" type="text" name="nama_usaha" :value="old('nama_usaha')" required />
                            <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
                        </div>

                        <!-- Kegiatan -->
                        <div>
                            <x-input-label for="inputan_teks" value="Kegiatan" />
                            <x-text-input id="inputan_teks" class="block mt-1 w-full" type="text" name="inputan_teks" :value="old('inputan_teks')" required />
                            <x-input-error :messages="$errors->get('inputan_teks')" class="mt-2" />
                        </div>

                        <!-- Jenis Perusahaan -->
                        <div>
                            <x-input-label for="jenis_pelaku_usaha" value="Jenis Perusahaan" />
                            <select name="jenis_pelaku_usaha" id="jenis_pelaku_usaha" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Jenis Perusahaan</option>
                                <option value="Orang Perseorangan" @selected(old('jenis_pelaku_usaha') == 'Orang Perseorangan')>Orang Perseorangan</option>
                                <option value="Badan Usaha" @selected(old('jenis_pelaku_usaha') == 'Badan Usaha')>Badan Usaha</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_pelaku_usaha')" class="mt-2" />
                        </div>

                        <!-- Pemilik -->
                        <div>
                            <x-input-label for="pemilik" value="Pemilik" />
                            <x-text-input id="pemilik" class="block mt-1 w-full" type="text" name="pemilik" :value="old('pemilik')" required />
                            <x-input-error :messages="$errors->get('pemilik')" class="mt-2" />
                        </div>

                        <!-- Modal Usaha -->
                        <div>
                            <x-input-label for="modal_usaha" value="Modal Usaha" />
                            <x-text-input id="modal_usaha" class="block mt-1 w-full" type="number" name="modal_usaha" :value="old('modal_usaha')" required />
                            <x-input-error :messages="$errors->get('modal_usaha')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div>
                            <x-input-label for="alamat_perusahaan" value="Alamat" />
                            <x-text-input id="alamat_perusahaan" class="block mt-1 w-full" type="text" name="alamat_perusahaan" :value="old('alamat_perusahaan')" required />
                            <x-input-error :messages="$errors->get('alamat_perusahaan')" class="mt-2" />
                        </div>

                        <!-- Jenis Proyek -->
                        <div>
                            <x-input-label for="jenis_proyek" value="Jenis Proyek" />
                            <select name="jenis_proyek" id="jenis_proyek" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Jenis Proyek</option>
                                <option value="Utama" @selected(old('jenis_proyek') == 'Utama')>Utama</option>
                                <option value="Pendukung" @selected(old('jenis_proyek') == 'Pendukung')>Pendukung</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_proyek')" class="mt-2" />
                        </div>

                        <!-- Nama Perizinan -->
                        <div>
                            <x-input-label for="nama_perizinan" value="Nama Perizinan" />
                            <x-text-input id="nama_perizinan" class="block mt-1 w-full" type="text" name="nama_perizinan" :value="old('nama_perizinan')" required />
                            <x-input-error :messages="$errors->get('nama_perizinan')" class="mt-2" />
                        </div>

                        <!-- Skala Usaha -->
                        <div>
                            <x-input-label for="skala_usaha" value="Skala Usaha" />
                            <select name="skala_usaha" id="skala_usaha" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Skala Usaha</option>
                                <option value="Mikro" @selected(old('skala_usaha') == 'Mikro')>Mikro</option>
                                <option value="Usaha Kecil" @selected(old('skala_usaha') == 'Usaha Kecil')>Usaha Kecil</option>
                                <option value="Usaha Menengah" @selected(old('skala_usaha') == 'Usaha Menengah')>Usaha Menengah</option>
                                <option value="Usaha Besar" @selected(old('skala_usaha') == 'Usaha Besar')>Usaha Besar</option>
                            </select>
                            <x-input-error :messages="$errors->get('skala_usaha')" class="mt-2" />
                        </div>

                        <!-- Risiko -->
                        <div>
                            <x-input-label for="risiko" value="Risiko" />
                            <select name="risiko" id="risiko" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Risiko</option>
                                <option value="Rendah" @selected(old('risiko') == 'Rendah')>Rendah</option>
                                <option value="Menengah Rendah" @selected(old('risiko') == 'Menengah Rendah')>Menengah Rendah</option>
                                <option value="Menengah Tinggi" @selected(old('risiko') == 'Menengah Tinggi')>Menengah Tinggi</option>
                                <option value="Tinggi" @selected(old('risiko') == 'Tinggi')>Tinggi</option>
                            </select>
                            <x-input-error :messages="$errors->get('risiko')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <x-primary-button>
                            {{ __('Simpan Data') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Kolom TTD -->
            <div class="bg-white shadow-sm rounded-lg p-6" x-data="{ editTTD: false }">
                <!-- Header dengan tombol edit -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Tanda Tangan Digital</h3>
                    <button @click="editTTD = !editTTD" 
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span x-text="editTTD ? 'Selesai Edit' : 'Edit TTD'"></span>
                    </button>
                </div>

                <!-- Form Edit TTD (Hidden by default) -->
                <div x-show="editTTD" x-transition class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <form method="POST" action="{{ route('ttd-settings.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Mengetahui Section -->
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Bagian Mengetahui</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="mengetahui_title" value="Judul" />
                                    <x-text-input id="mengetahui_title" class="block mt-1 w-full" type="text" name="mengetahui_title" :value="old('mengetahui_title', $ttdSettings->mengetahui_title)" required />
                                </div>

                                <div>
                                    <x-input-label for="mengetahui_jabatan" value="Jabatan" />
                                    <x-text-input id="mengetahui_jabatan" class="block mt-1 w-full" type="text" name="mengetahui_jabatan" :value="old('mengetahui_jabatan', $ttdSettings->mengetahui_jabatan)" required />
                                </div>

                                <div>
                                    <x-input-label for="mengetahui_unit" value="Unit Kerja" />
                                    <x-text-input id="mengetahui_unit" class="block mt-1 w-full" type="text" name="mengetahui_unit" :value="old('mengetahui_unit', $ttdSettings->mengetahui_unit)" required />
                                </div>

                                <div>
                                    <x-input-label for="mengetahui_nama" value="Nama Lengkap" />
                                    <x-text-input id="mengetahui_nama" class="block mt-1 w-full" type="text" name="mengetahui_nama" :value="old('mengetahui_nama', $ttdSettings->mengetahui_nama)" required />
                                </div>

                                <div>
                                    <x-input-label for="mengetahui_pangkat" value="Pangkat/Golongan" />
                                    <x-text-input id="mengetahui_pangkat" class="block mt-1 w-full" type="text" name="mengetahui_pangkat" :value="old('mengetahui_pangkat', $ttdSettings->mengetahui_pangkat)" required />
                                </div>

                                <div>
                                    <x-input-label for="mengetahui_nip" value="NIP" />
                                    <x-text-input id="mengetahui_nip" class="block mt-1 w-full" type="text" name="mengetahui_nip" :value="old('mengetahui_nip', $ttdSettings->mengetahui_nip)" required />
                                </div>
                            </div>
                        </div>

                        <!-- Menyetujui Section -->
                        <div class="pb-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Bagian Menyetujui</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="menyetujui_title" value="Judul & Tanggal" />
                                    <x-text-input id="menyetujui_title" class="block mt-1 w-full" type="text" name="menyetujui_title" :value="old('menyetujui_title', $ttdSettings->menyetujui_title)" required />
                                    <p class="text-xs text-gray-500 mt-1">Gunakan {{ date('d F Y') }} untuk tanggal otomatis</p>
                                </div>

                                <div>
                                    <x-input-label for="menyetujui_jabatan" value="Jabatan" />
                                    <x-text-input id="menyetujui_jabatan" class="block mt-1 w-full" type="text" name="menyetujui_jabatan" :value="old('menyetujui_jabatan', $ttdSettings->menyetujui_jabatan)" required />
                                </div>

                                <div>
                                    <x-input-label for="menyetujui_nama" value="Nama Lengkap" />
                                    <x-text-input id="menyetujui_nama" class="block mt-1 w-full" type="text" name="menyetujui_nama" :value="old('menyetujui_nama', $ttdSettings->menyetujui_nama)" required />
                                </div>

                                <div>
                                    <x-input-label for="menyetujui_pangkat" value="Pangkat/Golongan" />
                                    <x-text-input id="menyetujui_pangkat" class="block mt-1 w-full" type="text" name="menyetujui_pangkat" :value="old('menyetujui_pangkat', $ttdSettings->menyetujui_pangkat)" required />
                                </div>

                                <div>
                                    <x-input-label for="menyetujui_nip" value="NIP" />
                                    <x-text-input id="menyetujui_nip" class="block mt-1 w-full" type="text" name="menyetujui_nip" :value="old('menyetujui_nip', $ttdSettings->menyetujui_nip)" required />
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                            <button type="button" @click="editTTD = false" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </button>
                            <x-primary-button>
                                {{ __('Simpan Pengaturan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Tampilan TTD -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Mengetahui -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-4">{{ $ttdSettings->mengetahui_title }}</p>
                        <p class="text-sm text-gray-600 mb-2">{{ $ttdSettings->mengetahui_jabatan }}</p>
                        <p class="text-sm text-gray-600 mb-4">{{ $ttdSettings->mengetahui_unit }}</p>
                        <div class="h-20 border-b border-gray-300 mb-2"></div>
                        <p class="text-sm font-medium text-gray-900">{{ $ttdSettings->mengetahui_nama }}</p>
                        <p class="text-sm text-gray-600">{{ $ttdSettings->mengetahui_pangkat }}</p>
                        <p class="text-sm text-gray-600">NIP: {{ $ttdSettings->mengetahui_nip }}</p>
                    </div>

                    <!-- Menyetujui -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-4">{{ $menyetujuiTitle }}</p>
                        <p class="text-sm text-gray-600 mb-2">{{ $ttdSettings->menyetujui_jabatan }}</p>
                        <div class="h-20 border-b border-gray-300 mb-2"></div>
                        <p class="text-sm font-medium text-gray-900">{{ $ttdSettings->menyetujui_nama }}</p>
                        <p class="text-sm text-gray-600">{{ $ttdSettings->menyetujui_pangkat }}</p>
                        <p class="text-sm text-gray-600">NIP: {{ $ttdSettings->menyetujui_nip }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-sidebar-layout>