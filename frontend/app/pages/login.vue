<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md rounded-lg bg-white p-8 shadow-md dark:bg-gray-800">
            <h1 class="mb-6 text-center text-2xl font-bold text-gray-800 dark:text-gray-100">
                Login
            </h1>
            <form @submit.prevent="handleLogin">
                <div class="mb-4">
                    <InputLabel for="email" value="Email" />
                    <Input
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mb-4 w-full"
                        required
                        autocomplete="on" />
                </div>
                <div class="mb-4">
                    <InputLabel for="password" value="Password" />
                    <Input
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mb-4 w-full"
                        required />
                </div>
                <button
                    type="submit"
                    class="w-full rounded bg-indigo-500 px-4 py-2 text-white hover:bg-indigo-600">
                    Login
                </button>
                <p v-if="error" class="mt-2 text-center text-sm text-red-500">{{ error }}</p>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
                Don't have an account?
                <NuxtLink to="/register" class="text-indigo-500 hover:underline">Register</NuxtLink>
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { applyToken } from '~/helpers/TokenHelper';
import { ref, reactive } from 'vue';
import { useAuthStore } from '~/stores/auth';
import { useRouter } from 'vue-router';
import Input from '~/components/uikit/inputs/Input.vue';
import InputLabel from '~/components/uikit/inputs/partials/InputLabel.vue';

const authStore = useAuthStore();
const router = useRouter();

const form = reactive({ email: '', password: '' });
const error = ref<string>('');

const handleLogin = async (): Promise<void> => {
    try {
        await authStore.login(form.email, form.password);
        applyToken(authStore.token);
        await router.push('/');
    } catch (err) {
        error.value = 'Login failed';
    }
};
</script>
