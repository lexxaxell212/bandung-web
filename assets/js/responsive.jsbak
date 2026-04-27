/**
 * ResponsiveMobileFirst v2.0
 * @version 2.0.0
 */
;(function(global) {
  'use strict';

  class ResponsiveMobileFirst {
    static VERSION = '2.0.0';
    static SIZE_CLASSES = ['mobile', 'tablet', 'desktop', 'widescreen'];

    constructor(options = {}) {
      this.options = {
        breakpoints: {
          mobile: 0, tablet: 768, desktop: 1024, widescreen: 1440,
          ...options.breakpoints
        },
        debounceDelay: options.debounceDelay ?? 150
      };
      
      this.currentSize = null;
      this.isUpdating = false;
      this.handlers = new Map();
      this.rafId = null;

      if (typeof window !== 'undefined' && typeof document !== 'undefined') {
        this.init();
      }
    }

    init() {
      this.updateClasses = this.updateClasses.bind(this);
      this.onResize = this.debounce(this.onViewportChange.bind(this), this.options.debounceDelay);
      
      ['resize', 'orientationchange'].forEach(event => {
        const handler = this.onResize;
        window.addEventListener(event, handler, { passive: true });
        this.handlers.set(event, handler);
      });

      this.scheduleUpdate();
    }

    onViewportChange() { this.scheduleUpdate(); }

    scheduleUpdate() {
      if (this.rafId) cancelAnimationFrame(this.rafId);
      this.rafId = requestAnimationFrame(this.updateClasses);
    }

    updateClasses() {
      if (this.isUpdating) return;
      this.isUpdating = true;
      this.rafId = null;

      const width = this.getViewportWidth();
      const newSize = this.getSizeForWidth(width);

      if (newSize === this.currentSize) {
        this.isUpdating = false;
        return;
      }

      this.switchClasses(newSize);
      this.currentSize = newSize;
      this.isUpdating = false;
    }

    getViewportWidth() {
      return window.visualViewport?.width ?? window.innerWidth ?? 0;
    }

    getSizeForWidth(width) {
      return Object.entries(this.options.breakpoints)
        .sort(([,a], [,b]) => b - a)
        .find(([name, breakpoint]) => width >= breakpoint)?.[0] ?? 'mobile';
    }

    switchClasses(newSize) {
      ResponsiveMobileFirst.SIZE_CLASSES.forEach(size => {
        document.body.classList.remove(size, `${size}-`);
      });
      document.body.classList.add(newSize, `${newSize}-`);

      document.dispatchEvent(new CustomEvent('screenSizeChange', {
        detail: { 
          size: newSize,
          width: this.getViewportWidth(),
          previous: this.currentSize,
          breakpoints: this.options.breakpoints
        },
        bubbles: true,
        cancelable: true
      }));
    }

    debounce(fn, delay) {
      let timeout;
      return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn(...args), delay);
      };
    }

    destroy() {
      if (this.rafId) {
        cancelAnimationFrame(this.rafId);
        this.rafId = null;
      }
      this.handlers.forEach((handler, event) => {
        window.removeEventListener(event, handler);
      });
      this.handlers.clear();
    }

    refresh() { this.scheduleUpdate(); }
    getState() { 
      return { 
        size: this.currentSize, 
        width: this.getViewportWidth(),
        isUpdating: this.isUpdating 
      }; 
    }
    setBreakpoints(breakpoints) {
      this.options.breakpoints = { ...this.options.breakpoints, ...breakpoints };
      this.refresh();
    }
  }

  // Global instance
  const instance = new ResponsiveMobileFirst();
  global.ResponsiveMobileFirst = ResponsiveMobileFirst;
  global.responsive = instance;

  // Auto-cleanup
  if (typeof window !== 'undefined') {
    window.addEventListener('beforeunload', () => instance.destroy());
  }
})(typeof window !== 'undefined' ? window : this);