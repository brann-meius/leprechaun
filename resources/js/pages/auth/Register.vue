<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-50 p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg p-8 shadow-lg">
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1">
                            <input
                                id="username"
                                v-model="form.username"
                                type="text"
                                required
                                placeholder="Enter your username"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                            />
                            <span v-if="form.errors.username" class="text-red-500 text-sm">{{ form.errors.username }}</span>
                        </div>
                    </div>
                    <div>
                        <label for="phonenumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <div class="mt-1">
                            <input
                                id="phonenumber"
                                v-model="form.phone"
                                type="tel"
                                required
                                placeholder="Enter your phone number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                            />
                            <span v-if="form.errors.phone" class="text-red-500 text-sm">{{ form.errors.phone }}</span>
                        </div>
                    </div>
                    <div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full flex justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-3 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Registering...' : 'Register' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    username: '',
    phone: ''
});

function submit() {
    form.post(route('register.store'), {
        onError: () => {
            // Ошибки автоматически попадают в form.errors
        }
    });
}
</script>
