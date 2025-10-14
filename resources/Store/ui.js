import { defineStore } from 'pinia'

export const useUi = defineStore('ui', {
  state: () => ({
    isLoading: false,
    _timerId: null,
    // sidebar collapse state persisted across reloads
    sidebarCollapsed: false,
  }),
  actions: {
    show() { this.isLoading = true },
    hide() {
      this.isLoading = false
      if (this._timerId) {
        clearTimeout(this._timerId)
        this._timerId = null
      }
    },
    toggle() { this.isLoading = !this.isLoading },

    // Show loader for a minimum duration (ms). Cancels previous timers.
    showFor(ms = 6000){
      if(this._timerId){
        clearTimeout(this._timerId)
        this._timerId = null
      }
      this.isLoading = true
      this._timerId = setTimeout(()=>{
        this.isLoading = false
        this._timerId = null
      }, ms)
    }
    ,
    // sidebar controls
    setSidebarCollapsed(val){
      this.sidebarCollapsed = !!val
      try{ localStorage.setItem('ftu_sidebar_collapsed', this.sidebarCollapsed ? '1' : '0') }catch(e){}
    },
    toggleSidebar(){
      this.setSidebarCollapsed(!this.sidebarCollapsed)
    },
    initSidebar(){
      try{
        const v = localStorage.getItem('ftu_sidebar_collapsed')
        this.sidebarCollapsed = v === '1'
      }catch(e){}
    }
  }
})
