<x-dashboard-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-white mb-1">Perfil</h2>
            <p class="text-gray-400">Gerencie suas informações pessoais e configurações de conta</p>
        </div>

        <!-- Profile Information -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="bg-gray-800 rounded-xl border border-red-500/30 shadow-xl p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-dashboard-layout>
