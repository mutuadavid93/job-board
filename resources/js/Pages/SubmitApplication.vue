<template>
  <Head title="Jobs" />
  <DefaultLayout>
    <div class="w-full px-10">
      <div class="flex items-center justify-between mb-8 mt-4">
        <Link :href="route('home')" class="flex items-center tex-xs">
          <ChevronLeftIcon :size="24" fillColor="#000" />
          Back
        </Link>
      </div>

      <div class="w-full">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-2">
            <div class="max-h-[89px]">
              <img
                src="/images/career-logo.jpg"
                class="rounded-full min-w-[89px] max-h-[89px]"
              />
            </div>
            <div class="">
              <h2 class="text-[24px] font-extrabold">WPP - Scangroup</h2>
              <p class="text-[20px]">Finance Controller</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-24 pl-10 mt-4">
      <div class="text-font text-[24px]">SUBMIT YOUR APPLICATION</div>

      <form action="" @submit.prevent="submit" class="grid grid-cols-2 gap-4 mt-2">
        <div class="mb-2">
          <InputLabel value="Full Name" class="mb-1.5" for="job-title" required />
          <TextInput
            class="w-full placeholder:text-xs bg-white"
            type="text"
            id="job-title"
            v-model="form.title"
            placeholder="Enter full name"
          />
          <InputError
            class="lowercase"
            v-if="$page.props.errors.title"
            :message="$page.props.errors.title"
          />
        </div>
        <div class="mb-2">
          <InputLabel value="Email" class="mb-1.5" for="email" required />
          <TextInput
            class="w-full placeholder:text-xs bg-white"
            type="text"
            id="email"
            v-model="form.email"
            placeholder="Enter your email address"
          />
          <InputError
            class="lowercase"
            v-if="$page.props.errors.email"
            :message="$page.props.errors.email"
          />
        </div>
        <div class="mb-2">
          <InputLabel value="Phone" class="mb-1.5" for="phone" required />
          <TextInput
            class="w-full placeholder:text-xs bg-white"
            type="tel"
            id="phone"
            v-model="form.phone"
            placeholder="e.g. 712 123456"
          />
          <InputError
            class="lowercase"
            v-if="$page.props.errors.phone"
            :message="$page.props.errors.phone"
          />
        </div>
        <div class="mb-2">
          <InputLabel value="Portfolio URL (link)" class="mb-1.5" for="portfolio_link" />
          <TextInput
            class="w-full placeholder:text-xs bg-white"
            type="tel"
            id="portfolio_link"
            v-model="form.phone"
            placeholder="Enter a link for your work"
          />
          <InputError
            class="lowercase"
            v-if="$page.props.errors.phone"
            :message="$page.props.errors.phone"
          />
        </div>
        <div class="mb-2">
          <InputLabel value="Attach your CV" class="mb-1.5" />
          <label
            for="attach_cv"
            class="flex items-center justify-center gap-2 mt-2 py-2 border border-[#1B164A] rounded-md w-full uppercase text-[16px] text-center cursor-pointer"
          >
            <div class="transform rotate-45 text-red-500">
              <AttachmentIcon />
            </div>
            upload your cv
          </label>
          <input
            type="file"
            name="attach_cv"
            id="attach_cv"
            class="hidden"
            @change="getUploadedFile"
          />
          <InputError
            class="lowercase"
            v-if="$page.props.errors.attached_cv"
            :message="$page.props.errors.attached_cv"
          />
        </div>
        <div class="mb-2">
          <InputLabel value="reCaptcha" class="mb-1.5" for="captcha" required />
          <div
            class="flex items-center justify-between border border-gray-500 rounded-md"
          >
            <div class="flex items-center justify-center w-full">
              <button
                @click.prevent="fetchCaptcha"
                class="bg-[#DBD6D7] border-r border-r-gray-400 rounded-l-md px-2 py-3 mr-0.5"
              >
                <ReloadIcon :size="17" />
              </button>
              <img :src="imageSrc" alt="" />
              <TextInput
                class="w-full placeholder:text-xs bg-white rounded-none rounded-r-md border-none ring-0 focus:ring-0"
                type="tel"
                id="captcha"
                v-model="form.captcha"
                placeholder="Enter captcha"
              />
            </div>
          </div>
          <InputError
            class="lowercase"
            v-if="$page.props.errors.captcha"
            :message="$page.props.errors.captcha"
          />
        </div>

        <button
          type="submit"
          class="text-white bg-[#30BCED] w-full text-[1rem] text-center py-2 mt-2 border border-[#30BCED] rounded-md uppercase"
        >
          submit
        </button>
      </form>
    </div>
  </DefaultLayout>
</template>

<script setup>
import axios from "axios";
import { ref, computed } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import ChevronLeftIcon from "vue-material-design-icons/ChevronLeft.vue";
import AttachmentIcon from "vue-material-design-icons/Attachment.vue";
import ReloadIcon from "vue-material-design-icons/Reload.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const { captcha_img } = defineProps({ captcha_img: String });

const image = ref(captcha_img);

const imageSrc = computed(() => {
  return image.value.split('"')[1] || "";
});

const form = useForm({
  title: "",
  email: "",
  phone: "",
  captcha: "",
  attached_cv: null,
});

const submit = () => {
  form.post(route("joblistings.submit"), {
    preserveScroll: true,
    data: form.value,
    onSuccess: () => {
      // Handle success
    },
    onError: () => {
      // Handle error
    },
  });
};

const getUploadedFile = (event) => {
  form.attached_cv = event.target.files[0];
};

async function fetchCaptcha() {
  const response = await axios.get("/reload-captcha");
  image.value = response.data.captcha_img;
}
</script>

<style lang="css" scoped></style>
