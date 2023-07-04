<template>
  <Head title="Home" />

  <DefaultLayout>
    <div class="w-full pb-10">
      <div class="flex items-center justify-center min-w-[1100px] relative">
        <!-- Image overlay -->
        <div class="absolute w-full h-full bg-[#F4F4F5] bg-opacity-80" />

        <div class="absolute top-25 flex flex-col items-center justify-center">
          <div>
            <h2 class="font-extrabold text-6xl">
              <span class="mr-4 text-black">The official</span>
              <span class="text-blue-500">Laravel job board </span>
            </h2>
          </div>
          <p class="mx-[24%] text-center mt-3 font-extrabold">
            "LaraJobs is our first stop whenever we're hiring a Laravel role. We've hired
            10 Laravel developers in the last few years, all thanks to LaraJobs.” —
            Matthew Hall, ArborXR"
          </p>

          <PartnersLogo />
        </div>

        <img src="/images/hero-banner.png" class="w-full object-cover" />
      </div>

      <!-- Content section -->
      <div class="mx-auto max-w-[850px] mt-10">
        <div class="flex items-center justify-between bg-gray-300 rounded-lg p-5">
          <div class="flex items-center">
            <div class="text-gray-900 font-extrabold mr-2">Filter by</div>
            <select
              class="border border-blue-300 rounded-lg min-w-[110px] mr-5 ring-0 focus:ring-0"
            >
              <option value="recent" selected>Recent</option>
              <option value="salary" selected>Salary</option>
              <option value="relevance" selected>Relevance</option>
            </select>
          </div>

          <div
            class="flex items-center min-w-sm rounded-full border border-blue-500 px-4 bg-white"
          >
            <input
              type="text"
              class="w-full border-none ring-0 focus:ring-0"
              placeholder="Search job"
            />
            <div>
              <Magnify fillColor="#000000" :size="28" />
            </div>
          </div>
        </div>

        <div class="mt-8 flex items-center justify-between">
          <div
            class="flex items-center justify-start gap-2 rounded-lg bg-orange-200 hover:bg-orange-300 p-2 text-orange-700"
          >
            <button class="rounded-md bg-orange-500 p-1.5 cursor-default">
              <BullhornOutline fillColor="#C2410C" :size="32" />
            </button>
            Have you considered contracted staff augmentation? LaraJobs Consultants ➡️
            <div class="mx-3"></div>
          </div>

          <button
            class="flex items-center border border-gray-300 shadow-xl p-3.5 rounded-lg"
          >
            Filter
            <ArrowDownThin :size="27" class="-ml-1" />
          </button>
        </div>

        <div v-for="joblisting in joblistings" :key="joblisting">
          <JobItem :joblisting="joblisting" />
        </div>

        <div class="my-8">
          <h2 class="font-extrabold mb-5">Tags</h2>
          <div class="grid grid-cols-7 gap-4">
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">VueJS</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">PHP</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Fullstack</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">
              TailwindCSS
            </button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">JavaScript</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Angular</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Laravel</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Python</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Ruby</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Java</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">C#</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">C++</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Go</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Swift</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">PHP</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Rust</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">TypeScript</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Kotlin</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Perl</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Scala</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Haskell</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Lua</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Racket</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Shell</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Perl</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Scala</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Haskell</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">Lua</button>
            <button class="text-[14px] text-gray-700 p-2 bg-[#E5E7EB]">R</button>
          </div>
        </div>

        <div class="my-8">
          <div class="flex items-center justify-between">
            <h2 class="font-extrabold">Old Jobs</h2>
            <div class="text-gray-500">Note, these jobs may no longer be available</div>
          </div>

          <div v-for="joblisting in joblistings.slice(-3)" :key="joblisting">
            <JobItem :joblisting="joblisting" />
          </div>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import Magnify from "vue-material-design-icons/Magnify.vue";
import BullhornOutline from "vue-material-design-icons/BullhornOutline.vue";
import ArrowDownThin from "vue-material-design-icons/ArrowDownThin.vue";
import PartnersLogo from "@/Components/PartnersLogo.vue";
import JobItem from "@/Components/JobItem.vue";
defineProps({ joblistings: Object });
</script>

<style lang="scss" scoped></style>
