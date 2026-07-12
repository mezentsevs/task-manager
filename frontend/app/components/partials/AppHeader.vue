<template>
    <div class="fixed right-4 top-4 z-50 flex items-center gap-2">
        <UserBadge v-if="userName" :name="userName" />
        <ThemeToggle />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useAuthStore } from '~/stores/auth';
import { useRoute } from 'vue-router';
import ThemeToggle from '~/components/uikit/toggles/ThemeToggle.vue';
import UserBadge from '~/components/uikit/badges/UserBadge.vue';

const route = useRoute();
const authStore = useAuthStore();

const userName = computed<string>(() => {
    if (route.path === '/login' || route.path === '/register') {
        return '';
    }

    return authStore.user?.name ?? '';
});
</script>
