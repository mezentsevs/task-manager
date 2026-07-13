<template>
    <header class="sticky top-0 z-50 h-16 bg-gray-100 dark:bg-gray-900">
        <div class="flex h-full items-center justify-end px-4">
            <UserBadge v-if="userName" :name="userName" class="mr-2" />
            <ThemeToggle />
        </div>
    </header>
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
