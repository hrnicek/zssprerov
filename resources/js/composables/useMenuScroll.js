import { ref } from 'vue';
import { isoDateToHash } from './useCalendar.js';

/**
 * Composable for managing menu scroll detection and date synchronization
 */
export function useMenuScroll() {
  const isScrolling = ref(false);
  let scrollObserver = null;
  let scrollTimeout = null;

  /**
   * Scroll to a specific date section
   * @param {string} dateString - ISO date string (YYYY-MM-DD)
   */
  const scrollToDate = (dateString) => {
    const element = document.getElementById(`menu-${dateString}`);
    if (element) {
      const headerOffset = 100;
      const elementPosition = element.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth',
      });
    }
  };

  /**
   * Handle date selection with scroll and URL update
   * @param {string} dateString - ISO date string (YYYY-MM-DD)
   * @param {Function} setSelectedDate - Function to update selected date
   */
  const selectDate = (dateString, setSelectedDate) => {
    isScrolling.value = true;
    setSelectedDate(dateString);

    // Update URL hash with DD.MM.YYYY format
    const hashDate = isoDateToHash(dateString);
    if (hashDate) {
      history.replaceState(null, '', `#${hashDate}`);
    }

    scrollToDate(dateString);

    // Reset scrolling flag after scroll completes
    setTimeout(() => {
      isScrolling.value = false;
    }, 1500);
  };

  /**
   * Setup intersection observer for automatic date selection on scroll
   * @param {Function} setSelectedDate - Function to update selected date
   */
  const setupScrollDetection = (setSelectedDate) => {
    // Clean up existing observer
    if (scrollObserver) {
      scrollObserver.disconnect();
    }

    const menuSections = document.querySelectorAll('[id^="menu-"]');
    if (menuSections.length === 0) {
      // Retry after delay if sections not found
      setTimeout(() => setupScrollDetection(setSelectedDate), 1000);
      return;
    }

    scrollObserver = new IntersectionObserver(
      (entries) => {
        if (isScrolling.value) return;

        // Debounce the updates
        if (scrollTimeout) {
          clearTimeout(scrollTimeout);
        }

        scrollTimeout = setTimeout(() => {
          let mostVisible = null;
          let maxRatio = 0;

          entries.forEach((entry) => {
            if (entry.isIntersecting && entry.intersectionRatio > maxRatio) {
              maxRatio = entry.intersectionRatio;
              mostVisible = entry.target;
            }
          });

          if (mostVisible && maxRatio > 0.3) {
            const dateString = mostVisible.id.replace('menu-', '');
            setSelectedDate(dateString);

            // Update URL hash
            const hashDate = isoDateToHash(dateString);
            if (hashDate) {
              history.replaceState(null, '', `#${hashDate}`);
            }
          }
        }, 100);
      },
      {
        threshold: [0, 0.1, 0.3, 0.5, 0.7, 1.0],
        rootMargin: '-100px 0px -100px 0px',
      },
    );

    menuSections.forEach((section) => {
      scrollObserver.observe(section);
    });

    return scrollObserver;
  };

  /**
   * Cleanup scroll detection
   */
  const cleanupScrollDetection = () => {
    if (scrollObserver) {
      scrollObserver.disconnect();
      scrollObserver = null;
    }
    if (scrollTimeout) {
      clearTimeout(scrollTimeout);
      scrollTimeout = null;
    }
  };

  return {
    isScrolling,
    scrollToDate,
    selectDate,
    setupScrollDetection,
    cleanupScrollDetection,
  };
}