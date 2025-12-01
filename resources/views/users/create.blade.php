<x-sidebar-layout>
    <x-slot name="header">Tambah Staff Baru</x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-200" style="background-color: #F8FAFC;">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: #253B7E;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-semibold text-gray-900">Data User</h2>
                            <p class="text-sm text-gray-500 mt-1">Lengkapi informasi staff baru</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-red-800">Oops! Ada beberapa hal yang perlu diperbaiki:</p>
                                    <ul class="list-disc list-inside mt-2 text-sm text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="name" value="Nama Lengkap" class="text-gray-700 font-medium" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <x-text-input id="name" class="block w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="email" value="Email" class="text-gray-700 font-medium" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <x-text-input id="email" class="block w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@dpmptsp.surabaya.go.id" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" value="Password" class="text-gray-700 font-medium" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <x-text-input id="password" class="block w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="password" name="password" required autocomplete="new-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-700 font-medium" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <x-text-input id="password_confirmation" class="block w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="role" value="Role" class="text-gray-700 font-medium" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <select name="role" id="role" class="block w-full pl-10 pr-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm appearance-none bg-white" required onchange="toggleSectorField()">
                                        <option value="">Pilih Role</option>
                                        <option value="pd_teknis" @selected(old('role') == 'pd_teknis')>PD Teknis</option>
                                        <option value="dpmptsp" @selected(old('role') == 'dpmptsp')>DPMPTSP</option>
                                        <option value="penerbitan_berkas" @selected(old('role') == 'penerbitan_berkas')>Penerbitan Berkas</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div id="sektor-field" style="display: none;">
                                <x-input-label for="sektor" value="Sektor" class="text-gray-700 font-medium" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <select name="sektor" id="sektor" class="block w-full pl-10 pr-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm appearance-none bg-white">
                                        <option value="">Pilih Sektor</option>
                                        <option value="Dinkopdag" @selected(old('sektor') == 'Dinkopdag')>Dinkopdag - Dinas Koperasi dan Perdagangan</option>
                                        <option value="Disbudpar" @selected(old('sektor') == 'Disbudpar')>Disbudpar - Dinas Kebudayaan dan Pariwisata</option>
                                        <option value="Dinkes" @selected(old('sektor') == 'Dinkes')>Dinkes - Dinas Kesehatan</option>
                                        <option value="Dishub" @selected(old('sektor') == 'Dishub')>Dishub - Dinas Perhubungan</option>
                                        <option value="Dprkpp" @selected(old('sektor') == 'Dprkpp')>Dprkpp - Dinas Pemberdayaan Perempuan dan Perlindungan Anak</option>
                                        <option value="Dkpp" @selected(old('sektor') == 'Dkpp')>Dkpp - Dinas Ketahanan Pangan dan Perikanan</option>
                                        <option value="Dlh" @selected(old('sektor') == 'Dlh')>Dlh - Dinas Lingkungan Hidup</option>
                                        <option value="Disperinaker" @selected(old('sektor') == 'Disperinaker')>Disperinaker - Dinas Perindustrian dan Tenaga Kerja</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('sektor')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-8">
                            <a href="{{ route('users.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 text-white rounded-lg transition-colors duration-200 font-medium shadow-md hover:shadow-lg" style="background-color: #253B7E;">
                                SIMPAN STAFF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSectorField() {
            const roleSelect = document.getElementById('role');
            const sektorField = document.getElementById('sektor-field');
            const sektorSelect = document.getElementById('sektor');
            
            if (roleSelect.value === 'pd_teknis') {
                sektorField.style.display = 'block';
                sektorSelect.required = true;
            } else {
                sektorField.style.display = 'none';
                sektorSelect.required = false;
                sektorSelect.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            if (roleSelect.value === 'pd_teknis') {
                toggleSectorField();
            }
        });
    </script>
</x-sidebar-layout>
