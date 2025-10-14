<template>
    <div class="app-sidebar" :class="{ collapsed: isCollapsed, open: isToggled }">
        <aside class="sidebar" :class="{ collapsed: isCollapsed, open: isToggled }" ref="sidebar">
            <header class="sidebar-header">
                <div class="actions">
                    <!-- header collapse control removed; edge-centered control used instead -->
                </div>
            </header>

            <nav class="menu" ref="menuRoot">
                <ul>
                    <li class="menu-section"><span class="menu-title">Menu</span></li>
                    <!-- Static Dashboard link -->
                    <li class="menu-item">
                        <router-link class="menu-link dashboard-link" to="/dashboard">
                            <span class="icon"><i class="ri-dashboard-line"></i></span>
                            <span class="title">Dashboard</span>
                        </router-link>
                    </li>
                    <!-- Files link -->
                    <li class="menu-item">
                        <router-link class="menu-link files-link" to="/files">
                            <span class="icon"><i class="ri-folder-3-line"></i></span>
                            <span class="title">Files</span>
                        </router-link>
                    </li>
                    <!-- Courses link -->
                    <li class="menu-item">
                        <router-link class="menu-link courses-link" to="/courses">
                            <span class="icon"><i class="ri-book-2-line"></i></span>
                            <span class="title">Courses</span>
                        </router-link>
                    </li>
                                <li v-for="(item, idx) in topLevelTools" :key="item.id || idx" class="menu-item" :class="{ hasChildren: childItems(item.id).length, open: !!openMenus[idx] }">
                                    <!-- if the item has children, render a toggleable section -->
                                    <template v-if="childItems(item.id).length">
                                        <div
                                            class="menu-link"
                                            role="button"
                                            tabindex="0"
                                            :aria-expanded="!!openMenus[idx]"
                                            @click="onTopMenuClick(idx)"
                                            @keydown.enter.prevent="onTopMenuClick(idx)"
                                            @keydown.space.prevent="onTopMenuClick(idx)"
                                            @mouseenter="onTopMenuHover(idx)"
                                            @mouseleave="onTopMenuLeave(idx)"
                                        >
                                            <span class="icon"><i class="ri-folder-3-line"></i></span>
                                            <span class="title">{{ item.Description }}</span>
                                            <span class="caret"><i class="ri-arrow-right-s-line"></i></span>
                                        </div>

                                        <transition name="submenu" @enter="onEnter" @leave="onLeave">
                                            <ul v-show="!!openMenus[idx]" class="sub-list" role="menu">
                                                <li v-for="(sub, j) in childItems(item.id)" :key="sub.id || j" class="sub-item">
                                                    <router-link class="sub-link" :to="sub.slug || '#'">{{ sub.Description }}</router-link>
                                                </li>
                                            </ul>
                                        </transition>
                                    </template>

                                    <!-- if the item has no children, render as a direct link -->
                                    <template v-else>
                                        <router-link class="menu-link" :to="item.slug || '#'">
                                            <span class="icon"><i class="ri-file-text-line"></i></span>
                                            <span class="title">{{ item.Description }}</span>
                                        </router-link>
                                    </template>
                                </li>
                </ul>
            </nav>

            <!-- Edge-centered collapse button: sits centered on the right edge of the sidebar -->
            <button
                ref="edgeBtn"
                class="edge-collapse"
                :class="{ collapsed: isCollapsed }"
                @click="toggleCollapse"
                :aria-pressed="isCollapsed"
                :aria-label="isCollapsed ? 'Expand sidebar' : 'Collapse sidebar'"
            >
                <i :class="isCollapsed ? 'ri-arrow-right-s-line' : 'ri-arrow-left-s-line'"></i>
            </button>

            
        </aside>

        <div class="overlay" v-show="isToggled" @click="toggleToggled" aria-hidden="true"></div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick, watch, onUnmounted } from 'vue'
import { useMenus } from '../../Store/menu'
import { useUser } from '../../Store/user'
import { useUi } from '../../Store/ui'

const menu = useMenus()
const userStore = useUser()

const ui = useUi()
const isCollapsed = ref(ui.sidebarCollapsed)
const isToggled = ref(false)
const openMenus = ref([])
const menuRoot = ref(null)
const edgeBtn = ref(null)


const topLevelTools = computed(() => (menu && menu.menu ? menu.menu.filter((m) => m.menuParent === 'root') : []))
const childItems = (parentId) => (menu && menu.menu ? menu.menu.filter((m) => m.menuParent == parentId) : [])

const toggleCollapse = () => {
    isCollapsed.value = !isCollapsed.value
    if (isCollapsed.value) openMenus.value = topLevelTools.value.map(() => false)
}
const toggleToggled = () => (isToggled.value = !isToggled.value)

// sync with ui store
watch(isCollapsed, (val) => {
    ui.setSidebarCollapsed(val)
    if (val) openMenus.value = topLevelTools.value.map(() => false)
})

// when the collapsed state changes, realign the edge button (immediate + after CSS transition)
watch(isCollapsed, (val) => {
    // align after DOM updates
    nextTick(() => alignEdgeTopToMenu())
    // call again after transition time to snap final position (handles CSS width transition)
    setTimeout(() => alignEdgeTopToMenu(), 260)
})

// sync back if store is changed elsewhere (e.g., top nav button)
watch(() => ui.sidebarCollapsed, (val) => {
    if (isCollapsed.value !== val) isCollapsed.value = val
})

// position the edge button centered vertically along the sidebar's right edge
// (avoid aligning inline with the 'Menu' label so it doesn't overlap the text)
function alignEdgeTopToMenu() {
    if (!edgeBtn.value || !menuRoot.value) return
    // determine the sidebar container
    const sidebarEl = menuRoot.value.closest('.sidebar') || menuRoot.value.parentElement
    if (!sidebarEl) return
    const btnHeight = edgeBtn.value.offsetHeight || 40

    // Option B: vertical position equals the Menu title center (same horizontal line)
    const menuTitle = menuRoot.value.querySelector('.menu-section .menu-title')
    if (menuTitle) {
        const titleRect = menuTitle.getBoundingClientRect()
        const sidebarRect = sidebarEl.getBoundingClientRect()
        const relativeCenterY = (titleRect.top + titleRect.height / 2) - sidebarRect.top
        const top = relativeCenterY - btnHeight / 2
        edgeBtn.value.style.top = Math.max(top, 6) + 'px'
    } else {
        // fallback: center vertically in the sidebar
        const sidebarHeight = sidebarEl.clientHeight || sidebarEl.offsetHeight
        const top = sidebarHeight / 2 - btnHeight / 2
        edgeBtn.value.style.top = Math.max(top, 6) + 'px'
    }

    // always place the button at the sidebar right edge (slightly outside)
    const leftEdge = sidebarEl.clientWidth + 8
    edgeBtn.value.style.left = leftEdge + 'px'
    edgeBtn.value.style.transform = 'translate(-50%, -50%)'
}

// Smooth transition hooks (ensure height animation works)
function onEnter(el) {
    el.style.maxHeight = '0'
    el.style.opacity = '0'
    const h = el.scrollHeight
    requestAnimationFrame(() => {
        el.style.transition = 'max-height 240ms ease, opacity 240ms ease'
        el.style.maxHeight = h + 'px'
        el.style.opacity = '1'
    })
}
function onLeave(el) {
    el.style.maxHeight = el.scrollHeight + 'px'
    el.style.opacity = '1'
    requestAnimationFrame(() => {
        el.style.transition = 'max-height 240ms ease, opacity 240ms ease'
        el.style.maxHeight = '0'
        el.style.opacity = '0'
    })
}

const onTopMenuClick = async (idx) => {
    if (openMenus.value.length < topLevelTools.value.length) openMenus.value = topLevelTools.value.map(() => false)
    openMenus.value[idx] = !openMenus.value[idx]
    // close others
    openMenus.value = openMenus.value.map((v, i) => (i === idx ? v : false))
    await nextTick()
}

const onTopMenuHover = (idx) => {
    if (isCollapsed.value) return
}
const onTopMenuLeave = (idx) => {}

onMounted(() => {
    openMenus.value = topLevelTools.value.map(() => false)
    // initialize from ui store
    ui.initSidebar()
    isCollapsed.value = ui.sidebarCollapsed
    // align vertically with Menu row, keep horizontally centered on sidebar edge via CSS
    nextTick(() => {
        alignEdgeTopToMenu()
    })
    window.addEventListener('resize', alignEdgeTopToMenu)
    const sidebarEl = menuRoot.value
    if (sidebarEl) sidebarEl.addEventListener('scroll', alignEdgeTopToMenu, { passive: true })
})

onUnmounted(() => {
    window.removeEventListener('resize', alignEdgeTopToMenu)
    const sidebarEl = menuRoot.value
    if (sidebarEl) sidebarEl.removeEventListener('scroll', alignEdgeTopToMenu)
})

// keep openMenus in sync when menu data changes (e.g., loaded async)
watch(topLevelTools, (newVal) => {
    openMenus.value = newVal.map(() => false)
})

const userData = computed(() => (userStore ? userStore.userData : {}))
</script>

<style scoped>
/* Sidebar base */
.app-sidebar{ display:flex }
/* make the sidebar float on the left and respond to the wrapper classes */
.app-sidebar .sidebar{ 
    /* place the sidebar below the sticky navbar so controls (toggle) are visible */
    position:fixed;
     left:0; 
     width:205px;
     background:#071430;
     color:#c6d0e6;
     display:flex;
     flex-direction:column;
    top:var(--app-navbar-height,56px);
    bottom:0;
    height:calc(100vh - var(--app-navbar-height,56px));
     transition:width .28s cubic-bezier(.22,.9,.35,1), transform .24s ease;
     z-index:90; /* place under navbar (navbar z-index:100) */
 }

.app-sidebar.collapsed .sidebar{ 
    width:72px }

/* icon-only collapsed mode: hide titles and switch label */
.app-sidebar.collapsed .menu-link .title{ opacity:0; 
    width:0; 
    max-width:0; 
    margin:0;
     padding:0; 
    transition:opacity .18s ease, width .18s ease }
.app-sidebar .menu-link .title{ transition:opacity .18s ease }
    
.sidebar header, .sidebar .sidebar-header{
     display:flex;
     align-items:center;
     justify-content:space-between;
     padding:12px 14px;
     background: #071430 }
.logo{ 
    font-weight:700 }
.actions{ display:flex; gap:8px; align-items:center }
.collapse-btn, .mobile-btn{ background:transparent; border:none; color:inherit; cursor:pointer }

/* collapse switch styles */
/* removed: switch styles (icon-only control now in top nav) */

.menu{ flex:1; overflow:auto }
.menu ul{ list-style:none; margin:0; padding:0 }
.menu-section{ padding:12px 16px; font-size:1.1rem; color:#7d84ab; display:flex; align-items:center; justify-content:flex-start; gap:8px; position:relative }
.menu-item{ border-bottom:1px solid rgba(255,255,255,0.02) }
.menu-link{ display:flex; align-items:center; gap:10px; padding:10px 14px; cursor:pointer; transition:background-color .18s ease, color .12s ease, transform .06s ease }
.menu-link .icon{ width:36px; display:inline-flex; align-items:center; justify-content:center; color:#eaf6fb; transition:color .12s ease, opacity .12s ease }
.menu-link .icon i{ color: inherit; font-size: 20px }
.menu-link:hover .icon, .menu-item.open > .menu-link .icon{ color: #ffffff }
.app-sidebar.collapsed .menu-link .icon{ color: #eaf6fb }
.menu-link .title{ flex:1; white-space:nowrap; overflow:hidden; text-overflow:ellipsis }

/* Brighten the dashboard and files entries so they are clearly visible */
.menu-link.dashboard-link, .menu-link.files-link, .menu-link.courses-link{ color: #eaf6fb; text-decoration: none }
.menu-link.dashboard-link .icon,
.menu-link.files-link .icon,
.menu-link.courses-link .icon,
.menu-link.dashboard-link .icon i,
.menu-link.files-link .icon i,
.menu-link.courses-link .icon i {
    color: #eaf6fb;
    opacity: 1;
}
.menu-link.dashboard-link:hover .icon,
.menu-link.files-link:hover .icon,
.menu-link.courses-link:hover .icon,
.menu-link.dashboard-link:hover .icon i,
.menu-link.files-link:hover .icon i,
.menu-link.courses-link:hover .icon i {
    color: #ffffff;
}
.menu-link.dashboard-link:hover, .menu-link.files-link:hover, .menu-link.courses-link:hover { text-decoration: none }

/* Hover / focus / active effects */
.menu-link:hover, .menu-link:focus{
    background: rgba(0,163,196,0.06);
    color: #eaf6fb;
}
.menu-link:active{ transform:translateY(1px) }
.menu-link:focus{ outline: 2px solid rgba(0,163,196,0.12); outline-offset: 2px; border-radius:6px }

/* when a menu with children is open show stronger indicator */
.menu-item.open > .menu-link{
    background: rgba(0,163,196,0.10);
    color: #00a3c4;
}
.menu-item.open > .menu-link .icon{ color: #00a3c4 }
.menu-item.open > .menu-link .caret{ color:#00a3c4 }
.menu-item.hasChildren .caret{ transition:transform .24s ease }
.menu-item.open .caret{ transform:rotate(90deg); color:#00a3c4 }

.sub-list{ list-style:none; margin:0; padding:6px 0 12px 56px; overflow:hidden }
.sub-item{ padding:6px 0 }
.sub-link{ color:inherit; text-decoration:none; display:block; padding:6px 8px; border-radius:6px; transition: background-color .12s ease }
.sub-link:hover, .sub-link:focus{ background: rgba(0,163,196,0.04); color: #eaf6fb }

.sidebar-footer{ padding:12px; background: #071430 }
.overlay{ position:fixed; inset:0; background:rgba(0,0,0,0.35); z-index:50 }

/* Edge collapse button - sits centered on the right edge of the sidebar */
.edge-collapse{
    position:absolute; /* positioned relative to .sidebar */
    z-index:95;
    width:40px;
    height:40px;
    border-radius:8px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background: #f3f6f9; /* light box color */
    color: #071430; /* dark icon color */
    border: 1px solid rgba(7,20,48,0.06);
    box-shadow: 0 6px 18px rgba(2,12,30,0.08);
    transition: background .12s ease, top .12s ease, transform .06s ease, left .12s ease;
    cursor:pointer;
    /* place the button slightly outside the sidebar so it doesn't overlap text */
    top: 50%;
    left: calc(100% + 8px);
    transform: translateY(-50%);
}
.edge-collapse i{ font-size:20px }
.edge-collapse:hover{ background:#0b2b4a }
.edge-collapse:hover{ background:#071430; color: #f3f6f9 }
.edge-collapse.collapsed{ /* slight visual change but keep centered */ background:#e6edf4 }
/* ensure hover color applies when button is collapsed or when sidebar is collapsed */
.edge-collapse.collapsed:hover, .app-sidebar.collapsed .edge-collapse:hover{ background:#071430; color:#f3f6f9 }
/* focus styles for accessibility */
.edge-collapse:focus{ outline: 3px solid rgba(0,163,196,0.16); outline-offset:2px }

/* position adjustment when sidebar is collapsed to prevent large horizontal offset */
.app-sidebar.collapsed .edge-collapse{ left: calc(72px + 8px); }

/* When collapsed, center icons and remove horizontal padding so the icon sits in the middle */
.app-sidebar.collapsed .menu-link{ justify-content:center; padding-left:6px; padding-right:6px }
.app-sidebar.collapsed .menu-link .icon{ width:40px; margin:0; display:inline-flex; justify-content:center }
.app-sidebar.collapsed .menu-link .title{ display:none }

/* Ensure submenu links also center their icons when collapsed */
.app-sidebar.collapsed .sub-link{ padding-left:0; padding-right:0; text-align:center }
.app-sidebar.collapsed .sub-link .icon{ margin:0 auto }

/* tooltip (uses aria-label/title for content) */
/* tooltip removed — button is icon-only, aria-label remains for screen readers */

/* subtle vertical divider at sidebar right edge */
.sidebar::after{
    content: '';
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 1px;
    background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    pointer-events:none;
}



/* top-toggle positioning under the global navbar */
/* top-toggle removed - control moved to top navigation */

/* Responsive */
@media (max-width:900px){
    .app-sidebar{ position:relative }
    /* Default on mobile: sidebar hidden off-canvas unless opened */
    .app-sidebar .sidebar{ position:fixed; left:0; top:var(--app-navbar-height,56px); bottom:0; transform:translateX(-110%); z-index:60; width:260px; height:calc(100vh - var(--app-navbar-height,56px)); }
    /* When toggled (mobile menu), slide in full width */
    .app-sidebar.open .sidebar{ transform:translateX(0) }
    /* When collapsed on mobile, keep a narrow visible bar instead of hiding it */
    .app-sidebar.collapsed .sidebar{ transform:translateX(0); width:72px }
    .mobile-btn{ display:inline-flex }
    /* hide edge-collapse on small screens to avoid overlap with mobile off-canvas UI */
    .edge-collapse{ display:none }
}

/* Transition class placeholder */
.submenu-enter-from, .submenu-leave-to{ max-height:0; opacity:0 }
.submenu-enter-to, .submenu-leave-from{ max-height:1000px; opacity:1 }
.submenu-enter-active, .submenu-leave-active{ transition: max-height .24s ease, opacity .24s ease }

</style>

