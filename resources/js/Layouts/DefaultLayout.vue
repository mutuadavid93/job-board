<template>
  <header
    class="fixed w-full z-50 h-[60px] bg-white shadow-md flex items-center justify-between px-10"
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

    <div class="flex items-center justify-end">
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

  <div class="bg-[#F4F4F5] w-full border-t border-t-[#E5E7EB]">
    <div class="flex flex-col items-center justify-center mt-8 pb-12">
      <div class="text-gray-600 text-xl">Trusted by leading Laravel shops worldwide</div>
      <PartnersLogo />
      <p class="mx-[26%] text-center text-lg text-gray-900 mt-4 font-extrabold">
        "The process was drop-dead simple, and we were shocked by the quality and volume
        of responses we got by posting on LaraJobs – miles above the usual job boards."
      </p>
      <div class="mt-6 text-lg font-extrabold">Tommy McGuire</div>
      <div class="mt-3 text-gray-600 text-xl">Modern McGuire Productions</div>

      <div class="flex items-center justify-center mt-12">
        <div class="cursor-pointer text-gray-600 hover:text-black mr-8">Jobs</div>
        <div class="cursor-pointer text-gray-600 hover:text-black mr-8">Consultants</div>
        <div class="cursor-pointer text-gray-600 hover:text-black mr-8">Contact</div>
        <div class="cursor-pointer text-gray-600 hover:text-black mr-8">RSS</div>
        <div class="cursor-pointer text-gray-600 hover:text-black">Twitter</div>
      </div>

      <div class="text-gray-500 mt-6">
        Built by UserScape in partnership with Laravel News
      </div>
      <div class="text-gray-500 mt-2">© 2014 - 2023</div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import PartnersLogo from "@/Components/PartnersLogo.vue";
</script>
