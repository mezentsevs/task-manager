<template>
    <button class="rounded-full bg-gray-200 p-2 dark:bg-gray-800" @click="toggleTheme">
        <ThemeLightIcon v-if="isDark" class="h-6 w-6 text-gray-200" />
        <ThemeDarkIcon v-else class="h-6 w-6 text-gray-800" />
    </button>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import ThemeDarkIcon from '~/components/icons/ThemeDarkIcon.vue';
import ThemeLightIcon from '~/components/icons/ThemeLightIcon.vue';

const isDark = ref<boolean>(false);

const applyTheme = (dark: boolean): void => {
    document.documentElement.classList.toggle('dark', dark);
    localStorage.setItem('theme', dark ? 'dark' : 'light');
};

const toggleTheme = (): void => {
    isDark.value = !isDark.value;
    applyTheme(isDark.value);
};

onMounted(() => {
    const savedTheme = localStorage.getItem('theme');
    isDark.value = savedTheme === 'dark';
    applyTheme(isDark.value);
});
</script>
