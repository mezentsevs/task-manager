<template>
    <div>
        <AppHeader />
        <NuxtPage />
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
