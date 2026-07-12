<template>
    <button class="rounded-full bg-gray-200 p-2 dark:bg-gray-800" @click="toggleTheme">
        <ThemeLightIcon v-if="isDark" class="h-6 w-6 text-gray-200" />
        <ThemeDarkIcon v-else class="h-6 w-6 text-gray-800" />
    </button>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import ThemeDarkIcon from '~/components/icons/ThemeDarkIcon.vue';
import ThemeLightIcon from '~/components/icons/ThemeLightIcon.vue';

const isDark = ref<boolean>(false);

const toggleTheme = (): void => {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle('dark', isDark.value);
};
</script>
