<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div
    class="flex flex-col items-center pt-[56px] bg-gray-100"
  >
    <div>
      <Link href="/">
        <img src="/images/logo.svg" class="min-w-[50px] max-h-[50px]" />
      </Link>
    </div>

    <div
      class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>
