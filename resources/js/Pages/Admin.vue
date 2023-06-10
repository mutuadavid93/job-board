<template>
  <div v-if="hasRole('admin')">Welcome Admin</div>
  <div v-else>We noticed you are not an admin</div>
</template>

<script setup>
import usePermission from "@/Composables/permissions";
const { hasRole } = usePermission();
</script>
