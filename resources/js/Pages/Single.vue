<template>
  <div class="pt-2">
    <div
      class="container mt-5 pt-3 px-1 pr-md-3"
      style="width: 100vw; overflow-x: hidden"
    >
      <div class="row">
        <div class="col-md-8 mt-4 p-lg-3" v-if="read.newssingle">
          <inertia-link
            :href="route('page.news', read.newssingle.slug)"
            class="list-group-item-action"
          >
            <img
              class="w-100 pt-1 p-sm-1 p-md-0"
              :src="read.newssingle.image"
              :alt="read.newssingle.titlesixty"
            />
            <h4 class="order-0">
              <div class="d-flex px-sm-1 my-2">
                <!-- {{ read.newssingle.catname }} -->
                <!-- <inertia-link
                  target="_blank"
                  :href="twitterUrl"
                  class="btn btn-facebook mx-1 btn-sm float-right"
                >
                  <i class="fab fa-twitter"> Tweet</i>
                </inertia-link>

                <inertia-link
                  target="_blank"
                  :href="whatsappUrl"
                  class="btn btn-success mx-1 btn-sm float-right"
                >
                  <i class="fab fa-whatsapp"> Share</i>
                </inertia-link>

                <iframe
                  :src="facebookUrl"
                  width="100"
                  height="28"
                  style="border: none; overflow: hidden"
                  scrolling="no"
                  frameborder="0"
                  allowTransparency="true"
                  allow="encrypted-media"
                  class="ml-auto"
                ></iframe> -->
                <facebook
                  :url="read.newssingle.url"
                  scale="3"
                  class="mr-3"
                ></facebook>
                <twitter
                  :url="read.newssingle.url"
                  :title="read.newssingle.title"
                  scale="3"
                  class="mr-3"
                ></twitter>
                <!-- <linkedin
                  :url="read.newssingle.url"
                  scale="3"
                  class="mr-2"
                ></linkedin>
                <telegram
                  :url="read.newssingle.url"
                  scale="3"
                  class="mr-2"
                ></telegram> -->
                <whats-app
                  :url="read.newssingle.url"
                  :title="read.newssingle.title"
                  scale="3"
                  class="mr-3"
                ></whats-app>
                <!-- <pinterest
                  :url="read.newssingle.url"
                  scale="3"
                  class="mr-3"
                ></pinterest> -->
                <linkedin
                  :url="read.newssingle.url"
                  scale="3"
                  class="mr-3"
                ></linkedin>
                <!-- <reddit
                  :url="read.newssingle.url"
                  scale="3"
                  :title="read.newssingle.title"
                  class="mr-2"
                ></reddit> -->
                <!-- <google :url="read.newssingle.url" scale="3"></google>
                <email
                  :url="read.newssingle.url"
                  :subject="read.newssingle.title"
                  scale="3"
                ></email> -->
              </div>
              <div class="d-flex justify-content-between px-sm-1 my-2">
                <div class="py-2">
                  <small style="font-size: 13px" v-if="read.newssingle.author">
                    Rubutu: {{ read.newssingle.author }}
                  </small>
                </div>
                <div class="py-2 ml-auto">
                  <small style="font-size: 13px">
                    <i class="fas fa-clock"></i>
                    {{ read.newssingle.time }}
                  </small>
                </div>
              </div>
              <b class="d-block mb-lg-1 text-dark">
                {{ read.newssingle.title }}
              </b>
            </h4>
            <p
              class="px-1 text-justify text-dark px-sm-1 p-lg-0"
              v-html="read.newssingle.detailsread"
            ></p>
          </inertia-link>
        </div>

        <div class="col-md-4 mt-lg-4 p-3 p-lg-2">
          <div class="row">
            <span v-for="(news, index) in read.catnews" :key="index">
              <inertia-link
                :href="route('page.news', news.slug)"
                class="bg-transparent d-flex p-1 pt-0 mt-1 list-group-item-action"
                v-if="index > 0"
              >
                <div class="col-6 p-1">
                  <img
                    class="w-100 order-0"
                    :src="news.image"
                    :alt="news.titlelimit"
                  />
                </div>

                <h6 class="order-1 col-6 p-1">
                  <b class="d-block pl-1 p-md-0 text-dark">
                    {{ news.titlesixty }}
                  </b>
                  <small class="px-1" style="font-size: 13px">
                    {{ news.time }}
                  </small>
                </h6>
              </inertia-link>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "./Layout";

import {
  Facebook,
  Twitter,
  Linkedin,
  Pinterest,
  Reddit,
  Telegram,
  WhatsApp,
  Email,
  Google,
} from "vue-socialmedia-share";
export default {
  data() {
    return {
      twitterUrl: `https://twitter.com/intent/tweet?text=${this.read.newssingle.url}`,
      facebookUrl: `https://www.facebook.com/plugins/share_button.php?href=${this.read.newssingle.url}&layout=button_count&size=large&width=84&height=28&appId`,
      whatsappUrl: `https://wa.me/?text=${this.read.newssingle.url}`,
    };
  },
  components: {
    Facebook,
    Twitter,
    Linkedin,
    Pinterest,
    Reddit,
    Telegram,
    WhatsApp,
    Email,
    Google,
  },
  layout: Layout,
  props: ["read"],
};
</script>

