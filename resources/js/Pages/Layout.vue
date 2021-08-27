<template>
  <main>
    <header>
      <div class="fixed-top text-center border-0 p-0 bg-white">
        <div class="container text-center border-0 p-0">
          <nav class="navbar navbar-expand px-sm-2">
            <div class="col-3 p-0 m-0">
              <inertia-link
                class="nav-item p-0 nav-link text-light"
                :href="route('home')"
              >
                <img class="" :src="$page.props.shared.logo" alt="Alfijir" />
              </inertia-link>
            </div>

            <div class="col-5 p-0 d-flex ml-auto">
              <button
                type="button"
                class="bg-transparent ml-auto border-0 d-flex stream-button"
                style="outline: 0"
                @click="liveStream"
              >
                <i
                  class="fas fa-2x"
                  :class="
                    playing
                      ? 'fa-pause-circle text-warning'
                      : 'fa-play-circle text-danger'
                  "
                ></i>
                <h6 class="m-0 p-0 ml-1 mt-2 text-xs">Kai-tsaye</h6>
              </button>
            </div>

            <button
              type="button"
              class="bg-transparent border-0 ml-auto x-button pl-md-0 m-0 p-0"
              data-target="#collapsibleNavId"
              data-toggle="collapse"
              aria-controls="collapsibleNavId"
              aria-expanded="false"
              aria-label="Toggle navigation"
              style="outline: 0"
              @click="togleShow"
            >
              <i class="fas fa-2x" :class="show ? 'fa-times' : 'fa-bars'"></i>
            </button>
          </nav>
        </div>
        <hr class="p-0 m-0 bg-white" />
        <nav
          class="navbar navbar-dark bg-gray-400 shadow py-0"
          style="width: 100vw; position: absolute; z-index: 99999"
        >
          <div class="container main-container px-1 py-0">
            <div
              class="collapse navbar-collapse collapsed pl-0"
              :class="show ? 'show' : ''"
              id="collapsibleNavId"
            >
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0 pl-lg-0">
                <li
                  class="nav-item"
                  v-for="category in $page.props.shared.news_categories"
                  :key="category.id"
                >
                  <inertia-link
                    class="nav-link text-dark"
                    :href="route('page.category', category.slug)"
                  >
                    {{ category.name }}
                  </inertia-link>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <nav
          class="navbar navbar-expand navbar-dark bg-danger shadow-sm py-0 pr-3"
          style="max-width: 100vw; overflow-x: auto"
        >
          <div class="container main-container px-lg-3 px-sm-1 py-0">
            <div class="collapse navbar-collapse collapsed pl-0" id="">
              <ul class="navbar-nav mr-auto mt-lg-0 pl-lg-0">
                <li class="nav-item">
                  <inertia-link
                    class="nav-link text-light"
                    :href="route('home')"
                  >
                    <i class="fas fa-home"></i>
                  </inertia-link>
                </li>
                <!-- labarai -->
                <li
                  class="nav-item px-2"
                  v-for="category in $page.props.shared.news_categories"
                  :key="category.id"
                >
                  <inertia-link
                    class="nav-link text-nowrap text-light"
                    :href="route('page.category', category.slug)"
                    >{{ category.name }}
                  </inertia-link>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>

<script>
export default {
  data() {
    return {
      show: false,
      playing: false,
      audio: new Audio(),
    };
  },
  methods: {
    togleShow() {
      this.show = !this.show;
    },
    liveStream() {
      if (this.audio.paused) {
        this.audio.src = this.$page.props.shared.stream_url;
        this.audio.play();
        this.playing = true;
      } else {
        this.audio.pause();
        this.playing = false;
      }
    },
  },
};
</script>
