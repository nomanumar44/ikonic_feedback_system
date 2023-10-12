<template>
    <!-- Begin Page Content -->
    <loader v-if="loading" class="loading-box"></loader>
    <header class="py-4">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-theme-5"></h1>
                <router-link
                    :to="{name:'user.dashboard'}"
                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"

                >
                    <i class="fas fa-plus fa-sm text-white-50"></i> Add Feedback
                </router-link>
            </div>
        </div>
    </header>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fab fa-telegram-plane"></i>Feedbacks List
                    </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="listcustomerdatatable">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table
                                                :class="loading == true ? 'animate-pulse' : ''"
                                                class="table table-hover table-bordered"
                                                id="listTable"
                                            >
                                                <thead class="bg-white z-50 sticky top-[43px] overflow-scroll">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Vote Count</th>
                                                    <th v-if="userRole == 'Admin'">Actions</th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                <tr v-if="feedbacks == 0 || feedbacks == null">
                                                    <td colspan="4" class="text-center justify-between">
                                                        No Result Found.
                                                    </td>
                                                </tr>
                                                <tr
                                                    v-for="(feedback,index) in feedbacks"
                                                    v-bind:key="index">
                                                    <td>{{ feedback?.id }}</td>
                                                    <td>{{ feedback?.title }}</td>
                                                    <td>{{ feedback?.category  }}</td>
                                                    <td>{{ feedback?.vote_count  }}</td>
                                                    <td v-if="userRole == 'Admin'"
                                                        class="
                                text-md
                                pr-6
                                whitespace-no-wrap
                                text-gray-800
                                tracking-normal
                                leading-4
                              "
                                                    >
                                                        <div class="flex items-center">
                                <span
                                    @click="editCoas(coa)"
                                    class="
                                    rounded
                                    border border-transparent
                                    focus:outline-none
                                    focus:border-gray-800
                                    focus:shadow-outline-gray
                                  "
                                >
                                  <div
                                      aria-label="Edit row"
                                      role="button"
                                      class="
                                      p-2
                                      bg-gray-100
                                      hover:bg-gray-200
                                      rounded
                                      cursor-pointer
                                      text-blue-700
                                    "
                                  >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-edit"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                      <path stroke="none" d="M0 0h24v24H0z" />
                                      <path
                                          d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"
                                      />
                                      <path
                                          d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"
                                      />
                                      <line x1="16" y1="5" x2="19" y2="8" />
                                    </svg>
                                  </div>
                                </span>
                                                            <a
                                                                href="#"
                                                                class="
                                    rounded
                                    border border-transparent
                                    focus:outline-none
                                    focus:border-gray-800
                                    focus:shadow-outline-gray
                                    delete_list
                                  "
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="Delete"
                                                            >
                                                                <div
                                                                    aria-label="Delete"
                                                                    role="button"
                                                                    class="
                                      p-2
                                      bg-gray-100
                                      hover:bg-gray-200
                                      rounded
                                      cursor-pointer
                                      text-red-500
                                    "
                                                                    @click.prevent="
                                      showDeleteModal(feedback.id)
                                    "
                                                                >
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-trash"
                                                                        width="20"
                                                                        height="20"
                                                                        viewBox="0 0 24 24"
                                                                        stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                    >
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                                                                        />
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                                                                        />
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div
                                                class="
                          bg-white
                          px-4
                          py-3
                          flex
                          items-center
                          justify-between
                          border-t border-gray-200
                          sm:px-6
                        "
                                            >
                                                <div
                                                    class="
                            hidden
                            sm:flex-1 sm:flex sm:items-center sm:justify-between
                          "
                                                >
                                                    <div>
                                                        <p
                                                            class="text-sm text-gray-700"
                                                            v-if="pagination.current_page"
                                                        >
                                                            Page {{ pagination.current_page }} of
                                                            {{ pagination.last_page }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <nav
                                                            class="
                                relative
                                z-0
                                inline-flex
                                rounded-md
                                shadow-sm
                                -space-x-px
                              "
                                                            aria-label="Pagination"
                                                            v-if="
                                pagination.next_page_url ||
                                pagination.prev_page_url
                              "
                                                        >
                                                            <a
                                                                href="#"
                                                                class="
                                  relative
                                  inline-flex
                                  items-center
                                  px-2
                                  py-2
                                  rounded-l-md
                                  border border-gray-300
                                  bg-white
                                  text-sm
                                  font-medium
                                  text-gray-500
                                  hover:bg-gray-50
                                "
                                                                v-bind:class="[
                                  { disabled: !pagination.prev_page_url },
                                ]"
                                                                @click="
                                                                fetchFeedbacks(pagination.prev_page_url)
                                "
                                                            >
                                                                <span class="sr-only">Previous</span>
                                                                <svg
                                                                    class="h-5 w-5"
                                                                    x-description="Heroicon name: solid/chevron-left"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                            </a>

                                                            <a
                                                                href="#"
                                                                class="
                                  relative
                                  inline-flex
                                  items-center
                                  px-2
                                  py-2
                                  rounded-r-md
                                  border border-gray-300
                                  bg-white
                                  text-sm
                                  font-medium
                                  text-gray-500
                                  hover:bg-gray-50
                                "
                                                                v-bind:class="[
                                  { disabled: !pagination.next_page_url },
                                ]"
                                                                @click.prevent="
                                                                fetchFeedbacks(pagination.next_page_url)
                                "
                                                            >
                                                                <span class="sr-only">Next</span>
                                                                <svg
                                                                    class="h-5 w-5"
                                                                    x-description="Heroicon name: solid/chevron-right"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                    aria-hidden="true"
                                                                >
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                                        clip-rule="evenodd"
                                                                    ></path>
                                                                </svg>
                                                            </a>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <WarningModal
        v-if="displayDeleteModal"
        :show="displayDeleteModal"
        @close="hideDeleteModal"
    >
        <template v-slot:modal-header> Delete Confirmation </template>
        <template v-slot:modal-text>
            Are you sure to do this because this action can not be undo?
        </template>
        <template v-slot:modal-footer>
            <button
                type="button"
                class="
          w-full
          inline-flex
          justify-center
          rounded-md
          border border-transparent
          shadow-sm
          px-4
          py-2
          bg-red-600
          text-base
          font-medium
          text-white
          hover:bg-red-700
          focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500
          sm:ml-3 sm:w-auto sm:text-sm
        "
                @click="deleteFeedback()"
            >
                Yes, Delete it
            </button>
        </template>
    </WarningModal>
</template>

<script>
import "sweetalert2/dist/sweetalert2.min.css";
import { mapState } from "vuex";
import WarningModal from "../../Layouts/WarningModal.vue";
import loader from "../../loader.vue";

export default {
    mounted() {
        document.title = "Feedbacks";
    },
    data(){
        return {
            currentPage:"",
            perPageRows:"",
            userRole:"",
        }
    },
    components: {
        WarningModal,loader
    },
    computed: mapState({
        feedbacks: (state) => state.feedbackForm.feedback,
        feedback: (state) => state.feedbackForm.feedbackItem,
        edit: (state) => state.feedbackForm.edit,
        loading: (state) => state.feedbackForm.loading,
        errors: (state) => state.feedbackForm.errors,
        pagination: (state) => state.feedbackForm.pagination,
        displayDeleteModal: (state) => state.feedbackForm.displayDeleteModal,
    }),
    created() {
        this.fetchFeedbacks("");
        this.userRole = localStorage.getItem('userRole');
    },
    methods: {
        fetchFeedbacks(url) {
            if (url == "") {
                url = process.env.MIX_ADMIN_APP_URL + "/feedbacks?q=1";
            }
            this.$store.dispatch("SystemForms/fetchSystemForms", {
                url: url,
                stateName: "feedbackForm",
                pagination: 1,
            }).then((res) => {
                this.currentPage = res.data.meta.current_page;
                this.perPageRows = res.data.meta.per_page;
            });
        },
        updateLimit(limit) {
            this.$store.commit("feedbackForm/setLimit", limit);
            this.fetchFeedbacks("");
        },
        updateSearchParameter(search) {
            this.$store.commit("feedbackForm/setSearchParameter", {
                searchParameter: search,
            });
            this.fetchFeedbacks("");
        },
        editCoas(coas) {
            this.$store.commit("feedbackForm/setCoas", coas);
            this.$store.commit("feedbackForm/setEdit", 1);
            this.$router.push({ name: "accounts.coas.create", params: { id: coas.acc_code } });
        },
        showDeleteModal(feedbackId) {
            this.$store.commit("feedbackForm/displayDeleteModal", 1);
            this.$store.commit("feedbackForm/setFeedbackId", feedbackId);
        },
        hideDeleteModal() {
            this.$store.commit("feedbackForm/displayDeleteModal", 0);
            this.$store.commit("feedbackForm/setFeedbackId", "");
        },
        deleteFeedback() {
            var url =
                process.env.MIX_ADMIN_APP_URL +
                "/feedbacks/" +
                this.$store.state.feedbackForm.feedbackId;
            this.$store
                .dispatch("SystemForms/deleteSystemForm", {
                    url: url,
                    stateName: "feedbackForm",
                })
                .then((res) => {
                    if (res.data.status == "Success") {
                        this.hideDeleteModal();
                        this.fetchCoas("");
                        this.$swal({
                            position: "center",
                            icon: "success",
                            title: "Delete Feedback SuccessFully",
                            showConfimButton: false,
                            toast: true,
                            timer: 2500,
                        });
                    } else {
                        this.$swal({
                            position: "center",
                            icon: "error",
                            title: "Something Wrong",
                            showConfimButton: false,
                            toast: true,
                            timer: 2500,
                        });
                    }
                });
        },
    },
};
</script>

<style scoped>
.loading-box {
    position: fixed;
    top: 40%;
    margin: auto;
    background: #fff;
    box-shadow: 0px 0px 9px -2px #000;
    z-index: 999;
    left: 0px;
    right: 0px;
    text-align: center;
    padding: 10px;
}
template{
    -webkit-filter: blur(8px);
    -moz-filter: blur(8px);
    -ms-filter: blur(8px);
    -o-filter: blur(8px);
    filter: blur(8px);
}
</style>
