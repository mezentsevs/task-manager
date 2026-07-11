<template>
    <AuthCard>
        <template #logo>
            <NuxtLink to="/">
                <LogoIcon class="h-12 w-12 text-blue-500 dark:text-blue-600" />
            </NuxtLink>
        </template>

        <Heading :level="1" class="mb-6 text-center text-2xl">Register</Heading>
        <form @submit.prevent="handleRegister">
            <InputLabel for="name" value="Name" />
            <Input id="name" v-model="form.name" class="mb-4 w-full" required autocomplete="on" />
            <InputLabel for="email" value="Email" />
            <Input
                id="email"
                v-model="form.email"
                type="email"
                class="mb-4 w-full"
                required
                autocomplete="on" />
            <InputLabel for="password" value="Password" />
            <Input
                id="password"
                v-model="form.password"
                type="password"
                class="mb-4 w-full"
                required />
            <InputLabel for="passwordConfirmation" value="Confirm Password" />
            <Input
                id="passwordConfirmation"
                v-model="form.passwordConfirmation"
                type="password"
                class="mb-4 w-full"
                required />
            <PrimaryButton class="w-full">Register</PrimaryButton>
            <ErrorMessage :message="error" />
        </form>
        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            Already have an account?
            <PrimaryRouterLink to="/login">Login</PrimaryRouterLink>
        </p>
    </AuthCard>
</template>

<script setup lang="ts">
import { applyToken } from '~/helpers/TokenHelper';
import { ref, reactive } from 'vue';
import { useAuthStore } from '~/stores/auth';
import { useRouter } from 'vue-router';
import AuthCard from '~/components/partials/cards/AuthCard.vue';
import ErrorMessage from '~/components/uikit/messages/ErrorMessage.vue';
import Heading from '~/components/uikit/headings/Heading.vue';
import Input from '~/components/uikit/inputs/Input.vue';
import InputLabel from '~/components/uikit/inputs/partials/InputLabel.vue';
import LogoIcon from '~/components/icons/LogoIcon.vue';
import PrimaryButton from '~/components/uikit/buttons/PrimaryButton.vue';
import PrimaryRouterLink from '~/components/uikit/links/PrimaryRouterLink.vue';

const authStore = useAuthStore();
const router = useRouter();

const form = reactive({
    name: '',
    email: '',
    password: '',
    passwordConfirmation: '',
});
const error = ref<string>('');

const handleRegister = async (): Promise<void> => {
    try {
        await authStore.register(form.name, form.email, form.password, form.passwordConfirmation);
        applyToken(authStore.token);
        await router.push('/');
    } catch (err) {
        error.value = 'Registration failed';
    }
};
</script>
