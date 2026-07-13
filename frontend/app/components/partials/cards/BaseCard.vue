<template>
    <div class="flex flex-col items-center justify-center h-full bg-gray-100 dark:bg-gray-900">
        <slot name="base-logo" />
        <div
            class="w-full max-w-sm overflow-hidden mt-6 px-6 py-4 bg-white dark:bg-gray-800 sm:rounded-lg shadow-md">
            <slot />
        </div>
    </div>
</template>
