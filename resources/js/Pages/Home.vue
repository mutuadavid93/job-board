<template>
  <Head title="Home" />

  <DefaultLayout>
    <div class="w-full pb-10 pt-[56px]">
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

          <div class="flex items-center justify-center mt-6">
            <img src="/images/adobe.svg" class="min-w-[25px] max-h-[25px] mx-4" />
            <img src="/images/ge.svg" class="min-w-[25px] max-h-[35px] mx-4" />
            <img src="/images/hellofresh.svg" class="min-w-[25px] max-h-[25px] mx-4" />
            <img src="/images/wto.svg" class="min-w-[25px] max-h-[25px] mx-4" />
            <img src="/images/usbank.svg" class="min-w-[25px] max-h-[25px] mx-4" />
          </div>
        </div>

        <img src="/images/hero-banner.png" class="w-full object-cover" />
      </div>

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
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import Magnify from "vue-material-design-icons/Magnify.vue";
</script>

<style lang="scss" scoped></style>
