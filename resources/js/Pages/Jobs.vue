<template>
  <Head title="Jobs" />
  <DefaultLayout>
    <div class="min-w-[1100px] pb-10">
      <div class="flex gap-8 px-10 mt-14">
        <div class="min-w-[calc(100%-450px)]">
          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>

          <form
            @submit.prevent="submitLoginForm"
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
          </form>

          <div class="flex items-center justify-between">
            <Link :href="route('password.request')" class="text-sm mb-4 text-blue-500">
              Forgot your password?
            </Link>

            <Link :href="route('register')" class="text-sm mb-4 text-gray-600">
              No account? We'll set one up below.
            </Link>
          </div>

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
                v-model:content="form.company_overview"
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
                  id="company_name"
                  v-model="form.company_name"
                  placeholder="Company name"
                  class="w-full placeholder:italic placeholder:text-xs"
                />
                <span
                  v-if="$page.props.errors.company_name"
                  class="text-red-700 block mt-2 text-[13px]"
                >
                  {{ $page.props.errors.company_name }}
                </span>
              </div>

              <div class="mt-5">
                <InputLabel value="COMPANY LOGO" class="mb-1.5" />
                <div
                  class="flex items-center justify-start gap-4 bg-[#F9FAFB] p-4 rounded-lg"
                >
                  <img
                    v-if="!!imageDisplay"
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
                    v-if="$page.props.errors.company_logo"
                    class="text-red-700 block mt-2 text-[13px]"
                  >
                    {{ $page.props.errors.company_logo }}
                  </span>
                </div>
                <span class="text-[13px] text-[#6B7280]"
                  >130x130 is best, but any works</span
                >
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

        <div class="w-[450px]">
          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">The official Laravel job board </span>
            <span class="block">since 2014. Trusted by </span>
            <span class="block"> thousands of companies.</span>
          </div>

          <div class="flex items-center justify-center mt-6">
            <img src="/images/adobe.svg" class="min-w-[25px] max-h-[25px] mx-4" />
            <img src="/images/ge.svg" class="min-w-[25px] max-h-[35px] mx-4" />
          </div>
          <div class="flex items-center justify-center mt-6">
            <img src="/images/hellofresh.svg" class="min-w-[25px] max-h-[25px] mx-4" />
            <img src="/images/wto.svg" class="min-w-[25px] max-h-[25px] mx-4" />
          </div>
          <div class="flex items-center justify-center mt-6">
            <img src="/images/usbank.svg" class="min-w-[25px] max-h-[25px] mx-4" />
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">Exclusively syndicated across </span>
            <span class="block"
              >the <a href="#" class="text-[#3B82F6]">Laravel News</a></span
            >
            <span class="block"> website/newsletter to millions</span>
            <span class="block">of readers</span>
          </div>

          <div class="flex items-center justify-center">
            <svg
              class="block mx-auto rounded-sm w-1/3 mt-4"
              version="1.1"
              id="Layer_1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              x="0px"
              y="0px"
              viewBox="0 0 183 174"
              style="enable-background: new 0 0 183 174"
              xml:space="preserve"
              fill="#f4645f"
            >
              <g>
                <path
                  class="st0"
                  d="M183-4H0c0,0,0,0,0,0v173.2c0,2.6,2.1,4.8,4.8,4.8h173.5c2.6,0,4.7-2.1,4.7-4.7L183-4C183-4,183-4,183-4z M87.9,129.1C87.9,129.2,87.9,129.2,87.9,129.1c0,1-0.8,1.8-1.8,1.8H48.2h0c0,0,0,0,0,0c-2.5,0-4.5-2-4.5-4.5V44.9c0,0,0-0.1,0-0.1 c0-1,0.8-1.7,1.8-1.7h6.8c0,0,0.1,0,0.1,0c1,0,1.7,0.8,1.7,1.8v76.3h32c0,0,0.1,0,0.1,0c1,0,1.7,0.8,1.7,1.8V129.1z M141,128.3  c0,0,0,0.1,0,0.1c0,1.4-1.2,2.6-2.7,2.5h-7.6c-0.7,0-1.3-0.1-1.9-0.4c-0.6-0.3-1.1-0.8-1.4-1.3L87.5,59.5v48.8c0,0,0,0.1,0,0.1 c0,1-0.8,1.7-1.8,1.7h-6.3c0,0-0.1,0-0.1,0c-1,0-1.7-0.8-1.7-1.8V45.7c0,0,0-0.1,0-0.1c0-1.4,1.2-2.6,2.7-2.5h7.5 c0.7,0,1.3,0.1,1.9,0.4c0.6,0.3,1.1,0.8,1.4,1.3l40,69.7V44.9c0,0,0-0.1,0-0.1c0-1,0.8-1.7,1.8-1.7h6.3c0,0,0.1,0,0.1,0 c1,0,1.7,0.8,1.7,1.8V128.3z"
                ></path>
              </g>
            </svg>
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">Emailed to 40,000+ Laravel</span>
            <span class="block"> developers</span>
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="text-[#4B5563] text-center text-[1.2rem]">
            <span class="block">From $299</span>
            <span class="block"> for 30 days</span>
          </div>

          <div class="my-8 border-2 border-[#D1D5DB] w-full"></div>

          <div class="flex flex-col">
            <div class="flex items-center justify-center">
              <img
                src="/images/matt2.jpg"
                class="rounded-full min-w-[160px] max-h-[160px]"
              />
            </div>

            <div class="mt-4 text-[1.25rem] font-extralight">
              "Listing our jobs through <br />LaraJobs was simple, quick,<br />
              and helped us find amazing<br />
              candidates.
            </div>

            <div class="mt-4 text-[1.25rem] font-extralight ]">
              <span class="bg-[#FEF08A]">We've now hired numerous</span>
              <span class="bg-[#FEF08A] block">times through LaraJobs and</span>
              <span class="bg-[#FEF08A] inline-block"
                >we'll absolutely use it again!"</span
              >
            </div>

            <div class="text-center mt-4">
              <a href="#" class="underline text-[#609AF8]">Matt Stauffer</a>
              <span>, Tighten Co.</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Live Preview -->
    <div class="fixed bottom-0 pl-10 z-20 min-w-[63.888%]">
      <!-- <div class="-mb-4 font-bold">Live Preview</div> -->
      <div>
        <JobItemPreview
          :image="imageDisplay ? imageDisplay : '/images/nologo.svg'"
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
    company_name: "",
    // description: "",
    experience_level: "Senior Level",
    employment_type: "Full Time",
    company_logo: null,
    salary: "0",
    logo_present: 0,
    list_highlighted: 0,
    tobe_reposted: false, // whether joblisting should be recurring
    listing_boosted: 0,
    enhancements: [],
    custom_color: "#EE3696",
    custom_color_price: 0,
    custom_text_color: "#FFFFFF",

    company_overview: "",
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
      errors && errors.company_logo ? (error.value = errors.company_logo) : "";
    },
  });
};

const getUploadedImage = (event) => {
  // convert the file into an object url
  imageDisplay.value = URL.createObjectURL(event.target.files[0]);
  form.company_logo = event.target.files[0];
};
</script>

<style>
.ql-editor {
  min-height: 5rem !important;
}
.ql-toolbar {
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
}
</style>
