<template>
  <div class="relative">
    <header
      id="Header"
      class="w-[calc(100%-300px)] h-[56px] absolute right-0 top-0 flex items-center justify-end mx-5"
    >
      <div class="max-h-[40px]">
        <img
          v-if="$page.props.auth.user"
          :src="$page.props.auth.user.profile_picture"
          class="min-w-[40px] max-h-[40px] rounded-full cursor-pointer"
        />
      </div>
    </header>

    <div
      id="MainContent"
      class="w-[calc(100%-300px)] h-[calc(100%-56px)] absolute right-0 top-[56px] p-6"
    >
      <slot />
    </div>

    <div
      id="SideNav"
      class="w-[300px] h-screen shadow-2xl border-r border-r-[#EBEBEB] bg-white"
    >
      <div class="max-w-[13rem] pt-3 px-5">
        <img src="/images/logo.svg" class="min-w-[60px]" />
      </div>
      <div class="border-b border-b-[#EBEBEB] my-4"></div>
      <button
        class="flex items-center justify-start gap-4 mx-2 w-[calc(100%-17px)] rounded-lg hover:bg-gray-300"
      >
        <HomeOutline :size="35" class="py-2 pl-0.5" />
        Dashboard
      </button>
      <div class="border-b border-b-[#EBEBEB] my-4"></div>
      <button
        class="flex items-center justify-start gap-4 mx-2 my-3 w-[calc(100%-17px)] rounded-lg hover:bg-gray-300"
      >
        <BriefcaseOutline :size="35" class="py-2 pl-0.5" />
        Jobs
      </button>
      <button
        :class="{ active: currentPage }"
        class="flex items-center justify-start gap-4 mx-2 my-3 w-[calc(100%-17px)] rounded-lg hover:bg-gray-300"
      >
        <AccountGroupOutline :size="35" class="py-2 pl-0.5" />
        Roles
      </button>
      <button
        class="flex items-center justify-start gap-4 mx-2 my-3 w-[calc(100%-17px)] rounded-lg hover:bg-gray-300"
      >
        <OfficeBuilding :size="35" class="py-2 pl-0.5" />
        Companies
      </button>
    </div>
  </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import HomeOutline from "vue-material-design-icons/HomeOutline.vue";
import BriefcaseOutline from "vue-material-design-icons/BriefcaseOutline.vue";
import AccountGroupOutline from "vue-material-design-icons/AccountGroupOutline.vue";
import OfficeBuilding from "vue-material-design-icons/OfficeBuilding.vue";

let currentPage = ref("");

onMounted(() => {
  if (usePage().url == "/admin") {
    currentPage.value = true;
  }
});
</script>

<style scoped>
.active {
  color: #ffffff;
  background-color: #30bced;
}
</style>
