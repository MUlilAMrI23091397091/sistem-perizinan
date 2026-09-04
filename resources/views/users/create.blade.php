<x-sidebar-layout>
    <x-slot name="header">Tambah Staff Baru</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gray-100 border border-gray-300 rounded-md flex items-center justify-center text-gray-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Data User</h2>
                        <p class="text-xs text-gray-500">Lengkapi informasi staff baru</p>
                    </div>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-gray-50 border border-gray-300 rounded-md">
                            <p class="font-bold text-sm text-gray-900">Oops! Ada beberapa hal yang perlu diperbaiki:</p>
                            <ul class="list-disc list-inside mt-2 text-xs text-gray-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.store') }}" class="space-y-4" x-data="{ role: '{{ old('role', '') }}' }">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="name" class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input id="name" class="block w-full px-3 py-2 border border-gray-300 focus:border-gray-900 focus:ring-gray-900 rounded-md text-sm" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            <div class="md:col-span-2">
                                <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                                <input id="email" class="block w-full px-3 py-2 border border-gray-300 focus:border-gray-900 focus:ring-gray-900 rounded-md text-sm font-mono" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@dpmptsp.surabaya.go.id" />
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <div>
                                <label for="password" class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                                <input id="password" class="block w-full px-3 py-2 border border-gray-300 focus:border-gray-900 focus:ring-gray-900 rounded-md text-sm" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <input id="password_confirmation" class="block w-full px-3 py-2 border border-gray-300 focus:border-gray-900 focus:ring-gray-900 rounded-md text-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>

                            <div>
                                <label for="role" class="block text-xs font-medium text-gray-700 mb-1">Role</label>
                                <select name="role" id="role" x-model="role" class="block w-full px-3 py-2 border border-gray-300 focus:border-gray-900 focus:ring-gray-900 rounded-md text-sm bg-white" required>
                                    <option value="">Pilih Role</option>
                                    <option value="pd_teknis">PD Teknis</option>
                                    <option value="dpmptsp">DPMPTSP</option>
                                    <option value="penerbitan_berkas">Penerbitan Berkas</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-1" />
                            </div>

                            <div id="sektor-field" x-show="role === 'pd_teknis'" x-cloak>
                                <label for="sektor" class="block text-xs font-medium text-gray-700 mb-1">Sektor <span class="text-red-500">*</span></label>
                                <select name="sektor" id="sektor" :required="role === 'pd_teknis'" :disabled="role !== 'pd_teknis'" class="block w-full px-3 py-2 border border-gray-300 focus:border-gray-900 focus:ring-gray-900 rounded-md text-sm bg-white">
                                    <option value="">Pilih Sektor</option>
                                    <option value="Dinkopdag" @selected(old('sektor') == 'Dinkopdag')>Dinkopdag - Dinas Koperasi dan Perdagangan</option>
                                    <option value="Disbudpar" @selected(old('sektor') == 'Disbudpar')>Disbudpar - Dinas Kebudayaan dan Pariwisata</option>
                                    <option value="Dinkes" @selected(old('sektor') == 'Dinkes')>Dinkes - Dinas Kesehatan</option>
                                    <option value="Dishub" @selected(old('sektor') == 'Dishub')>Dishub - Dinas Perhubungan</option>
                                    <option value="Dprkpp" @selected(old('sektor') == 'Dprkpp')>Dprkpp - Dinas Perumahan Rakyat dan Kawasan Permukiman</option>
                                    <option value="Dkpp" @selected(old('sektor') == 'Dkpp')>Dkpp - Dinas Ketahanan Pangan dan Pertanian</option>
                                    <option value="Dlh" @selected(old('sektor') == 'Dlh')>Dlh - Dinas Lingkungan Hidup</option>
                                    <option value="Disperinaker" @selected(old('sektor') == 'Disperinaker')>Disperinaker - Dinas Perindustrian dan Tenaga Kerja</option>
                                </select>
                                <x-input-error :messages="$errors->get('sektor')" class="mt-1" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 mt-6">
                            <a href="{{ route('users.index') }}" class="px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-md hover:bg-gray-50 text-xs font-medium">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-black text-xs font-medium">
                                SIMPAN STAFF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-sidebar-layout>
