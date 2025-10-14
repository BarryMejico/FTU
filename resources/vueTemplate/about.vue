<script setup>
import { ref } from 'vue';
import accreditationImg from '../images/accreditation.jpg';
import ftuActivationImg from '../images/ftu_activation.jpeg';
import ftuLogo from '../images/ftu_logo.png';
import backgroundCampus from '../images/8.jpg';
// Intersection Observer for scroll reveal (Functions list)

const showImageOverlay = ref(false);
const showActivationOverlay = ref(false);

const openImageOverlay = () => {
    showImageOverlay.value = true;
};
const closeImageOverlay = () => {
    showImageOverlay.value = false;
};
const openActivationOverlay = () => {
    showActivationOverlay.value = true;
};
const closeActivationOverlay = () => {
    showActivationOverlay.value = false;
};

// Scroll reveal for functions list
import { onMounted, onBeforeUnmount } from 'vue';
const functionsList = ref(null);
let fnObserver;
onMounted(() => {
    if (functionsList.value) {
        const items = functionsList.value.querySelectorAll('.fn-item');
        fnObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    fnObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.35 });
        items.forEach((el, i) => {
            el.style.setProperty('--fn-delay', `${i * 120}ms`);
            fnObserver.observe(el);
        });
    }
    // Enhanced generic card fade observer (re-animates on scroll, child stagger)
    const fadeTargets = document.querySelectorAll('.fade-card');
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const card = entry.target;
            if (entry.isIntersecting) {
                card.classList.add('fade-in');
            } else {
                card.classList.remove('fade-in');
            }
        });
    }, { threshold: 0.30 });

    fadeTargets.forEach(card => {
        // Variable offset & duration via data attributes
        const off = card.getAttribute('data-fade-offset');
        if (off) card.style.setProperty('--fade-offset', off + 'px');
        const dur = card.getAttribute('data-fade-duration');
        if (dur) card.style.setProperty('--fade-duration', dur + 'ms');
        const shadowFinal = card.getAttribute('data-fade-shadow');
        if (shadowFinal) card.style.setProperty('--fade-shadow-final', shadowFinal);

        // Prepare child stagger (paragraphs, list items, direct child divs with data-fade-child)
        const children = card.querySelectorAll('[data-fade-child], p, li');
        children.forEach((child, idx) => {
            child.classList.add('fade-child');
            child.style.setProperty('--fade-child-delay', (idx * 90) + 'ms');
        });
        fadeObserver.observe(card);
    });
});
onBeforeUnmount(() => { if (fnObserver) fnObserver.disconnect(); });

</script>

<template>
    <div class="about-page" :style="{'--about-bg-image': `url(${backgroundCampus})`}">
        <!-- Enhanced, centered hero title section -->
        <div class="about-hero-title" aria-label="Finance Training Unit">
            <div class="crest" aria-hidden="true">
                <span class="crest-bg"></span>
                <span class="crest-ring"></span>
                <img :src="ftuLogo" alt="FTU Logo" class="crest-logo" loading="lazy" />
            </div>
            <h1 class="about-title">
                <span class="about-title-main sparkle-enabled dual-sweep">Finance Training Unit
                    <span class="sparkle s1"></span>
                    <span class="sparkle s2"></span>
                    <span class="sparkle s3"></span>
                </span>
                <span class="about-title-tagline">Excellence in Military Financial Education</span>
            </h1>
        </div>

    <div class="activation-image-row fade-card" data-fade-offset="46" data-fade-duration="900" data-fade-shadow="0 14px 36px -10px rgba(0,40,90,.28)">
            <div class="activation-image-col">
                <img 
                    :src="ftuActivationImg" 
                    alt="FTU Activation" 
                    class="activation-img" 
                    @click="openActivationOverlay"
                    onerror="this.onerror=null;this.src='../images/accreditation.jpg'" 
                />
            </div>
            <div class="activation-details card">
                <h1 class="activation-title">The Activation of the Finance Training Unit</h1>
                <h2  style="text-align: center;">HPN General Orders #638 dated 05 November 2020</h2>
                <ul style="list-style:none;padding:0;color:#333;font-size:1.4rem;margin-bottom: 20px;">
                    <li style="margin-bottom:18px;">
                        <span style="font-size:1.5rem;margin-right:8px;">&#x25A3;</span>
                        Section I - Finance Training Unit is hereby activated as of 16 October 2020
                    </li>
                    <li>
                        <span style="font-size:1.5rem;margin-right:8px;">&#x25A3;</span>
                        Section II - Finance Training Unit is hereby assigned to the Philippine Navy Finance Center effective as of 16 October 2020
                    </li>
                </ul>
            </div>
        </div>

            <div class="about-accredit-row fade-card" data-fade-offset="50" data-fade-duration="950" data-fade-shadow="0 16px 42px -12px rgba(0,50,110,.30)">
                <div class="aboutus card accreditation-card" id="accreditation">
                    <div class="accreditation" role="status" aria-label="Accreditation summary">
                        <div class="accredit-copy">
                            <strong> The Finance Training Unit (FTU) is Accredited (Secondary Level)</strong>
                            <div class="accredit-text">
                                The Finance Training Unit (FTU) is accredited as a Secondary Armed Forces of the Philippines Education & Training Institution effective 16 July 2024.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-accredit-img">
                    <img 
                        :src="accreditationImg" 
                        alt="FTU Accreditation scan" 
                        @click="openImageOverlay"
                        onerror="this.onerror=null;this.src='/docs/accreditation-placeholder.svg'" 
                    />
                </div>
            </div>


        <!-- Image Overlay Modal -->
        <div v-if="showImageOverlay" class="image-overlay" @click="closeImageOverlay">
            <div class="overlay-content">
                <img 
                    :src="accreditationImg" 
                    alt="FTU Accreditation scan enlarged"
                    class="overlay-image"
                />
                <button class="close-btn" @click="closeImageOverlay">&times;</button>
            </div>
        </div>

        <!-- Activation Image Overlay Modal -->
        <div v-if="showActivationOverlay" class="image-overlay" @click="closeActivationOverlay">
            <div class="overlay-content">
                <img 
                    :src="ftuActivationImg" 
                    alt="FTU Activation image enlarged"
                    class="overlay-image"
                />
                <button class="close-btn" @click="closeActivationOverlay">&times;</button>
            </div>
        </div>

        <!-- Philosophy Section -->
    <section id="philosophy" class="philosophy-section fade-card" aria-labelledby="philosophy-heading" data-fade-offset="60" data-fade-duration="1000" data-fade-shadow="0 18px 48px -14px rgba(10,30,60,.32)">
            <div class="philosophy-header">
                <h2 id="philosophy-heading">PHILOSOPHY</h2>
                <img :src="ftuLogo" alt="Finance Training Unit Logo" class="philosophy-logo" />
            </div>
            <div class="philosophy-body">
                <div class="philosophy-watermark" aria-hidden="true">
                    <img :src="ftuLogo" alt="" />
                </div>
                <p>
                    It is our belief, through the Finance Training Unit, a competent and capable Budget, Fiscal and Finance (BFF) Education and Training Administrator will produce motivated, excellent and highly-skilled BFF Professionals for the Philippine Navy. This will be attained by providing essential courses, training and services that creates opportunities for learning, support literacy and education, and help shape the new ideas and perspectives that are central to a creative and innovative organization. Also, FTU believes that every BFF Professional matters and deserves a first-hand education, training and information dissemination to get the best chance in growing and climbing the ladder of success.
                </p>
                <p>
                    As an Education and Training Unit, the school prepares individual on how to become a BFF Professional. For the lessons, the unit creates meaningful, practical and engaging activities for effective learning, integrating experience, expertise and theory. The Faculty ensures that passionate teaching will be transmittable and inspiring to any BFF Professional, so they can connect to the subject matter or lesson topic in absorbing it effectively. Moreover, learning occurs if the student fully engaged in the process and makes a personal connection with the information being taught and apply it accordingly. Lastly, by enthusiastically motivating and engaging the learners in delightful topics and using technology for adaptive schemes that addresses individual's learning style.
                </p>
            </div>
        </section>

        <!-- Functions Section -->
    <section id="functions" class="functions-section fade-card" aria-labelledby="functions-heading" data-fade-offset="60" data-fade-duration="1050" data-fade-shadow="0 20px 56px -16px rgba(10,35,70,.35)">
            <div class="functions-header">
                <h2 id="functions-heading">FUNCTIONS</h2>
                <img :src="ftuLogo" alt="Finance Training Unit Logo" class="functions-logo" />
            </div>
            <div class="functions-body">
                <div class="functions-watermark" aria-hidden="true">
                    <img :src="ftuLogo" alt="" />
                </div>
                <ul class="functions-list" ref="functionsList">
                    <li class="fn-item">Develop, publish and evaluate sound BFF Curriculum, Tactics, Techniques and Procedures (TTPs) and Doctrines in the Philippine Navy;</li>
                    <li class="fn-item">To administer the conduct of basic, advance and refresher courses.</li>
                    <li class="fn-item">To develop and revise curricula of Budget, Fiscal and Finance related courses.</li>
                </ul>
            </div>
        </section>

    </div> 
</template>

<style>
.about-page { 
    padding: 1rem; 
    max-width: 1100px; 
    margin: 0 auto; 
    position: relative; 
    z-index: 0; 
    --ftu-accent-dark: #09142a; /* unified dark accent color */
}
/* Layered immersive academic background */
.about-page:before, .about-page:after { 
    content: ""; 
    position: fixed; 
    inset: 0; 
    z-index: -2; 
    pointer-events: none; 
}
/* Light variant background with subtle academic motifs */
.about-page:before { 
    background:
        linear-gradient(120deg, rgba(230,238,249,0.94) 0%, rgba(219,232,247,0.92) 40%, rgba(201,220,242,0.90) 70%, rgba(230,238,249,0.94) 100%),
        var(--about-bg-image) center/cover no-repeat; /* underlying image */
    filter: saturate(108%) brightness(1.02);
    animation: aboutBgFade 1.4s ease-in;
}
.about-page:after { 
    background-image: 
        repeating-linear-gradient(0deg, rgba(40,70,140,0.06) 0 1px, transparent 1px 42px), /* horizontal lines */
        repeating-linear-gradient(90deg, rgba(40,70,140,0.045) 0 1px, transparent 1px 42px), /* vertical lines */
        repeating-linear-gradient(135deg, rgba(40,70,140,0.04) 0 2px, transparent 2px 18px), /* diagonal faint */
        radial-gradient(circle at 55% 40%, rgba(255,255,255,0.55), rgba(255,255,255,0) 60%); /* soft glow */
    background-size: 100% 100%, 100% 100%, 100% 100%, cover;
    background-position: center; 
    mix-blend-mode: normal; 
    opacity: .85; 
    z-index: -1; 
    mask: linear-gradient(to bottom, rgba(255,255,255,0.9), rgba(255,255,255,0.9));
}
/* Optional subtle vignette */
body:before { 
    content:""; 
    position: fixed; inset:0; pointer-events:none; 
    background: radial-gradient(circle at center, rgba(255,255,255,0) 55%, rgba(180,200,230,.35)); 
    z-index:-3; 
    mix-blend-mode: multiply; 
}
.accreditation-card { padding-bottom: 1.5rem; }

/* =============================
   HERO TITLE / CREST STYLING
   ============================= */
.about-hero-title { 
    text-align: center; 
    margin: 1.5rem auto 2.8rem; 
    position: relative; 
    max-width: 940px; 
    padding: 1rem 1rem 2.2rem; 
}
.about-hero-title:after { /* subtle animated underline */
    content: ""; 
    position: absolute; 
    left: 50%; 
    transform: translateX(-50%); 
    bottom: 0.9rem; 
    width: 68%; 
    height: 6px; 
    background: linear-gradient(90deg,#0d1b4d,#1d63c0,#45b4ff,#1d63c0,#0d1b4d); 
    background-size: 220% 100%;
    border-radius: 20px; 
    animation: underlineFlow 9s ease-in-out infinite; 
    box-shadow: 0 4px 14px -2px rgba(0,0,0,.25), 0 0 0 1px rgba(255,255,255,.15) inset; 
}
.about-title { margin:0; position:relative; }
.about-title-main { 
    display:block; 
    font-size: clamp(2.3rem, 5vw, 3.8rem); 
    font-weight: 800; 
    letter-spacing: .5px; 
    line-height: 1.05; 
    /* Balanced mid-tone gradient: deep to medium navy, refined gold accent */
    /* Refined gradient: narrow white highlight with cool edge tint */
    background: linear-gradient(112deg,
        #0f2547 0%,
        #163c6c 18%,
        #1d548f 36%,
        #2264a3 50%,
        #1d548f 60%,
        #e6f2ff 70%, /* soft blue-tinted pre-glow */
        #ffffff 73%, /* narrow bright white core */
        #d8e9ff 76%, /* soft blue fade out */
        #1a3354 86%,
        #0f2547 100%
    );
    background-size: 190% 100%;
    background-clip: text; 
    -webkit-background-clip: text; 
    color: transparent; 
    filter: drop-shadow(0 5px 14px rgba(10,40,85,.42)) drop-shadow(0 2px 3px rgba(0,0,0,.55));
    animation: titleSheen 8.5s linear infinite; 
}
.about-title-main { position: relative; }
/* Shine effect: one initial sweep; faster sweep on hover */
.about-title-main:after { 
    content: ""; 
    position: absolute; 
    top: 0; 
    left: -20%; 
    width: 18%; 
    height: 100%; 
    background: linear-gradient(75deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.35) 40%, rgba(255,255,255,0.9) 50%, rgba(255,255,255,0.35) 60%, rgba(255,255,255,0) 100%); 
    transform: skewX(-18deg); 
    filter: blur(.8px) brightness(1.18); 
    opacity: 0; 
    animation: shineSweep 4.2s ease-in-out 0.6s 1 forwards; 
    pointer-events: none; 
}
@keyframes shineSweep { 
    0% { left: -25%; opacity: 0; }
    8% { opacity: .85; }
    18% { left: 110%; opacity: 0; }
    100% { left: 110%; opacity: 0; }
}
.about-title-main:hover:after { 
    animation: shineSweepHover 2.3s ease-in-out 0s infinite; 
}
@keyframes shineSweepHover { 
    0% { left: -25%; opacity: 0; }
    10% { opacity: .95; }
    55% { left: 110%; opacity: 0; }
    100% { left: 110%; opacity: 0; }
}
/* Inner glow behind highlight */
.about-title-main:before {
    content:"";
    position:absolute;
    inset:0;
    background:radial-gradient(circle at 62% 48%, rgba(255,255,255,0.35), rgba(255,255,255,0) 55%);
    mix-blend-mode:screen;
    opacity:.0;
    transition:opacity .5s ease;
    pointer-events:none;
}
.about-title-main:hover:before { opacity:.55; }
/* Sparkle particles */
.about-title-main .sparkle { display:none; }
.about-title-main.sparkle-enabled { position:relative; }
.about-title-main.sparkle-enabled .sparkle { 
    position:absolute; 
    width:6px; height:6px; 
    background: radial-gradient(circle,#ffffff 0%, #b9d9ff 55%, rgba(255,255,255,0) 72%); 
    border-radius:50%; 
    display:block; 
    pointer-events:none; 
    animation: sparklePop 2.4s linear infinite; 
    opacity:0; filter:brightness(.9); 
}
.about-title-main.sparkle-enabled .sparkle.s2 { animation-delay:.6s; }
.about-title-main.sparkle-enabled .sparkle.s3 { animation-delay:1.2s; }
@keyframes sparklePop { 
    0% { transform:translate(10%,60%) scale(.2); opacity:0; }
    8% { opacity:1; }
    18% { transform:translate(120%,10%) scale(1); opacity:0; }
    100% { opacity:0; }
}
.about-title-main:hover.sparkle-enabled .sparkle { animation-duration:1.6s; }
@media (max-width: 520px) { .about-title-main.sparkle-enabled .sparkle { display:none; } }
/* Reflection line under title */
.title-reflection { 
        position:absolute; left:50%; transform:translateX(-50%); bottom:-10px; 
        width:72%; height:40px; pointer-events:none; opacity:.32; 
        background: radial-gradient(ellipse at center, rgba(255,255,255,.55) 0%, rgba(255,255,255,.15) 28%, rgba(255,255,255,0) 70%); 
        filter: blur(8px); 
}
.about-title:hover + .title-reflection, .about-title:focus-within + .title-reflection { opacity:.55; }
/* Dual sweep variant */
.about-title-main.dual-sweep:hover:after { animation: dualSweep 2.6s ease-in-out 0s infinite; }
@keyframes dualSweep { 
    0% { left:-30%; opacity:0; background:linear-gradient(75deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.4) 40%, rgba(255,255,255,.95) 50%, rgba(255,255,255,.4) 60%, rgba(255,255,255,0) 100%);} 
    25% { opacity:.95; }
    40% { left:110%; opacity:0; }
    41% { left:-30%; opacity:0; background:linear-gradient(75deg, rgba(255,223,120,0) 0%, rgba(255,223,120,.45) 40%, rgba(255,255,255,.95) 50%, rgba(255,223,120,.45) 60%, rgba(255,223,120,0) 100%);} 
    65% { opacity:.95; }
    80% { left:110%; opacity:0; }
    100% { left:110%; opacity:0; }
}
/* Utility classes to reuse shine elsewhere */
.shine-heading { position:relative; display:inline-block; }
.shine-heading:after { 
  content:""; position:absolute; top:0; left:-25%; height:100%; width:18%; 
  background:linear-gradient(75deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.4) 45%, rgba(255,255,255,.9) 52%, rgba(255,255,255,.4) 60%, rgba(255,255,255,0) 100%);
  transform:skewX(-18deg); opacity:0; pointer-events:none; 
}
.shine-heading.shine-once:after { animation: shineSweep 4.2s ease 0.4s 1 forwards; }
.shine-heading.shine-hover:hover:after { animation: shineSweepHover 2.3s ease 0s 1 forwards; }
@media (prefers-reduced-motion: reduce) {
  .shine-heading:after, .about-title-main:before { animation:none; opacity:0; }
}
@media (prefers-reduced-motion: reduce) {
  .about-title-main:after { animation: none; opacity:0; }
}
.about-title-tagline { 
    display:block; 
    font-size: clamp(.85rem, 1.3vw, 1.05rem); 
    letter-spacing: 3px; 
    text-transform: uppercase; 
    margin-top: .9rem; 
    font-weight: 600; 
    color: #1f365e; 
    position: relative; 
    opacity: .92; 
}

/* Crest (abstract academic / naval shield) */
.crest { 
    position: relative; 
    width: 120px; 
    height: 120px; 
    margin: 0 auto 1.2rem; 
    font-family: 'Segoe UI', system-ui, sans-serif; 
}
.crest-bg { 
    position:absolute; inset:0; 
    background: radial-gradient(circle at 30% 30%, #2c69c9, #0d1b4d 70%); 
    border-radius: 28% 28% 40% 40% / 38% 38% 62% 62%; 
    box-shadow: 0 10px 28px -6px rgba(0,0,0,.45), 0 0 0 1px rgba(255,255,255,.15) inset; 
    animation: crestPulse 7s ease-in-out infinite; 
}
.crest-ring { 
    position:absolute; inset:5px; 
    border: 3px solid rgba(255,255,255,.35); 
    border-radius: inherit; 
    backdrop-filter: blur(3px); 
    animation: ringRotate 18s linear infinite; 
    mask: radial-gradient(circle at center, transparent 58%, #000 60%); 
}
.crest-text { 
    position:absolute; inset:0; 
    display:flex; align-items:center; justify-content:center; 
    font-weight: 700; 
    font-size: 1.9rem; 
    letter-spacing: 1px; 
    color:#ffffff; 
    text-shadow: 0 4px 14px rgba(0,0,0,.5); 
}
.crest-logo { 
    position:absolute; inset:10%; 
    width:80%; height:80%; object-fit:contain; 
    filter: drop-shadow(0 4px 10px rgba(0,0,0,.5));
    animation: crestLogoFloat 8s ease-in-out infinite; 
}
@keyframes crestLogoFloat { 
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}

@keyframes titleSheen { 
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes underlineFlow { 
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes crestPulse { 
    0%, 100% { transform: translateY(0) scale(1); filter: brightness(1); }
    50% { transform: translateY(-4px) scale(1.035); filter: brightness(1.15); }
}
@keyframes ringRotate { 
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
@keyframes aboutBgFade {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Motion reduction */
@media (prefers-reduced-motion: reduce) {
    .about-title-main, .about-hero-title:after { animation: none; }
    .crest-bg, .crest-ring { animation: none; }
}

/* Reuse common classes from Home.vue. If About does not load Home styles, this ensures minimal layout */
.aboutus { background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); padding: 1rem 1rem; text-align: center; font-size: 1.1rem; position: relative; overflow: hidden; }
.aboutus h2 { color: #333; margin-bottom: 10px; }
.accreditation-wrapper { display:flex; gap:18px; align-items:flex-start; justify-content:space-between; }
.accreditation { display:flex; gap:12px; align-items:flex-start; margin-top: .2rem; background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border-radius: 12px; padding: 12px; box-shadow: inset 0 1px 0 rgba(255,255,255,0.02); }
.accredit-copy { padding-top: 20px; padding-bottom: 50px; }
.accredit-copy strong { color: #e3e8f2; background: var(--ftu-accent-dark); padding: 2px 6px; border-radius: 6px; font-size: 2rem; margin-bottom:6px; display:inline-block; }
.accredit-text { font-size: 25px; color: #333; margin-bottom:6px; margin-top: 50px; }
.accredit-link { display:none; }
.accredit-image img { width:260px; height:auto; max-width:36%; border-radius:10px; box-shadow: 0 12px 30px rgba(0,0,0,0.12); border:1px solid rgba(0,0,0,0.06); }

.activation-image-row {
    display: flex;
    gap: 32px;
    align-items: stretch;
    justify-content: flex-start;
    margin-bottom: 2rem;
}
.activation-image-col {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 320px;
    max-width: 320px;
}
.activation-details.card {
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    padding: 1rem 1rem;
    font-size: 1.1rem;
    position: relative;
    overflow: hidden;

    width: 100%;
}
.activation-details h2 {
    color: #333;
    margin-bottom: 10px;
}
.activation-details ul {
    color: #333;
}
.activation-title {
    color: #e3e8f2;
    background: var(--ftu-accent-dark);
    padding: 2px 6px;
    border-radius: 6px;
    font-size: 2rem;
    margin-bottom: 40px;
    display: inline-block;
    text-align: center;
}

/* Ensure accreditation layout shows image on the right of the card */
.about-accredit-row {
    display: flex;
    gap: 32px;
    align-items: stretch;
    justify-content: flex-start;
    margin-top: 2rem;
}
.about-accredit-img {
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    min-width: 260px;
}
/* Apply sizing and styling to the About page image */
/* Improved image sizing for consistent card alignment */
.about-accredit-img img {
    max-width: 260px;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    border: 1px solid rgba(0,0,0,0.06);
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
}

/* Hover effect for original image */
.about-accredit-img img:hover {
    transform: scale(1.05);
    box-shadow: 0 16px 40px rgba(0,0,0,0.18);
}

/* Activation image styles - same as accreditation image for consistency */
.activation-img {
    max-width: 320px;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    border: 1px solid rgba(0,0,0,0.06);
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
}

.activation-img:hover {
    transform: scale(1.05);
    box-shadow: 0 16px 40px rgba(0,0,0,0.18);
}


/* Image Overlay Modal Styles */
.image-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    animation: fadeIn 0.3s ease-in-out;
}

.overlay-content {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.overlay-image {
    max-width: 500px;
    width: 100%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    border: 2px solid rgba(255,255,255,0.2);
    animation: zoomIn 0.3s ease-in-out;
}

.close-btn {
    position: absolute;
    top: -15px;
    right: -15px;
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.2s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.close-btn:hover {
    background-color: #ff5757;
    color: white;
    transform: scale(1.1);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes zoomIn {
    from { 
        opacity: 0;
        transform: scale(0.5);
    }
    to { 
        opacity: 1;
        transform: scale(1);
    }
}
/* Stack on small screens */
@media (max-width: 700px) {
    .about-accredit-row { flex-direction: column; }
    .about-accredit-img { justify-content: flex-start; }
    .about-accredit-img img { max-width: 100%; width: 100%; }
    .about-hero-title { margin: 1rem auto 2.2rem; padding-bottom: 1.8rem; }
    .crest { width: 92px; height: 92px; }
    .about-title-tagline { letter-spacing: 2px; }
}

/* =============================
   PHILOSOPHY SECTION
   ============================= */
.philosophy-section { 
    margin: 4rem 0 3rem; 
    position: relative; 
    background: #f4f4f6ee; 
    border-radius: 14px; 
    overflow: hidden; 
    box-shadow: 0 8px 24px -6px rgba(0,0,0,.18);
}
.philosophy-header { 
    background: var(--ftu-accent-dark); 
    padding: 1.4rem 1.6rem 1.1rem; 
    display: flex; 
    align-items: center; 
    justify-content: space-between; 
    gap: 1rem; 
}
.philosophy-header h2 { 
    font-size: clamp(2.3rem, 5vw, 4.2rem); 
    font-weight: 800; 
    letter-spacing: 4px; 
    margin: 0; 
    color: #ffffff; 
}
.philosophy-logo { width: 110px; height: auto; filter: drop-shadow(0 4px 10px rgba(0,0,0,.4)); }
.philosophy-body { 
    padding: 2.2rem 2.4rem 2.8rem; 
    font-size: 1.08rem; 
    line-height: 1.6; 
    letter-spacing: .4px; 
    color: #171e2b;
    position: relative; 
    z-index: 1;
}
.philosophy-body p { margin: 0 0 1.4rem; text-indent: 2.2rem; }
.philosophy-watermark { 
    position: absolute; 
    inset: 0; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    pointer-events: none; 
    opacity: .06; 
    mix-blend-mode: multiply; 
}
.philosophy-watermark img { 
    max-width: 76%; 
    height: auto; 
    filter: grayscale(10%) brightness(1.05); 
}
@media (max-width: 800px) { 
    .philosophy-header h2 { font-size: clamp(2rem, 7vw, 3.2rem); letter-spacing:2px; }
    .philosophy-logo { width: 82px; }
    .philosophy-body { padding: 1.6rem 1.4rem 2rem; font-size: 1rem; }
}

/* =============================
   FUNCTIONS SECTION
   ============================= */
.functions-section { 
    margin: 4rem 0 3rem; 
    position: relative; 
    background: #f4f5f8fc; 
    border-radius: 14px; 
    overflow: hidden; 
    box-shadow: 0 8px 24px -6px rgba(0,0,0,.18);
}
.functions-header { 
    background: var(--ftu-accent-dark); 
    padding: 1.35rem 1.6rem 1.05rem; 
    display:flex; align-items:center; justify-content:space-between; gap:1rem; 
}
.functions-header h2 { 
    font-size: clamp(2.2rem, 5vw, 4rem); 
    font-weight: 800; 
    letter-spacing: 4px; 
    margin:0; color:#fff; 
}
.functions-logo { width: 110px; height:auto; filter: drop-shadow(0 4px 10px rgba(0,0,0,.4)); }
.functions-body { position:relative; padding:2.2rem 2.6rem 2.6rem; }
.functions-watermark { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; opacity:.05; mix-blend-mode:multiply; pointer-events:none; }
.functions-watermark img { max-width:78%; filter: grayscale(15%) brightness(1.08); }
.functions-list { list-style: none; margin:0; padding:0; display:flex; flex-direction:column; gap:1.8rem; font-size:1.55rem; line-height:1.5; color:#0b2c55; }
.functions-list .fn-item { position:relative; padding-left:2.2rem; font-weight:500; letter-spacing:.5px; opacity:0; transform: translateY(24px) scale(.96); filter:blur(6px); transition: opacity .8s ease, transform .8s cubic-bezier(.22,.8,.32,1), filter .9s ease; }
.functions-list .fn-item:before { content:""; position:absolute; left:.1rem; top:.6rem; width:14px; height:14px; background: radial-gradient(circle at 30% 30%, #d4ac38, #9b7a17); border-radius:50%; box-shadow:0 0 0 4px rgba(212,172,56,.25),0 4px 10px -2px rgba(0,0,0,.4); }
.functions-list .fn-item.in { opacity:1; transform: translateY(0) scale(1); filter:blur(0); transition-delay: var(--fn-delay, 0ms); }
.functions-list .fn-item.in:before { animation: pulseDot 2.8s ease-in-out infinite; }
@keyframes pulseDot { 0%,100% { transform:scale(1); box-shadow:0 0 0 4px rgba(212,172,56,.25),0 4px 10px -2px rgba(0,0,0,.4);} 50% { transform:scale(1.25); box-shadow:0 0 0 6px rgba(212,172,56,.15),0 6px 16px -2px rgba(0,0,0,.45);} }
@media (max-width: 900px) { .functions-list { font-size:1.25rem; } .functions-body { padding:1.8rem 1.4rem 2.2rem; } .functions-logo { width:82px; } }
@media (max-width: 540px) { .functions-list { font-size:1.05rem; gap:1.3rem; } .functions-list .fn-item { padding-left:1.9rem; } }

/* =============================
   GENERIC CARD FADE (Enhanced)
   ============================= */
.fade-card { 
    --fade-offset: 40px; 
    --fade-duration: 850ms; 
    --fade-shadow-final: 0 12px 34px -10px rgba(0,40,90,.25); 
    opacity: 0; 
    transform: translateY(var(--fade-offset)) scale(.97); 
    transition: opacity var(--fade-duration) ease, transform var(--fade-duration) cubic-bezier(.22,.8,.32,1), box-shadow 900ms ease; 
    will-change: opacity, transform; 
    box-shadow: 0 6px 20px -12px rgba(0,0,0,.22);
}
.fade-card.fade-in { 
    opacity: 1; 
    transform: translateY(0) scale(1); 
    box-shadow: var(--fade-shadow-final);
}
/* Child stagger inside cards */
.fade-child { 
    opacity: 0; 
    transform: translateY(18px); 
    transition: opacity 700ms ease, transform 700ms cubic-bezier(.25,.75,.3,1); 
}
.fade-card.fade-in .fade-child { 
    opacity: 1; 
    transform: translateY(0); 
    transition-delay: var(--fade-child-delay, 0ms); 
}
@media (prefers-reduced-motion: reduce) {
  .fade-card { transition: opacity .6s ease; transform:none !important; box-shadow: var(--fade-shadow-final); }
  .fade-child { transition: opacity .5s ease; transform:none !important; }
}
</style>