<template>
  <Head title="Jobs" />
  <DefaultLayout>
    <div class="min-w-[1100px] pb-10">
      <div class="flex gap-8 px-10 mt-14">
        <div class="min-w-[calc(100%-450px)]">
          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>

          <form @submit.prevent="submitLoginForm" v-if="!$page.props.auth.user">
            <div
              class="flex items-center justify-between p-4 bg-[#F3F4F6] rounded-lg mb-2"
            >
              <div>
                <TextInput
                  id="login-email"
                  type="email"
                  class="mt-1 w-full rounded-none"
                  v-model="loginForm.email"
                  required
                  placeholder="Email"
                  autocomplete="off"
                />

                <InputError class="mt-2" :message="loginForm.errors.email" />
              </div>

              <div>
                <TextInput
                  id="login-password"
                  type="password"
                  class="mt-1 w-full rounded-none"
                  v-model="loginForm.password"
                  required
                  placeholder="Password"
                  autocomplete="off"
                />

                <InputError class="mt-2" :message="loginForm.errors.password" />
              </div>

              <div>
                <PrimaryButton
                  class="ml-4 py-3 bg-red-600 text-white rounded-none hover:bg-white hover:text-blue-500"
                  :class="{ 'opacity-25': loginForm.processing }"
                  :disabled="loginForm.processing"
                >
                  Log in
                </PrimaryButton>
              </div>
            </div>

            <div class="flex items-center justify-between">
              <Link :href="route('password.request')" class="text-sm mb-4 text-blue-500">
                Forgot your password?
              </Link>

              <Link :href="route('register')" class="text-sm mb-4 text-gray-600">
                No account? We'll set one up below.
              </Link>
            </div>
          </form>

          <form action="#" @submit.prevent="submit">
            <div>
              <InputLabel value="JOB TITLE" class="mb-1.5" />
              <TextInput
                class="w-full placeholder:italic placeholder:text-xs"
                type="text"
                id="job-title"
                v-model="form.title"
                placeholder="Job title"
              />
              <span class="text-[13px] text-[#6B7280]"
                >Example: "Senior Laravel Developer", "Software Engineer"</span
              >
              <span
                v-if="$page.props.errors.title"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.title }}
              </span>
            </div>

            <div class="mt-5">
              <InputLabel value="EXPERIENCE LEVEL" class="mb-1.5" />
              <select
                id="experience_level"
                class="w-full border border-gray-400 bg-[#F9FAFB] rounded-lg mb-4"
                v-model="form.experience_level"
              >
                <option value="Senior Level" class="text-[14px]">Senior Level</option>
                <option value="Mid Level" class="text-[14px]">Mid Level</option>
                <option value="Entry Level" class="text-[14px]">Entry Level</option>
                <option value="Internship" class="text-[14px]">Internship</option>
              </select>
            </div>

            <div class="mb-6">
              <InputLabel value="COMPANY OVERVIEW" class="mb-1.5" />
              <QuillEditor
                v-model:content="form.overview"
                contentType="html"
                toolbar="essential"
                placeholder="Introduction of your company"
              />
            </div>

            <div class="mb-6">
              <InputLabel value="JOB PURPOSE – SUMMARY" class="mb-1.5" />
              <QuillEditor
                v-model:content="form.job_purpose"
                contentType="html"
                toolbar="essential"
                placeholder="Job purpose i.e. summary"
              />
              <span
                v-if="$page.props.errors.job_purpose"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.job_purpose }}
              </span>
            </div>

            <div class="mb-6">
              <InputLabel
                value="KEY RESPONSIBILITIES &amp; ACCOUNTABILITIES"
                class="mb-1.5"
              />
              <QuillEditor
                v-model:content="form.responsibilities"
                toolbar="essential"
                contentType="html"
                placeholder="Key responsibilities &amp; accountabilities. Kindly use bullet points"
              />
              <span
                v-if="$page.props.errors.responsibilities"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.responsibilities }}
              </span>
            </div>

            <div class="mb-4">
              <InputLabel
                value="PROFESSIONAL, TECHNICAL SKILLS AND PREVIOUS EXPERIENCE REQUIRED"
                class="mb-1.5"
              />
              <QuillEditor
                v-model:content="form.professional_skills"
                contentType="html"
                toolbar="essential"
                placeholder="Professional, technical skills and previous experience required"
              />
              <span
                v-if="$page.props.errors.professional_skills"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.professional_skills }}
              </span>
            </div>

            <div class="mt-5">
              <InputLabel value="JOB LOCATION" class="mb-1.5" />
              <TextInput
                id="job-location"
                type="text"
                v-model="form.location"
                placeholder="Job location"
                class="w-full placeholder:italic placeholder:text-xs"
              />
              <span class="text-[13px] text-[#6B7280]"
                >Example: "Remote", "Remote / USA", "New York City", "Remote GMT-5", etc.
              </span>
              <span
                v-if="$page.props.errors.location"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.location }}
              </span>
            </div>

            <div class="mt-5">
              <InputLabel value="EMPLOYMENT TYPE" class="mb-1.5" />
              <select
                id="employment-type"
                class="w-full border border-gray-400 bg-[#F9FAFB] rounded-md"
                v-model="form.employment_type"
              >
                <option value="Full Time" class="text-[14px]">Full Time</option>
                <option value="Part Time" class="text-[14px]">Part Time</option>
                <option value="Contractor" class="text-[14px]">Contractor</option>
                <option value="Temporary" class="text-[14px]">Temporary</option>
                <option value="Intern" class="text-[14px]">Intern</option>
                <option value="Volunteer" class="text-[14px]">Volunteer</option>
                <option value="Per Diem" class="text-[14px]">Per Diem</option>
                <option value="Other" class="text-[14px]">Other</option>
              </select>
              <span
                v-if="$page.props.errors.employment_type"
                class="text-red-700 block mt-2 text-[13px]"
              >
                {{ $page.props.errors.employment_type }}
              </span>

              <div class="mt-5">
                <InputLabel value="SALARY(optional)" class="mb-1.5" />
                <TextInput
                  type="number"
                  id="salary"
                  v-model="form.salary"
                  class="w-full"
                />
                <span class="text-[13px] text-[#6B7280]"
                  >Examples: "$120,000 – $145,000 USD", "€80,000 — €102,000"
                </span>
                <span
                  v-if="$page.props.errors.salary"
                  class="text-red-700 block mt-2 text-[13px]"
                >
                  {{ $page.props.errors.salary }}
                </span>
              </div>

              <div class="mt-5">
                <InputLabel value="COMPANY NAME" class="mb-1.5" />
                <TextInput
                  type="text"
                  id="name"
                  v-model="form.name"
                  placeholder="Company name"
                  class="w-full placeholder:italic placeholder:text-xs"
                />
                <span
                  v-if="$page.props.errors.name"
                  class="text-red-700 block mt-2 text-[13px]"
                >
                  {{ $page.props.errors.name }}
                </span>
              </div>

              <div class="mt-5">
                <InputLabel value="COMPANY LOGO" class="mb-1.5" />
                <div
                  class="flex items-center justify-start gap-4 bg-[#F9FAFB] p-4 rounded-lg"
                >
                  <img
                    v-if="imageDisplay"
                    :src="imageDisplay"
                    class="min-w-[50px] max-h-[50px] rounded-full"
                  />
                  <OfficeBuildingOutline v-else fillColor="#AAAAAC" :size="50" />
                  <label
                    for="select-file"
                    class="text-[#6B7280] text-sm font-extrabold p-2 rounded-xl border border-[#D1D5DB]"
                    >Select File
                  </label>
                  <input
                    @input="getUploadedImage($event)"
                    class="hidden"
                    type="file"
                    id="select-file"
                  />
                  <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                  >
                    {{ form.progress.percentage }}%
                  </progress>
                  <span
                    v-if="$page.props.errors.logo"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.logo }}
                  </span>
                </div>
                <span class="text-[13px] text-[#6B7280]"
                  >130x130 is best, but any works</span
                >
              </div>

              <div class="mt-5">
                <InputLabel value="COMPANY EMAIL" class="mb-1.5" />
                <TextInput
                  type="email"
                  id="email"
                  v-model="form.email"
                  placeholder="Company email"
                  class="w-full placeholder:italic placeholder:text-xs"
                />
                <span
                  v-if="$page.props.errors.email"
                  class="text-red-700 block mt-2 text-[13px]"
                >
                  {{ $page.props.errors.email }}
                </span>
              </div>

              <div class="mt-5 rounded-lg border-2 border-[#D1D5DB] px-4 py-4">
                <div class="text-center text-[16px] font-bold">
                  Enhance Your Listing. Get More Leads.
                </div>
                <div class="mt-4">
                  <div class="flex items-center justify-start gap-2">
                    <input
                      type="checkbox"
                      id="company-logo"
                      :true-value="49"
                      :false-value="0"
                      v-model="form.logo_present"
                    />

                    <label for="company-logo"
                      >Show your company logo in the listing (+$49)</label
                    >
                  </div>
                  <span
                    v-if="$page.props.errors.logo_present"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.logo_present }}
                  </span>
                </div>
                <div class="mt-4">
                  <div class="flex items-center justify-start gap-2">
                    <input
                      type="checkbox"
                      id="custom-color"
                      :true-value="49"
                      :false-value="0"
                      v-model="form.custom_color_price"
                    />
                    <label for="custom-color" class="block"
                      >Highlight your listing in a custom color (+$49)</label
                    >
                  </div>
                  <div class="flex items-center justify-start gap-2">
                    <strong>background colour: </strong>
                    <input type="color" v-model="form.custom_color" />
                    <strong>text colour: </strong>
                    <input type="color" v-model="form.custom_text_color" />
                  </div>
                  <span
                    v-if="$page.props.errors.logo_present"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.logo_present }}
                  </span>
                </div>
                <div class="mt-4">
                  <div class="flex items-center justify-start gap-2">
                    <input
                      type="checkbox"
                      id="highlight-listing"
                      v-model="form.list_highlighted"
                      :true-value="399"
                      :false-value="0"
                    />
                    <label for="highlight-listing"
                      >Boost your listing to the top of the page every 7 days
                      (+$399)</label
                    >
                  </div>
                  <span
                    v-if="$page.props.errors.list_highlighted"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.list_highlighted }}
                  </span>
                </div>
                <div class="mt-4">
                  <div class="flex items-center justify-start gap-2">
                    <input
                      type="checkbox"
                      id="boost-listing"
                      v-model="form.listing_boosted"
                      :true-value="1499"
                      :false-value="0"
                    />
                    <label for="boost-listing"
                      >Boost your listing to the top of the page every day to maximize
                      exposure (+$1499)</label
                    >
                  </div>
                  <span
                    v-if="$page.props.errors.listing_boosted"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.listing_boosted }}
                  </span>
                </div>
                <div class="flex items-center justify-start gap-2 mt-4">
                  <input
                    type="checkbox"
                    id="repost"
                    v-model="form.tobe_reposted"
                    :true-value="true"
                    :false-value="false"
                  />
                  <label for="repost">Repost automatically when listing expires</label>
                  <span
                    v-if="$page.props.errors.tobe_reposted"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.tobe_reposted }}
                  </span>
                </div>
              </div>

              <div
                class="mt-5 flex items-center justify-between px-4 py-5 bg-[#E5E7EB] rounded-lg"
              >
                <div class="font-extrabold">Price</div>
                <div class="font-extrabold text-[#24C560]">${{ total }}</div>
              </div>

              <div class="flex items-center justify-center">
                <button
                  type="submit"
                  :disabled="form.processing"
                  class="rounded-lg p-2 px-4 text-white bg-blue-600 hover:bg-[#374151] my-5"
                >
                  Checkout
                </button>
              </div>
            </div>
          </form>
        </div>

        <SideNav />
      </div>
    </div>

    <!-- Live Preview -->
    <div class="fixed bottom-0 pl-10 z-20 min-w-[63.888%]">
      <!-- <div class="-mb-4 font-bold">Live Preview</div> -->
      <div>
        <JobItemPreview
          :image="imageDisplay ? imageDisplay : '/images/nologo.jpg'"
          :color="form.custom_color"
          :textColor="form.custom_text_color"
        />
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref, reactive, watch, computed } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import OfficeBuildingOutline from "vue-material-design-icons/OfficeBuildingOutline.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SideNav from "@/Components/SideNav.vue";
import JobItemPreview from "@/Components/JobItemPreview.vue";
import InputLabel from "@/Components/InputLabel.vue";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
  tinymce: String,
});

const loginForm = useForm({
  email: "",
  password: "",
  remember: false,
});

const submitLoginForm = () => {
  loginForm.post(route("login"), {
    onFinish: () => loginForm.reset("password"),
  });
};

let imageDisplay = ref("");
let error = ref(null);
let enhancements = reactive([]);

const removeEnhancement = (_type) => {
  enhancements.forEach((enhancement, index) => {
    if (enhancement.type === _type) {
      enhancements.splice(index, 1);
    }
  });
};

const form = useForm(() => {
  return {
    title: "",
    total: 0,
    location: "",

    // Company matadata
    name: "",
    logo: null,
    overview: "",
    email: "",

    experience_level: "Senior Level",
    employment_type: "Full Time",
    salary: "0",
    logo_present: 0,
    list_highlighted: 0,
    tobe_reposted: false, // whether joblisting should be recurring
    listing_boosted: 0,
    enhancements: [],
    custom_color: "#EE3696",
    custom_color_price: 0,
    custom_text_color: "#FFFFFF",

    job_purpose: "",
    professional_skills: "",
    responsibilities: "",
  };
});

let currentDate = new Date();
currentDate.setDate(currentDate.getDate() + 7);

let year = currentDate.getFullYear();
let month = String(currentDate.getMonth() + 1).padStart(2, "0");
let day = String(currentDate.getDate()).padStart(2, "0");
let hours = String(currentDate.getHours()).padStart(2, "0");
let minutes = String(currentDate.getMinutes()).padStart(2, "0");
let seconds = String(currentDate.getSeconds()).padStart(2, "0");

let formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

/*
|--------------------------------------------------------------------------
|  Watch individual enhancements
|--------------------------------------------------------------------------
| Push each into enhancements collection
|
*/
watch(
  () => form.logo_present,
  (logoPrice) => {
    // If present remove it
    removeEnhancement("Company logo");
    enhancements.push({ type: "Company logo", price: logoPrice });
  }
);
watch(
  () => form.list_highlighted,
  (price) => {
    removeEnhancement("Boost every 7 days");
    enhancements.push({ type: "Boost every 7 days", price });
  }
);
watch(
  () => form.listing_boosted,
  (price) => {
    removeEnhancement("Boost every day");
    enhancements.push({ type: "Boost every day", price });
  }
);
watch(
  () => form.tobe_reposted,
  (value) => {
    removeEnhancement("Recurring");
    enhancements.push({
      type: "Recurring",
      recurring: value,
      // Default price
      price: 0,
      expiration_date: formattedDate,
    });
  }
);

// Watch multiple states
watch(
  [() => form.custom_text_color, () => form.custom_color, () => form.custom_color_price],
  ([text_color, color, price]) => {
    // Perform any desired logic based on the color and price changes
    removeEnhancement("Custom color");
    if (price) {
      enhancements.push({
        type: "Custom color",
        price,
        color,
        text_color,
      });
    }
  }
);

// Grandsum
const total = computed(() => {
  const sum = enhancements.reduce((accu, enhancement) => {
    return accu + enhancement.price;
  }, 0);
  return sum > 0 ? sum.toFixed(2) : 0;
});

// NOTE: This total is what stripe supports
const totalWithoutDot = () => {
  let num = String(total.value).split(".").join("");
  return Number(num);
};

// HINT: Useful if you want a review of the colours on the fly.
// The customer can see how the actual job listing will look like and adjust accordingly
/*const enhancedColor = */
computed({
  get() {
    if (form.custom_color_price) {
      return {
        color: form.custom_color,
        price: form.custom_color_price,
      };
    } else {
      return null;
    }
  },
  set(value) {
    // When checked
    if (value) {
      form.custom_color = value.color;
      form.custom_color_price = value.price;
    } else {
      form.custom_color = "#EE3696"; // Set default color when unchecked
      form.custom_color_price = 0;
    }
  },
});

const submit = () => {
  form.enhancements = enhancements;
  form.total = totalWithoutDot();
  form.post(route("jobs.store"), {
    forceFormData: true,
    // preserveState: true, // Preserve form input values
    preserveScroll: true, // Preserve scroll position
    onFinish: () => {
      // Reset the form fields back to defaults
      form.reset();

      // Clear all errors...
      form.clearErrors();
    },
    onError: (errors) => {
      errors && errors.logo ? (error.value = errors.logo) : "";
    },
  });
};

const getUploadedImage = (event) => {
  // convert the file into an object url
  imageDisplay.value = URL.createObjectURL(event.target.files[0]);
  form.logo = event.target.files[0];
};
</script>

<style>
.ql-editor {
  min-height: 5rem !important;
  background-color: white;
}
.ql-toolbar {
  background-color: white;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
}
</style>
