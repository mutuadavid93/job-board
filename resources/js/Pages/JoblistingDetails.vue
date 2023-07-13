<template>
  <Head :title="joblisting?.title" />
  <DefaultLayout>
    <div class="w-full px-10">
      <!-- <pre>{{ joblisting }}</pre> -->
      <div class="flex items-center justify-between mb-8 mt-4">
        <Link :href="route('home')" class="flex items-center tex-xs">
          <ChevronLeft :size="24" fillColor="#000" />
          Back
        </Link>
      </div>

      <div class="flex justify-between gap-5">
        <!-- start first column -->
        <div class="max-w-[calc(100%-316px)]">
          <div class="flex items-center justify-start gap-2">
            <div class="max-h-[89px]">
              <img
                :src="joblisting?.company_logo"
                class="rounded-full min-w-[89px] max-h-[89px]"
              />
            </div>
            <div class="">
              <h2 class="text-[24px] font-extrabold">{{ joblisting?.company_name }}</h2>
              <p class="text-[20px]">{{ joblisting?.title }}</p>
            </div>
          </div>

          <div class="mt-4">
            <h2>COMPANY OVERVIEW</h2>
            <hr />
            <div class="mt-2 text-[18px] font-light">
              <p>
                WPP emerged as the “world’s best holding company”, based on the combined
                points total of all agencies and networks within the different parent
                groups across the globe.
              </p>
              <p class="my-4">
                The ranking reflects the performance of campaigns and agencies in 79
                countries effectiveness and marketing excellence competitions across the
                world, all of which require entrants to show the business impact of their
                work.
              </p>
              <p class="my-4">
                WPP Scangroup Plc is in the business of building brands and transforming
                consumers through our various advertising and media brands such as
                Scanad/JWT, Ogilvy, Squad Digital, and GroupM. These brands do this
                through offering clients the highest-quality mix of multi-discipline
                marketing and diverse creative communications services. If you like
                ordinary, then we are not for you! We seek talent that has big picture
                thinking, craves integration and collaboration. We have been in existence
                for more than 33 years starting of as Scanad and mutating into the group
                of companies now known as WPP Scangroup Plc on the Nairobi Stock exchange
                and operating across various markets in Sub-Saharan Africa.
              </p>
              <p class="my-4">
                Our 600+ highly talented resources span Pan-Africa and work towards
                building collaborative partnerships within and outside our agency brands.
              </p>
              <p class="my-4">
                Our core services range from strategy and communication planning, creative
                development :&amp; design, digital integration for several of the world's
                biggest clients - among them; The Coca- Cola Company, Unilever, Diageo,
                ABSA Bank & Safaricom.
              </p>
            </div>

            <br />
            <h2>JOB PURPOSE – SUMMARY</h2>
            <hr />
            <div class="mt-2 text-[18px] font-light">
              <p>
                The Finance Controller is responsible for establishing reliable financial
                operations within the organization to ensure proper and effective
                financials controls and processes are in place.
              </p>
            </div>

            <br />
            <h2>KEY RESPONSIBILITIES & ACCOUNTABILITIES</h2>
            <hr />
            <ul class="list-disc ml-4 mt-2 text-[18px] font-light">
              <li class="py-2 text-[18px]">
                Preparing statutory consolidated reports for the Group
              </li>

              <li class="py-2 text-[18px]">
                Qualitative reviews of all accounts payables across the Group to ensure
                that balances are supported, and prompt action is taken as required to
                avoid having unsupported to aged balances.
              </li>

              <li class="py-2 text-[18px]">
                Ensure regular reconciliations of intercompany balances. Resolving
                disputes as they arise to ensure timely settlement of intercompany
                invoices or resolution of other intercompany balances.
              </li>

              <li class="py-2 text-[18px]">
                To ensure intercompany balances are reported in time as per guidelines
              </li>

              <li class="py-2 text-[18px]">
                WPP Scangroup is an equal opportunity employer.
              </li>

              <li class="py-2 text-[18px]">
                We are expected to be committed to equal employment opportunities and fair
                treatment of all employees.
              </li>

              <li class="py-2 text-[18px]">
                To actively advocate the implementation of best practices within the
                account payables and intercompany process.
              </li>

              <li class="py-2 text-[18px]">
                To train, coach and mentor direct reports to improve efficiency.
              </li>

              <li class="py-2 text-[18px]">
                Supervise direct reports to ensure the KPIs are met, and any poor
                performance escalated as required.
              </li>

              <li class="py-2 text-[18px]">
                Work with Finance Director to agree KPIs for the direct reports
              </li>

              <li class="py-2 text-[18px]">
                To review periodic reports and analysis and provide feedback to direct
                reports and finance director where required.
              </li>

              <li class="py-2 text-[18px]">
                To ensure implementation of effective controls around account payable and
                intercompany balances in consultation with Finance Director and Risk
                Assessment and Controls Director.
              </li>

              <li class="py-2 text-[18px]">
                To ensure audit findings around account payables and intercompany process
                are mitigated within agreed time frames.
              </li>

              <li class="py-2 text-[18px]">
                To supervise and support finance teams in relation to all finance process
                in other markets outside of Kenya where we have finance teams.
              </li>

              <li class="py-2 text-[18px]">
                To manage all finance process in the markets where we do not have any
                substantive finance / commercial lead.
              </li>

              <li class="py-2 text-[18px]">
                To ensure compliance with all relevant regulatory and statutory
                requirements for markets outside of Kenya.
              </li>

              <li class="py-2 text-[18px]">
                Ensure all financial reports and data are examined closely to check for
                discrepancies when consolidating reports for relevant management functions
              </li>

              <li class="py-2 text-[18px]">
                Support management in presenting reports to senior executives,
                stakeholders, and board members.
              </li>

              <li class="py-2 text-[18px]">
                Provide inputs for the development of relevant processes for benchmarking
                within the organization.
              </li>

              <li class="py-2 text-[18px]">
                Provide inputs on relevant polices, procedure, and processes.
              </li>

              <li class="py-2 text-[18px]">
                To ensure controls around vendor due diligence checks are as per
                guidelines
              </li>

              <li class="py-2 text-[18px]">
                Ensure that all financial reports of the organization are timely completed
                and comply with organization financial policies and standards.
              </li>

              <li class="py-2 text-[18px]">
                Perform any other duty as may be assigned by the Group Finance Director.
              </li>
            </ul>

            <br />
            <h2>PROFESSIONAL, TECHNICAL SKILLS AND PREVIOUS EXPERIENCE REQUIRED</h2>
            <hr />

            <div class="text-[18px] mt-4 font-light">
              <h4 class="font-semibold">Qualifications</h4>

              <ul class="list-disc ml-4 text-[16px]">
                <li class="pt-2">Bachelor’s Degree</li>
                <li class="pt-2">CPA or ACCA is preferred</li>
                <li class="pt-2">5+ years in a similar position</li>
                <li class="pt-2">Strong analytical and technical skills</li>
                <li class="pt-2">Project management</li>
                <li class="pt-2">Advanced excel knowledge is a MUST</li>
                <li class="pt-2">Strong communicator and presentation skills</li>
                <li class="pt-2">
                  Have demonstrated the ability to act decisively and resolve problems
                </li>
                <li class="pt-2">
                  Must possess excellent financial knowledge, analytical skills and be
                  very well organized
                </li>
              </ul>
            </div>

            <br />
            <h2>HOW TO APPLY</h2>
            <hr />
            <div class="text-[18px] font-light">
              <p class="mt-4">
                WPP Scangroup Plc believes in diversity, equity and inclusivity as a
                competitive advantage. We are committed to a fair hiring process. To
                minimise unconscious biases from our hiring process, we’ve taken on an
                initiative to the #RightTheCV.
              </p>
              <p class="my-2">
                We encourage candidates to apply
                <span class="font-bold text-[#30BCED]">here</span>
              </p>
              <p class="my-2 font-semibold">Closing date: August 23,2022</p>
              <p class="my-2 italic">
                Employee referrals is encouraged, kindly forward CVs of any suitable
                candidates. Nonetheless please note that
                <a href="mailto:istreetec@gmail.com" class="text-[#30BCED] underline"
                  >internal applications</a
                >
                will take precedence.
              </p>
            </div>
          </div>
        </div>
        <!-- end first column -->

        <div class="w-[316px] -mt-12">
          <button
            class="text-white bg-[#30BCED] w-full text-[1rem] text-center py-2 border border-[#30BCED] rounded-md"
          >
            APPLY NOW
          </button>

          <div class="w-full mt-4 bg-white shadow-xl p-4 rounded-md text-[14px]">
            <div class="my-2">
              <div class="text-[#949494]">COMPANY</div>
              <div class="font-semibold text-[16px]">{{ joblisting?.company_name }}</div>
            </div>
            <div class="my-2">
              <div class="text-[#949494]">ROLE</div>
              <div class="font-semibold text-[16px]">{{ joblisting?.title }}</div>
            </div>
            <div class="my-2">
              <div class="text-[#949494]">CONTRACT TERMS</div>
              <div class="font-semibold text-[16px]">
                {{ joblisting?.employment_type }}
              </div>
            </div>
            <div class="my-2">
              <div class="text-[#949494]">LOCATION</div>
              <div class="font-semibold text-[16px]">{{ joblisting?.location }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import ChevronLeft from "vue-material-design-icons/ChevronLeft.vue";

defineProps({
  joblisting: Object,
});
</script>
