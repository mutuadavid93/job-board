<template>
  <Link
    :style="{
      backgroundColor: jobColor?.color,
      color: jobColor?.text_color,
      borderColor: 'white',
      cursor: 'pointer',
    }"
    :href="route('jobs.show', { joblisting: joblisting })"
    @click="store.isOpen = false"
    class="flex items-center justify-between mt-8 border border-gray-300 hover:border-gray-500 shadow-md rounded-lg p-3 py-5 w-full"
  >
    <div class="flex items-center justify-start">
      <div class="relative">
        <button
          type="button"
          class="flex flex-col items-center justify-center absolute -top-8 -left-6 z-10 bg-white rounded-full p-3 border border-gray-400 shadow-xl -ml-5"
        >
          <img
            :src="joblisting.company?.logo ?? '/images/nologo.jpg'"
            class="min-w-[35px] max-h-[35px]"
          />
        </button>
      </div>
      <div class="ml-8">
        <div class="font-extralight text-[15px]">{{ joblisting.company?.name }}</div>
        <div class="font-extrabold text-md">{{ joblisting?.title }}</div>
        <div class="font-extralight text-[15px]">{{ joblisting?.employment_type }}</div>
      </div>
    </div>

    <div>
      <div class="flex items-center justify-end mr-2">
        <Web fillColor="#C1C5CD" :size="23" class="mr-2" />
        <span class="text-[13px] mr-2">{{ joblisting?.location }}</span>
        <CalendarBlankOutline fillColor="#C1C5CD" :size="23" class="mx-2" />
        <AppDate :timestamp="joblisting?.created_at" />
      </div>
      <div class="flex items-center justify-start mt-2">
        <button class="px-3 py-1 text-[13px] border border-gray-300 rounded-md mr-2">
          Fullstack
        </button>
        <button class="px-3 py-1 text-[13px] border border-gray-300 rounded-md mr-2">
          Laravel
        </button>
        <button class="px-3 py-1 text-[13px] border border-gray-300 rounded-md mr-2">
          PHP
        </button>
        <button class="px-3 py-1 text-[13px] border border-gray-300 rounded-md mr-2">
          TailwindCSS
        </button>
        <button class="px-3 py-1 text-[13px] border border-gray-300 rounded-md mr-2">
          VueJS
        </button>
      </div>
    </div>
  </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import Web from "vue-material-design-icons/Web.vue";
import CalendarBlankOutline from "vue-material-design-icons/CalendarBlankOutline.vue";
import AppDate from "@/Components/AppDate.vue";
import { store } from "@/store";

const { joblisting } = defineProps({ joblisting: Object });

const jobColor = computed(() => {
  const hasEnhancements = joblisting.hasOwnProperty("enhancements");
  if (hasEnhancements) {
    return joblisting.enhancements.find((enhancement) => enhancement.color);
  }

  return {
    color: "#FFFFFF",
    text_color: "#000000",
  };
});
</script>

<style lang="scss" scoped></style>
