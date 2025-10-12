<template>
  <div class="home-page">
    <section class="hero">
      <h1 class="sr-only">Welcome to Finance Training Unit Portal</h1>
      <div class="carousel" @mouseenter="stop" @mouseleave="start">
        <div class="carousel-track">
          <div
            v-for="(img, index) in images"
            :key="index"
            class="slide"
            :class="{ active: index === current }"
          >
            <img :src="img" :alt="`Slide ${index + 1}`" loading="lazy" />
          </div>
        </div>

        <button class="arrow left" @click="prev" aria-label="Previous slide">‹</button>
        <button class="arrow right" @click="next" aria-label="Next slide">›</button>

        <div class="dots">
          <button
            v-for="(img, idx) in images"
            :key="idx"
            :class="['dot', { active: idx === current }]"
            @click="goTo(idx)"
            :aria-label="`Go to slide ${idx + 1}`"
          ></button>
        </div>
      </div>
    </section>

    <div class="cards">
      <div class="aboutus card" id="mission">
        <h2>Mission</h2>
        <p>To provide high standard and responsive Budget, Fiscal and Finance Education and Training to develop a competent, excellent and highly-skilled BFF professionals for the Philippine Navy.</p>
      </div>

      <div class="aboutus card" id="vision">
        <h2>Vision</h2>
        <p>By 2028, to be a competent and capable Budget, Fiscal and Finance (BFF) Education and Training Administrator that produces motivated, excellent and highly-skilled BFF Professionals for the Philippine Navy.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    // Use Vite's import.meta.glob to reliably resolve image URLs at build time
    const modules = import.meta.glob('../images/*.jpg', { eager: true, as: 'url' });
    // modules is an object: { './.../images/1.jpg': 'http://.../1.jpg', ... }
    const images = Object.entries(modules)
      .map(([path, url]) => ({ path, url }))
      .sort((a, b) => {
        const na = (a.path.match(/(\d+)\.jpg$/) || [0, 0])[1];
        const nb = (b.path.match(/(\d+)\.jpg$/) || [0, 0])[1];
        return Number(na) - Number(nb);
      })
      .map(x => x.url);
    return {
      images,
      current: 0,
      timer: null,
      interval: 4000,
    };
  },
  mounted() {
    // hide the sidebar and center this page while Home is active
    try { document && document.body && document.body.classList.add('home-no-sidebar'); } catch(e){}
    this.start();
  },
  beforeUnmount() {
    this.stop();
    try { document && document.body && document.body.classList.remove('home-no-sidebar'); } catch(e){}
  },
  methods: {
    start() {
      this.stop();
      this.timer = setInterval(this.next, this.interval);
    },
    stop() {
      if (this.timer) {
        clearInterval(this.timer);
        this.timer = null;
      }
    },
    next() {
      this.current = (this.current + 1) % this.images.length;
      // restart autoplay timer so user interaction doesn't immediately trigger auto-advance
      this.start();
    },
    prev() {
      this.current = (this.current - 1 + this.images.length) % this.images.length;
      this.start();
    },
    goTo(i) {
      this.current = i;
      this.start();
    },
  },
};
</script>

<style>
/* Carousel styles */
.home-page { padding: 1rem; }
.carousel { position: relative; max-width: 980px; margin: 0 auto 1.25rem; overflow: hidden; border-radius: 12px; }
.carousel-track { position: relative; height: 420px; }
.slide { position: absolute; inset: 0; opacity: 0; transform: scale(1.02); transition: opacity 0.6s ease, transform 0.6s ease; display: flex; align-items: center; justify-content: center; }
.slide img { width: 100%; height: 100%; object-fit: cover; display: block; }
.slide.active { opacity: 1; transform: scale(1); }
.arrow { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.45); color: #fff; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display:flex; align-items:center; justify-content:center; font-size: 20px; }
.arrow.left { left: 12px; }
.arrow.right { right: 12px; }
.dots { position: absolute; left: 50%; transform: translateX(-50%); bottom: 12px; display:flex; gap:8px; }
.dot { width:10px; height:10px; border-radius:50%; background: rgba(255,255,255,0.6); border: none; cursor: pointer; }
.dot.active { background: #ffffff; box-shadow: 0 0 0 4px rgba(255,255,255,0.12); }

/* Responsive */
@media (max-width: 900px){ .carousel-track { height: 320px; } }
@media (max-width: 600px){ .carousel-track { height: 220px; } .arrow { width:34px; height:34px; } }

/* keep existing aboutus styles below (slightly adapted) */
.container {
      margin-top: 30px;
      margin-bottom: 50px;
      padding: 2rem;
      max-width: auto;
      margin-left: 0;
      margin-right: 5px;
      display: flex;
      justify-content: center   ;
      align-items: flex-start;
}
.aboutus h2 { color: #333; margin-bottom: 10px; }
.aboutus { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); padding: 1rem 1rem; text-align: center; font-size: 1.1rem; transition: all 0.3s ease; position: relative; overflow: hidden; }
.aboutus::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, rgb(201, 201, 201), #00004D); transform: scaleX(0); transition: transform 0.3s ease; }
.aboutus:hover::before { transform: scaleX(1); }
.aboutus:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); }

/* Cards layout for mission/vision */
.cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; max-width: 1100px; margin: 2rem auto 4rem; padding: 0 1rem; }
.card { padding: 1.25rem 1.5rem; min-height: 160px; display:flex; flex-direction:column; justify-content:center; }
.card h2 { margin-bottom: 0.6rem; }

@media (max-width: 800px) {
  .cards { grid-template-columns: 1fr; }
}

/* When Home is active, hide the sidebar and center main content */
body.home-no-sidebar .main-container { grid-template-columns: 1fr !important; max-width: 900px; margin: 0 auto; }
body.home-no-sidebar .sidebar { display: none !important; }
body.home-no-sidebar .content { padding: 0; }
</style>
 