<template>
  <Head title="Search" />
  <DefaultLayout>
    <SearchJoblistings />
  </DefaultLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import SearchJoblistings from "@/Components/SearchJoblistings.vue";
</script>
