<template>
  <div class="grid-wrapper">
    <div class="grid-background" aria-hidden="true"></div>
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
            <img :src="img" :alt="`Slide ${index + 1}`"/>
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

    <!-- Finance Training Unit Title / Hero band -->
    <section class="ftu-band" aria-hidden="false">
      <div class="ftu-container">
        <div class="ftu-title">
          <h2>FINANCE TRAINING UNIT</h2>
          <p class="ftu-sub">Building capable Budget, Fiscal & Finance (BFF) professionals for the Philippine Navy</p>
        </div>
        <div class="ftu-actions">
          <a href="#mission" class="ftu-cta">Our Mission</a>
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
  </div>
</template>

<script>
export default {
  data() {
    // Use Vite-friendly imports so images resolve in dev and production
    // import.meta.glob returns an object of matching modules; we'll map to their URLs
    let images = [];
    try {
  const modules = import.meta.glob('../images/*.{jpg,png,jpeg,gif}', { eager: true, query: '?url', import: 'default' })
  images = Object.keys(modules).map(k => modules[k])
  // optional: sort by filename so ordering is stable
  images.sort()
  // remove any slide named 14.* if present (defensive)
  images = images.filter(url => !/\/14\.(jpg|png|jpeg|gif)$/i.test(url))
  // ensure we only keep the first 13 images
  images = images.slice(0, 13)
    } catch (e) {
      // fallback to legacy path if import.meta.glob isn't available in this environment
      images = [];
      for (let i = 1; i <= 13; i++) {
        images.push(`/resources/images/${i}.jpg`);
      }
    }
    return {
      images,
      current: 0,
      timer: null,
  interval: 3000,
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
    },
    prev() {
      this.current = (this.current - 1 + this.images.length) % this.images.length;
    },
    goTo(i) {
      this.current = i;
    },
  },
};
</script>

.style-placeholder {}
<style>
/* Component styles */
.home-page { padding: 1rem; }
/* Carousel styles */
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

/* Cards layout for mission/vision */
.cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; max-width: 1100px; margin: 2rem auto 4rem; padding: 0 1rem; }
.card { padding: 1.25rem 1.5rem; min-height: 160px; display:flex; flex-direction:column; justify-content:center; }
.card h2 { margin-bottom: 0.6rem; }

.accreditation-card { grid-column: 1 / -1; padding-bottom: 1.5rem; }

@media (max-width: 800px) {
  .cards { grid-template-columns: 1fr; }
}

/* When Home is active, hide the sidebar and center main content */
body.home-no-sidebar .main-container { grid-template-columns: 1fr !important; max-width: 900px; margin: 0 auto; }
body.home-no-sidebar .sidebar { display: none !important; }
body.home-no-sidebar .content { padding: 0; }

/* FINANCE TRAINING UNIT band */
.ftu-band { display:block; width:100%; background: linear-gradient(90deg, #001f6b 0%, #004aad 50%, #0066cc 100%); color: #fff; padding: 28px 0; border-radius: 12px; max-width: 980px; margin: 0 auto 1.5rem; box-shadow: 0 12px 30px rgba(0,32,78,0.35); }
.ftu-container { display:flex; align-items:center; justify-content:space-between; gap: 1rem; padding: 0 1rem; }
.ftu-title h2 { margin:0; font-size: 1.8rem; letter-spacing: 1px; font-weight: 700; text-transform: uppercase; color: #fff; text-shadow: 0 2px 12px rgba(0,0,0,0.45); }
.ftu-sub { margin:6px 0 0; opacity:0.95; font-size: 0.95rem; max-width:700px; }
.ftu-actions { display:flex; align-items:center; gap:0.75rem; }
.ftu-cta { background: #4bb4e8; color: #eff1f5; padding: 0.5rem 0.9rem; border-radius: 8px; text-decoration:none; font-weight:700; box-shadow: 0 6px 18px rgba(3, 39, 90, 0.18); transition: transform 0.12s ease, box-shadow 0.12s ease; }
.ftu-cta:hover { transform: translateY(-3px); box-shadow: 0 12px 28px rgba(3,39,90,0.25); }

@media (max-width: 800px) {
  .ftu-container { flex-direction: column; align-items:flex-start; }
  .ftu-title h2 { font-size: 1.5rem; }
  .ftu-sub { font-size: 0.9rem; }
  .ftu-band { padding: 20px 0; }
}

/* Accreditation aside inside mission card */
.accreditation { display:flex; gap:12px; align-items:flex-start; margin-top: .2rem; background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border-radius: 12px; padding: 12px; box-shadow: inset 0 1px 0 rgba(255,255,255,0.02); }
.accredit-badge { min-width:56px; height:56px; border-radius:8px; background: linear-gradient(180deg,#00204f,#004aad); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800; letter-spacing:1px; box-shadow: 0 6px 18px rgba(1,30,70,0.2); }
.accredit-copy { display:flex; flex-direction:column; }
.accredit-copy strong { color: #001f6b; background: #ffd; padding: 2px 6px; border-radius: 6px; font-size: 2rem; margin-bottom:6px; }
.accredit-text { font-size: 1.2rem; color: #333; margin-bottom:6px; }
.accredit-link { font-weight:700; color:#004aad; text-decoration:underline; font-size:0.92rem; }

.accredit-thumb-link { margin-left: 12px; display:inline-block; align-self:center; }
.accredit-thumb { width:110px; height:70px; object-fit:cover; border-radius:8px; border:1px solid rgba(0,0,0,0.06); box-shadow: 0 6px 18px rgba(0,0,0,0.08); }

@media (max-width: 600px) {
  .accreditation { flex-direction: column; align-items:flex-start; }
  .accredit-badge { min-width:44px; height:44px; }
}

/* Accreditation card layout: text left, image right */
.accreditation-wrapper { display:flex; gap:18px; align-items:flex-start; justify-content:space-between; }
.accredit-image img { width:260px; height:auto; max-width:36%; border-radius:10px; box-shadow: 0 12px 30px rgba(0,0,0,0.12); border:1px solid rgba(0,0,0,0.06); }

@media (max-width: 900px) {
  .accredit-image img { max-width:40%; }
}

@media (max-width: 700px) {
  .accreditation-wrapper { flex-direction: column; }
  .accredit-image img { max-width:100%; width:100%; }
}

/* Ensure FTU background logo centers on Home page when we forcibly hide the sidebar.
   The global App.vue positions the big translucent logo using:
       left: calc(50% + (var(--sidebar-width, 0px) * 0.5));
   Because the sidebar is only hidden with the body.home-no-sidebar class (not by disabling showSidebar),
   .app-root still has .has-sidebar which sets --sidebar-width:250px and shifts the logo right.
   We neutralize that here so Home matches About and other non-sidebar pages. */
body.home-no-sidebar .app-root.has-sidebar { --sidebar-width: 0px; }

</style>
 