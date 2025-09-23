<x-sidebar-layout>
    <x-slot name="header">Edit Staff</x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <p class="font-bold">Oops! Ada beberapa hal yang perlu diperbaiki:</p>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="max-w-2xl mx-auto">
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Data User</h3>
                                
                                <!-- Nama Lengkap -->
                                <div>
                                    <x-input-label for="name" value="Nama Lengkap" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <x-input-label for="email" value="Email" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password (Optional) -->
                                <div>
                                    <x-input-label for="password" value="Password Baru (Kosongkan jika tidak ingin mengubah)" />
                                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <!-- Role -->
                                <div>
                                    <x-input-label for="role" value="Role" />
                                    <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Pilih Role</option>
                                        @if($user->role === 'admin')
                                            <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                                        @endif
                                        <option value="pd_teknis" @selected(old('role', $user->role) == 'pd_teknis')>PD Teknis</option>
                                        <option value="dpmptsp" @selected(old('role', $user->role) == 'dpmptsp')>DPMPTSP</option>
                                        <option value="penerbitan_berkas" @selected(old('role', $user->role) == 'penerbitan_berkas')>Penerbitan Berkas</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Update Staff') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-sidebar-layout>