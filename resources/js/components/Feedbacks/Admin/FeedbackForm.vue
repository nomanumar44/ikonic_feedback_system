<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <loader v-if="loading" class="loading-box"></loader>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fab fa-telegram-plane"></i>
                             Feedback Form
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="cityform" id="CityForm">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Title </label>
                                                        <input type="text" @input="updateField('title', $event.target.value)"
                                                            :value="feedback.title" class="form-control" id="txtCityName"
                                                            name="title" placeholder="Enter Title" />
                                                    </div>
                                                    <small class="text-red-400" v-if="errors.has('title')"
                                                        v-text="errors.get('title')"></small>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Description </label>
                                                        <input type="text" @input="updateField('description', $event.target.value)"
                                                            :value="feedback.description" class="form-control" id="txtCityName"
                                                            name="description" placeholder="Enter Description" />
                                                    </div>
                                                    <small class="text-red-400" v-if="errors.has('description')"
                                                        v-text="errors.get('description')"></small>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Category </label>
                                                        <select  @input="updateField('category', $event.target.value)"
                                                             class="form-control" id="txtCityName"
                                                            name="category" >
                                                            <option value="bug_report">Bug Report</option>
                                                            <option value="feature_request">Feature Request</option>
                                                            <option value="improvement">improvement</option>
                                                            <option value="etc">etc</option>
                                                        </select>
                                                    </div>
                                                    <small class="text-red-400" v-if="errors.has('category')"
                                                        v-text="errors.get('category')"></small>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">attchments </label>
                                                        <input type="file" @input="uploadImage($event)"
                                                             class="form-control" id="txtCityName"
                                                            name="image" placeholder="Enter Password" />
                                                    </div>
                                                    <small class="text-red-400" v-if="errors.has('image')"
                                                        v-text="errors.get('image')"></small>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group text-right">
                                                        <button @click="addUpdateFeedback()" :disabled="loading"
                                                            id="BtnCitySave" class="btn btn-success" type="button"
                                                            name="btn">
                                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                                        </button>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <button type="button" class="btn btn-secondary"
                                                            @click="clearpartner(partner.id)"><i
                                                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <WarningModal
        v-if="displayDeleteModal"
        :show="displayDeleteModal"
        @close="hideDeleteModal"
    >
        <template v-slot:modal-header> Delete Confirmation</template>
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
                @click="deleteCoa1()"
            >
                Yes, Delete it
            </button>
        </template>
    </WarningModal>
</template>

<script>
import "sweetalert2/dist/sweetalert2.min.css";
import { mapState } from "vuex";
import axios from 'axios';
import loader from "../../loader.vue";
import WarningModal from "../../Layouts/WarningModal.vue";

export default {
    mounted() {
    document.title = "feedback-form";
    },
    components: {
        loader,
        WarningModal
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
    methods:{
        updateField(field, value) {
        this.$store.commit("feedbackForm/updateFeedbackItem", {
            [field]: value,
        });
    },
    uploadImage(event) {
        const formData = new FormData();
        formData.append('file', event.target.files[0]);
        const url = process.env.MIX_ADMIN_APP_URL + "/upload-image";

        axios.post(url, formData)
            .then((res) => {
                const value = res.data.image_url;
                this.$store.commit("feedbackForm/updateFeedbackItem", {
                    attachment: value,
                });
            })
            .catch((error) => {
                this.$swal(error);
            });
    },
    addUpdateFeedback() {
        let url = process.env.MIX_ADMIN_APP_URL + "/feedbacks";
        if (this.edit) {
            url = process.env.MIX_ADMIN_APP_URL + "/feedbacks/" + this.feedback.id;
        }
        this.$store
            .dispatch("SystemForms/addUpdateSupportingForm", {
                url: url,
                data: this.feedback,
                stateName: "feedbackForm",
            })
            .then((res) => {
                this.$store.commit("feedbackForm/setFeedbackItem", {
                    title: "",
                    description: "",
                    category: "",
                    attachment: "",
                });
                if (res.data.status === "Success") {
                    const channel = window.Echo.channel('feedbacks');
                    channel.listen('FeedbackUpdates', (event) => {
                        console.log(event);
                        this.feedbacks = [...event.feedbacks];
                        if(event.message != ''){
                            this.$toast.success(event.message,{
                            position: "toptop-right",
                        }   );
                        }
                    });
                    this.meta = res.meta;
                    if (this.edit === 1) {
                        this.$swal({
                            position: "center",
                            icon: "success",
                            title: "Update Successful",
                            showConfirmButton: false,
                            toast: true,
                            timer: 2500,
                        });
                    } else {
                        this.$swal({
                            position: "center",
                            icon: "success",
                            title: "Add Successful",
                            showConfirmButton: false,
                            toast: true,
                            timer: 2500,
                        });
                    }
                    this.$store.commit("feedbackForm/setEdit", 0);
                    this.$router.push('/');
                } else {
                    this.$swal({
                        position: "center",
                        icon: "error",
                        title: "Error",
                        showConfirmButton: false,
                        toast: true,
                        timer: 2500,
                    });
                }
            });
    },
    created() {
           const userId =  localStorage.getItem('userId');
            this.$store.commit("Users/setEdit", 1);
            var url =
                process.env.MIX_ADMIN_APP_URL +
                "/users/" +
                userId +
                "?q=1";
            this.$store.dispatch("SystemForms/fetchSystemForms", {
                url: url,
                stateName: "Users",
                mutationName: "setUser",
            });
    },
    }
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
</style>
