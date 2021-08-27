<template>
  <div class="pt-2">
    <div
      class="container mt-5 pt-3 px-1 pr-md-3"
      style="width: 100vw; overflow-x: hidden"
    >
      <div class="row">
        <div
          class="col-md-8 mt-4 px-md-3 pt-md-3 pb-0"
          v-if="newsdata.topnewslist[0]"
        >
          <inertia-link
            :href="route('page.news', newsdata.topnewslist[0].slug)"
            class="list-group-item-action"
          >
            <img
              class="w-100 pt-1 p-sm-1 p-md-0"
              :src="newsdata.topnewslist[0].image"
              :alt="newsdata.topnewslist[0].titlefifty"
            />
            <h4 class="order-0">
              <div class="d-flex justify-content-between">
                <div class="btn btn-danger btn-sm px-sm-1 my-2">
                  {{ newsdata.topnewslist[0].catname }}
                </div>
                <div class="py-1 ml-auto">
                  <small style="font-size: 13px">
                    <i class="fas fa-clock"></i>
                    {{ newsdata.topnewslist[0].time }}
                  </small>
                </div>
              </div>
              <b class="d-block mb-lg-1 text-dark">
                {{ newsdata.topnewslist[0].title }}
              </b>
            </h4>
            <p class="px-1 text-justify text-dark px-sm-1 p-lg-0">
              {{ newsdata.topnewslist[0].detailshome }}
            </p>
          </inertia-link>
        </div>

        <div class="col-md-4 mt-lg-4 p-3 p-lg-2">
          <div class="row">
            <inertia-link
              :href="route('page.news', newsdata.topnewslist[1].slug)"
              class="bg-transparent d-xs-flex px-1 pb-0 pt-0 mt-md-2 list-group-item-action"
              v-if="newsdata.topnewslist[1]"
            >
              <div class="col-sm-6 col-md-12 p-1 p-md-0">
                <img
                  class="w-100 order-0"
                  :src="newsdata.topnewslist[1].imagemd"
                  :alt="newsdata.topnewslist[1].titlelimit"
                />
              </div>

              <h6 class="order-1 col-sm-6 col-md-12 mt-md-1 p-1 p-md-0">
                <div class="btn btn-danger btn-sm p-0 px-2">
                  {{ newsdata.topnewslist[1].catname }}
                </div>
                <b class="d-block pl-1 pl-lg-0 mb-lg-1 text-dark">
                  <p class="p-0 m-0 pt-1 text-gray-600" style="font-size: 12px">
                    {{ newsdata.topnewslist[1].time }}
                  </p>
                  {{ newsdata.topnewslist[1].titlefifty }}
                </b>
              </h6>
            </inertia-link>
            <inertia-link
              :href="route('page.news', newsdata.topnewslist[2].slug)"
              class="bg-transparent d-xs-flex px-1 pb-0 pt-0 mt-md-2 list-group-item-action"
              v-if="newsdata.topnewslist[2]"
            >
              <div class="col-sm-6 col-md-12 p-1 p-md-0">
                <img
                  class="w-100 order-0"
                  :src="newsdata.topnewslist[2].imagemd"
                  :alt="newsdata.topnewslist[2].titlelimit"
                />
              </div>

              <h6 class="order-1 col-sm-6 col-md-12 mt-md-1 p-1 p-md-0">
                <div class="btn btn-danger btn-sm p-0 px-2">
                  {{ newsdata.topnewslist[2].catname }}
                </div>
                <b class="d-block pl-1 pl-lg-0 mb-lg-1 text-dark">
                  <p class="p-0 m-0 pt-1 text-gray-600" style="font-size: 12px">
                    {{ newsdata.topnewslist[2].time }}
                  </p>
                  {{ newsdata.topnewslist[2].titlefifty }}
                </b>
              </h6>
            </inertia-link>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 p-0 px-2 mt-md-1">
          <div class="row">
            <inertia-link
              :href="route('page.news', news.slug)"
              class="col-md-6 bg-transparent d-xs-flex p-md-3 pt-md-0 mt-md-1 list-group-item-action"
              v-for="news in newsdata.topnewslist.slice(3)"
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
                  <p class="p-0 m-0 pt-1 text-gray-600" style="font-size: 12px">
                    {{ news.time }}
                  </p>
                  {{ news.titlefifty }}
                </b>
              </h6>
            </inertia-link>
          </div>
        </div>
        <!-- right col4 -->
        <div class="col-md-4 p-lg-3">
          <div class="row"></div>
        </div>
        <div class="col-md-12 p-0 px-2 mt-md-1">
          <div class="row">
            <inertia-link
              :href="route('page.news', news.slug)"
              class="col-md-4 bg-transparent d-xs-flex p-md-3 pt-md-0 mt-md-1 list-group-item-action"
              v-for="news in newsdata.catone"
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
                  <p class="p-0 m-0 pt-1 text-gray-600" style="font-size: 12px">
                    {{ news.time }}
                  </p>
                  {{ news.titlefifty }}
                </b>
              </h6>
            </inertia-link>
          </div>
        </div>
        <!-- end right col4 -->
      </div>
    </div>

    <div
      class="my-5 py-5 px-1 bg-gray-900"
      style="width: 100vw; overflow-x: hidden"
    >
      <div class="container px-2">
        <div class="row">
          <div class="col-md-6 p-0">
            <inertia-link
              :href="route('page.news', news.slug)"
              class="list-group-item-action pl-1 pr-2"
              :class="key ? 'col-md-12 bg-transparent d-flex px-1 pb-1' : ''"
              v-for="(news, index, key) in newsdata.catwo"
              :key="index"
            >
              <img
                class=""
                :class="
                  key ? 'w-100 col-6 pl-0 pr-1' : 'w-100 order-0 pt-1 pl-0 pr-2'
                "
                :src="key ? news.imagemd : news.image"
                :alt="news.titlefifty"
              />
              <h6 class="order-1 pl-1" v-if="key">
                <div class="btn btn-danger btn-sm p-0 px-2">
                  {{ news.catname }}
                </div>
                <b class="d-block text-white pt-1">
                  <p class="p-0 m-0 pt-1 text-gray-600" style="font-size: 12px">
                    {{ news.time }}
                  </p>
                  {{ news.titlefifty }}
                </b>
              </h6>
              <h4 class="order-0 px-1" v-if="!key">
                <div class="d-flex justify-content-between">
                  <div class="btn btn-danger btn-sm px-sm-1 my-2">
                    {{ news.catname }}
                  </div>
                  <div class="py-1 ml-auto">
                    <small class="text-gray-600" style="font-size: 13px">
                      <i class="fas fa-clock"></i>
                      {{ news.time }}
                    </small>
                  </div>
                </div>
                <b class="d-block mb-lg-1 text-white">
                  {{ news.title }}
                </b>
              </h4>
              <p class="px-1 text-justify text-white" v-if="!key">
                {{ news.detailshome }}
              </p>
            </inertia-link>
          </div>

          <div class="col-md-6 p-0">
            <div class="row">
              <inertia-link
                :href="route('page.news', news.slug)"
                class="col-md-12 bg-transparent d-flex px-md-4 pb-md-2 pt-md-0 list-group-item-action"
                v-for="news in newsdata.cathree"
                :key="news.key"
              >
                <div class="col-6 p-1">
                  <img
                    class="w-100 order-0"
                    :src="news.imagemd"
                    :alt="news.titlelimit"
                  />
                </div>

                <h6 class="order-1 mt-1 pl-1">
                  <div class="btn btn-danger btn-sm p-0 px-2">
                    {{ news.catname }} {{ index }}
                  </div>
                  <b class="d-block text-white pt-1">
                    <p
                      class="p-0 m-0 pt-1 text-gray-600"
                      style="font-size: 12px"
                    >
                      {{ news.time }}
                    </p>
                    {{ news.titlefifty }}
                  </b>
                </h6>
              </inertia-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "./Layout";
export default {
  layout: Layout,
  props: ["newsdata"],
  mounted() {
    document.title = `Alfijir | Home`;
  },
};
</script>
