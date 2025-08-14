import { router } from '@inertiajs/vue3';
import { hashToIsoDate } from './useCalendar.js';

/**
 * Composable for menu navigation and establishment handling
 */
export function useMenuNavigation() {
    /**
     * Fetch menu for establishment with selected date
     * @param {string|number} establishmentValue - Selected establishment value
     * @param {string} selectedDate - Selected date in ISO format
     */
    const fetchMenuForEstablishment = (establishmentValue, selectedDate) => {
        if (establishmentValue === '' || establishmentValue === null || establishmentValue === undefined) return;

        // Use selected date or today's date as fallback
        const dateToSend = selectedDate || new Date().toISOString().split('T')[0];

        router.visit('/jidelnicky', {
            method: 'get',
            data: {
                jidelna: establishmentValue.toString(),
            },
            except: ['establishments'],
            preserveState: true,
            preserveScroll: true,
        });
    };

    /**
     * Handle URL hash for direct date linking
     * @param {Function} setSelectedDate - Function to update selected date
     * @param {Function} scrollToDate - Function to scroll to date
     */
    const handleUrlHash = (setSelectedDate, scrollToDate) => {
        const hash = window.location.hash.substring(1); // Remove # symbol
        if (hash) {
            const formattedDate = hashToIsoDate(hash);
            if (formattedDate) {
                setSelectedDate(formattedDate);
                // Scroll to date after a short delay to ensure DOM is ready
                setTimeout(() => scrollToDate(formattedDate), 100);
            }
        }
    };

    return {
        fetchMenuForEstablishment,
        handleUrlHash,
    };
}
