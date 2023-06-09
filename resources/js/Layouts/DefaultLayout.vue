<template>
  <header
    class="w-full h-[60px] bg-white shadow-md flex items-center justify-between px-10"
  >
    <div class="max-w-[150px]">
      <img src="/images/logo.svg" class="min-w-[60px]" />
    </div>
    <div class="flex items-center justify-center gap-10">
      <Link href="/" class="text-lg text-gray-900 hover:underline cursor-pointer">
        Jobs
      </Link>
      <Link href="/" class="text-lg text-gray-900 hover:underline cursor-pointer">
        Consultants
      </Link>
      <Link href="/" class="text-lg text-gray-900 hover:underline cursor-pointer">
        Twitter
      </Link>
      <Link href="/" class="text-lg text-gray-900 hover:underline cursor-pointer">
        Login
      </Link>
    </div>

    <div></div>

    <div class="fixed z-100 top-0 right-0 mt-2 pr-10 flex items-center">
      <button
        class="p-2 mr-4 px-4 border text-md border-blue-600 bg-blue-200 hover:bg-white hover:text-blue-500"
      >
        Hire a Consultant
      </button>
      <button
        class="p-2 text-[#FFFFFF] px-4 border text-md hover:border-blue-600 hover:border bg-blue-600 hover:bg-white hover:text-blue-500"
      >
        Post a Job
      </button>
    </div>
  </header>

  <main>
    <slot />
  </main>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
