<template>
  <Head title="Thank You" />
  <DefaultLayout>
    <div class="w-full px-10">
      <div class="flex items-center justify-between mb-8 mt-4">
        <Link :href="route('home')" class="flex items-center tex-xs">
          <ChevronLeftIcon :size="24" fillColor="#000" />
          Back
        </Link>
      </div>
    </div>

    <div class="flex flex-col items-center justify-center">
      <div>
        <img src="/images/thank-you-check.svg" alt="" />
        <div class="flex justify-center">
          <div class="border-2 border-[#E91D4D] w-6/12 mt-5"></div>
        </div>
      </div>

      <h1 class="mt-8 text-[48px] font-bold">THANK YOU!</h1>
      <div class="text-[24px] font-bold mt-2">{{ message }}</div>
      <p class="text-[24px] font-light mt-2 mb-10">
        {{ appreciation }}
      </p>

      <Link
        :href="route('home')"
        type="submit"
        class="text-white bg-[#30BCED] w-2/12 text-[1rem] text-center py-2 mt-2 mb-4 border border-[#30BCED] rounded-md uppercase"
      >
        BACK TO CAREERS PAGE
      </Link>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import ChevronLeftIcon from "vue-material-design-icons/ChevronLeft.vue";

defineProps({
  message: {
    type: String,
    default: "Application sent",
  },
  appreciation: {
    type: String,
    default: "Thanks for applying! We appreciate your interest.",
  },
});
</script>

<style lang="scss" scoped></style>
