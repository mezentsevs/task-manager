<template>
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        <AppHeader />
        <main class="flex-1 overflow-auto flex items-center justify-center">
            <NuxtPage />
        </main>
    </div>
</template>

<script setup lang="ts">
import '~/assets/css/main.css';
import { onMounted } from 'vue';
import { retrieveToken } from '~/helpers/TokenHelper';
import { useAuthStore } from '~/stores/auth';
import AppHeader from '~/components/partials/AppHeader.vue';

const authStore = useAuthStore();

onMounted(async () => {
    if (retrieveToken() && !authStore.user) {
        await authStore.fetchMe();
    }
});
</script>
