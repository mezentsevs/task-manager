<template>
    <div class="flex flex-col items-center justify-center h-full">
        <div class="text-center">
            <LogoIcon class="w-12 h-12 mx-auto mb-4 text-blue-500 dark:text-blue-600" />
            <Heading :level="1" class="mb-2 text-4xl">{{ APP_NAME }}</Heading>
            <p class="mb-8 text-lg text-gray-600 dark:text-gray-400">{{ APP_SLOGAN }}</p>

            <div class="flex flex-col items-center gap-4">
                <PrimaryButton class="w-48" @click="goToTasks">Go to Tasks</PrimaryButton>
                <PrimaryButton class="w-48" @click="handleLogout">Logout</PrimaryButton>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { APP_NAME, APP_SLOGAN } from '~/consts/AppConsts';
import { computed } from 'vue';
import { useAuthStore } from '~/stores/auth';
import { useRouter } from 'vue-router';
import Heading from '~/components/uikit/headings/Heading.vue';
import LogoIcon from '~/components/icons/LogoIcon.vue';
import PrimaryButton from '~/components/uikit/buttons/PrimaryButton.vue';

const authStore = useAuthStore();
const router = useRouter();

const userName = computed<string>((): string => authStore.user?.name ?? '');

const goToTasks = (): void => {
    router.push('/tasks');
};

const handleLogout = async (): Promise<void> => {
    await authStore.logout();
    await router.push('/login');
};
</script>
