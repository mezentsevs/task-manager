<template>
    <div
        class="flex min-h-screen flex-col items-center pt-12 sm:justify-center sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <slot name="base-logo" />
        <div
            class="mt-6 w-full max-w-sm overflow-hidden px-6 py-4 bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <slot />
        </div>
    </div>
</template>
