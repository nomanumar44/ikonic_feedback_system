<template>
<div class="bg-gray-200">
<div class="container" >
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
      <h1 class="text-center text-black">IKONIC FEEDBACK SYSTEM</h1>
    </div>
  </div>
  <div class="row" >
    <div class="col-md-4">
      <section style="margin-top:50px">
        <div class="container" >
          <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
              <div class="card" style="border-radius: 15px;">
                <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                  <img :src="product?.image_path"
                    style="border-top-left-radius: 15px; border-top-right-radius: 15px;" class="img-fluid" alt="Laptop" />
                  <a href="#!">
                    <div class="mask"></div>
                  </a>
                </div>
                <div class="card-body pb-0">
                  <div class="d-flex justify-content-between">
                    <div>
                      <p><a href="#!" class="text-dark">{{ product?.name }}</a></p>
                      <p class="small text-muted">Laptops</p>
                    </div>
                    <div>
                      <div class="d-flex flex-row justify-content-end mt-1 mb-4 text-danger">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="small text-muted">Rated 4.0/5</p>
                    </div>
                  </div>
                </div>
                <hr class="my-0" />
                <div class="card-body pb-0">
                  <div class="d-flex justify-content-between">
                    <p><a href="#!" class="text-dark">${{ product?.price }}</a></p>
                    <p class="text-dark">#### 8787</p>
                  </div>
                  <p class="small text-muted">VISA Platinum</p>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                    <button type="button" class="btn btn-primary" @click="addFeedBack">Feedback</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="col-md-8">
      <section class="gradient-custom">
  <div class="container  py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card fixedwidth">
          <div class="card-body p-4">
            <h4 class="text-center mb-4 pb-2">Recant Feedbacks</h4>
            <div class="row">
              <div class="col">
                <div class="d-flex flex-start card p-2 mb-4" v-for="(feedback,index) in feedbacks" :key="index">
                  <a class="me-3" href="#">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="65"
                    height="65" />
                  </a>
                  <div class="flex-grow-1 flex-shrink-1">
                    <div>
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-1 text-black font-bold">
                          {{ feedback?.title }}
                        </p>
                        <button @click="showCommentModel(index)"><i class="fas fa-reply fa-xs "></i><span class="small text-blue-500"> reply</span></button>
                      </div>
                      <p class="small mb-0">
                        {{ feedback?.description }}
                      </p>
                      <div class="float-right">
                        <button
                            :class="{
                                'btn btn-sm btn-outline-success me-2': !feedback?.votes.user || feedback?.votes.vote_type !== 'upvote',
                                'btn btn-sm btn-success me-2 bg-green-500': feedback?.votes.user && feedback?.votes.vote_type === 'upvote'
                            }"
                            @click="upvoteFeedback(feedback?.id, index)"
                            :disabled="feedback?.votes.user && feedback?.votes.user.vote_type === 'upvote'"
                            >
                            <i class="fas fa-thumbs-up"></i><span class="text-black">{{ feedback?.votes.reduce((total,item) => item.vote_type == 'upvote' ? total + 1 : 0,0) }}</span>
                            </button>
                            <button
                            :class="{
                                'btn btn-sm btn-outline-danger me-2': !feedback?.votes.user || feedback?.votes.user.vote_type !== 'downvote',
                                'btn btn-sm btn-danger me-2 bg-red-500': feedback?.votes.user && feedback?.votes.vote_type === 'downvote'
                            }"
                            @click="downvoteFeedback(feedback?.id, index)"
                            :disabled="feedback?.votes.user && feedback?.votes.vote_type === 'downvote'"
                            >
                             <i class="fas fa-thumbs-down"></i><span class="text-black">{{ feedback?.votes.reduce((total,item) => item.vote_type == 'downvote' ? total + 1 : 0,0) }}</span>
                        </button>
                        <button class="btn btn-sm btn-primary" @click="showUserComments(index)">
                            Show Comments
                        </button>
                      </div>
                    </div>
                    <div>
                    <div v-show="showComment[index]">
                      <div class="d-flex flex-start mt-4">
                        <div class="card mb-4 w-100">
                          <div class="card-body">
                            <input type="text" v-model="commentText" id="addANote" class="form-control" placeholder="Type comment..." />
                            <div class="d-flex justify-content-between mt-2">
                              <div class="d-flex flex-row align-items-center">
                              </div>
                              <div class="d-flex flex-row align-items-center">
                                <button class="btn btn-sm btn-primary" @click="addComment(index,feedback?.id)" :disabled="sucessResponse[index]">Add Comment</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-show="checkComment[index]">
                        <template v-for="comment in feedback?.comments" :key="comment?.id">
                          <div class="d-flex flex-start mt-4  card p-2" >
                            <div class="flex-grow-1 flex-shrink-1">
                              <div>
                                <div class="d-flex justify-content-between align-items-center">
                                  <p class="mb-1">
                                    <span class="user-name font-bold text-black">{{ comment?.user?.name }}</span>
                                  </p>
                                  <span class="small float-right">{{ formatDateTime(comment?.created_at) }}</span>
                                </div>
                                <p class="small mb-0">
                                  {{ comment?.content }}
                                </p>
                              </div>
                            </div>
                          </div>
                        </template>
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
</section>
    </div>
  </div>
</div>
</div>

</template>

<script>
import "sweetalert2/dist/sweetalert2.min.css";
import { mapState } from "vuex";
import axios from 'axios';
import loader from "../../loader.vue";
import WarningModal from "../../Layouts/WarningModal.vue";

export default {
    mounted() {
        document.title = "product-list";
    },
    components:{
        loader
    },
    data(){
        return {
            product:'',
            feedbacks:[],
            checkComment:[],
            showComment:[],
            commentText:'',
            sucessResponse:[],
            message:'',
        }
    },
    methods: {
        getProduct(){
            const url = process.env.MIX_ADMIN_APP_URL + '/get-product';
            axios.get(url).then((res) => {
                this.product = {...res.data};
            })
        },
        addFeedBack(){
            window.location.href = '/login';
        },
        formatDateTime(dateTime) {
            const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            };
            return new Date(dateTime).toLocaleString(undefined, options);
        },
        showCommentModel(index) {
            this.showComment[index] = true;
        },
        addComment(index,feedbackId) {
          this.sucessResponse[index] = true;
          const url = process.env.MIX_ADMIN_APP_URL + '/add-comment'
          axios.post(url,{
            feedback_id:feedbackId,
            content: this.commentText,
          }).then((res) => {
              this.$swal({
                    position: "center",
                    icon: "success",
                    title: "Comment Add Successfully",
                    showConfirmButton: false,
                    toast: true,
                    timer: 2500,
                });
                this.showComment[index] = false;
                this.sucessResponse[index] = false;
                this.websocketsCall();

          });
        },
        showUserComments(index){
            this.checkComment[index] = !this.checkComment[index];
        },
        upvoteFeedback(feedbackId) {
            const url = process.env.MIX_ADMIN_APP_URL + `/upvote`;
            axios.post(url,{
                feedback_id:feedbackId,
            }).then((response) => {
                    this.websocketsCall();
                }).catch((error) => {

                });
        },
        downvoteFeedback(feedbackId) {
            const url = process.env.MIX_ADMIN_APP_URL + `/downvote`;
            axios.post(url,{
                feedback_id:feedbackId,
            }).then((response) => {
                this.websocketsCall();
                }).catch((error) => {

                });
        },
        websocketsCall(){
            const channel = window.Echo.channel('feedbacks');
            channel.listen('FeedbackUpdates', (event) => {
                console.log(event);
                this.feedbacks = [...event.feedbacks];
                if(event.message != ''){
                    this.$toast.success(event.message,{
                    position: "top-right",
                }   );
                }
            });
        }
    },
    created() {
        this.getProduct();
    },
    mounted() {
        this.websocketsCall();
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
.fixedwidth {
  max-height: 95vh; /* Adjust the maximum height as needed */
  overflow-y: auto;
}
</style>
