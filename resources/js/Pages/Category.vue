<template>
  <div class="pt-2">
    <div
      class="container mt-5 pt-3 px-1 pr-md-3"
      style="width: 100vw; overflow-x: hidden"
    >
      <div class="row">
        <div class="col-md-8 mt-4 p-lg-3" v-if="categories.newscategorylist[0]">
          <inertia-link
            :href="route('page.news', categories.newscategorylist[0].slug)"
            class="list-group-item-action"
          >
            <img
              class="w-100 pt-1 p-sm-1 p-md-0"
              :src="categories.newscategorylist[0].image"
              :alt="categories.newscategorylist[0].titlesixty"
            />
            <h4 class="order-0">
              <div class="btn btn-danger btn-sm px-sm-1 my-2">
                {{ categories.newscategorylist[0].catname }}
              </div>
              <b class="d-block mb-lg-1 text-dark">
                {{ categories.newscategorylist[0].title }}
              </b>
            </h4>
            <p class="px-1 text-justify text-dark px-sm-1 p-lg-0">
              {{ categories.newscategorylist[0].detailshome }}
            </p>
          </inertia-link>
        </div>

        <div class="col-md-4 mt-lg-4 p-3 p-lg-2">
          <div class="row">
            <inertia-link
              :href="route('page.news', categories.newscategorylist[1].slug)"
              class="bg-transparent d-xs-flex p-1 pt-0 mt-1 list-group-item-action"
              v-if="categories.newscategorylist[1]"
            >
              <div class="col-sm-6 col-md-12 p-1 p-md-0">
                <img
                  class="w-100 order-0"
                  :src="categories.newscategorylist[1].image"
                  :alt="categories.newscategorylist[1].titlelimit"
                />
              </div>

              <h6 class="order-1 col-sm-6 col-md-12 mt-md-1 p-1 p-md-0">
                <div class="btn btn-danger btn-sm p-0 px-2">
                  {{ categories.newscategorylist[1].catname }}
                </div>
                <b class="d-block pl-1 pl-lg-0 mb-lg-1 text-dark">
                  {{ categories.newscategorylist[1].titlesixty }}
                </b>
              </h6>
            </inertia-link>
            <inertia-link
              :href="route('page.news', categories.newscategorylist[2].slug)"
              class="bg-transparent d-xs-flex p-1 pt-0 mt-1 list-group-item-action"
              v-if="categories.newscategorylist[2]"
            >
              <div class="col-sm-6 col-md-12 p-1 p-md-0">
                <img
                  class="w-100 order-0"
                  :src="categories.newscategorylist[2].image"
                  :alt="categories.newscategorylist[2].titlelimit"
                />
              </div>

              <h6 class="order-1 col-sm-6 col-md-12 mt-md-1 p-1 p-md-0">
                <div class="btn btn-danger btn-sm p-0 px-2">
                  {{ categories.newscategorylist[2].catname }}
                </div>
                <b class="d-block pl-1 pl-lg-0 mb-lg-1 text-dark">
                  {{ categories.newscategorylist[2].titlesixty }}
                </b>
              </h6>
            </inertia-link>
          </div>
        </div>
      </div>
      <!-- {{ categories.newscategorylist.slice(3) }} -->
      <div class="row">
        <div class="col-md-12 p-0 px-2 mt-md-1">
          <div class="row">
            <inertia-link
              :href="route('page.news', news.slug)"
              class="col-md-3 bg-transparent d-xs-flex p-md-3 pt-md-0 mt-md-1 list-group-item-action"
              v-for="news in categories.newscategorylist.slice(3)"
              :key="news.key"
            >
              <div class="col-sm-6 col-md-12 p-1 p-md-0">
                <img
                  class="w-100 order-0"
                  :src="news.imagemd"
                  :alt="news.titlelimit"
                />
              </div>

              <h6 class="order-1 col-sm-6 col-md-12 mt-md-1 p-1 p-md-0">
                <div class="btn btn-danger btn-sm p-0 px-2">
                  {{ news.catname }}
                </div>
                <b class="d-block mb-lg-1 text-dark">
                  {{ news.titlefifty }}
                </b>
              </h6>
            </inertia-link>
          </div>
        </div>
        <!-- right col4 -->
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "./Layout";
export default {
  layout: Layout,
  props: ["categories"],
  mounted() {
    document.title = `Alfijir | ${this.categories.newscategorylist[0].catname}`;
    document.head.querySelector(
      'meta[property="og:title"]'
    ).content = this.categories.newscategorylist[0].catname;
  },
};
</script>
