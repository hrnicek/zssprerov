/**
 * Calendar utilities and date generation
 */

const DAY_NAMES = ['Po', 'Út', 'St', 'Čt', 'Pá', 'So', 'Ne'];
const MONTH_NAMES = [
  'Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen',
  'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'
];

/**
 * Generate calendar dates for 3 weeks starting from today
 * @returns {Array} Array of date objects with metadata
 */
export function generateCalendarDates() {
  const today = new Date();
  const weeks = [];
  let currentDate = new Date(today);
  let addedDays = 0;
  let totalDays = 0;
  let currentWeek = [];
  let lastMonth = null;

  while (addedDays < 21 && totalDays < 30) {
    const dayOfWeek = currentDate.getDay();
    const currentMonth = currentDate.getMonth();
    const isNewMonth = lastMonth !== null && lastMonth !== currentMonth;

    // Convert Sunday (0) to index 6, Monday (1) to 0, etc.
    const adjustedDayOfWeek = dayOfWeek === 0 ? 6 : dayOfWeek - 1;

    const dateObj = {
      date: new Date(currentDate),
      dayName: DAY_NAMES[adjustedDayOfWeek],
      day: currentDate.getDate(),
      month: currentDate.getMonth() + 1,
      year: currentDate.getFullYear(),
      isToday: currentDate.toDateString() === today.toDateString(),
      dateString: currentDate.toISOString().split('T')[0],
      isNewMonth: isNewMonth,
      monthName: MONTH_NAMES[currentMonth],
    };

    // Add month separator for Sunday if next day is new month
    if (dayOfWeek === 0) {
      const nextDay = new Date(currentDate);
      nextDay.setDate(currentDate.getDate() + 1);
      if (nextDay.getMonth() !== currentMonth) {
        dateObj.monthNameForSeparator = MONTH_NAMES[nextDay.getMonth()];
      }
    }

    // Start new week on Monday or if current week is full
    if (dayOfWeek === 1 || currentWeek.length === 7) {
      if (currentWeek.length > 0) {
        weeks.push({ type: 'week', dates: currentWeek });
      }
      currentWeek = [dateObj];
    } else {
      currentWeek.push(dateObj);
    }

    lastMonth = currentMonth;
    addedDays++;
    currentDate.setDate(currentDate.getDate() + 1);
    totalDays++;
  }

  // Add the last week if it has dates
  if (currentWeek.length > 0) {
    weeks.push({ type: 'week', dates: currentWeek });
  }

  return weeks;
}

/**
 * Convert hash date (DD.MM.YYYY) to ISO format (YYYY-MM-DD)
 * @param {string} hash - Hash string in DD.MM.YYYY format
 * @returns {string|null} ISO formatted date or null if invalid
 */
export function hashToIsoDate(hash) {
  const dateParts = hash.split('.');
  if (dateParts.length === 3) {
    const [day, month, year] = dateParts;
    return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
  }
  return null;
}

/**
 * Convert ISO date (YYYY-MM-DD) to hash format (DD.MM.YYYY)
 * @param {string} isoDate - ISO formatted date
 * @returns {string|null} Hash formatted date or null if invalid
 */
export function isoDateToHash(isoDate) {
  const dateParts = isoDate.split('-');
  if (dateParts.length === 3) {
    const [year, month, day] = dateParts;
    return `${day}.${month}.${year}`;
  }
  return null;
}