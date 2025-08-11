/**
 * @file Contains the core logic for the "Steal the Ball" mini-game.
 */

// These values would be tweaked during playtesting for ideal feel.
const BASE_SUCCESS_WINDOW_MS = 150; // The window for a successful tap
const DIFFICULTY_SCALING_FACTOR = 0.85; // How much the window shrinks per difficulty level

/**
 * Calculates the success window in milliseconds for a given difficulty level.
 * The window gets smaller as the difficulty increases.
 * @param difficulty The current difficulty level (e.g., 1, 2, 3).
 * @returns The time in milliseconds for a successful action.
 */
export function getSuccessWindow(difficulty: number): number {
  if (difficulty <= 0) return BASE_SUCCESS_WINDOW_MS;
  return BASE_SUCCESS_WINDOW_MS * Math.pow(DIFFICULTY_SCALING_FACTOR, difficulty - 1);
}

/**
 * Determines if a player's action was successful based on timing.
 * @param timingErrorMs The difference in ms between the player's tap and the ideal moment.
 * @param successWindowMs The total allowed time for a successful tap.
 * @returns 'perfect' | 'good' | 'miss'
 */
export function checkTiming(timingErrorMs: number, successWindowMs: number): 'perfect' | 'good' | 'miss' {
  const absError = Math.abs(timingErrorMs);
  const halfWindow = successWindowMs / 2;

  if (absError <= halfWindow / 2) { // Within the inner 50% of the window
    return 'perfect';
  }
  if (absError <= halfWindow) { // Within the outer 50% of the window
    return 'good';
  }
  return 'miss';
}

/**
 * Defines the properties of the timing ring animation for each difficulty.
 */
export const difficultySettings = {
  1: { duration: 2.5, targetZone: 0.8 }, // Slower, larger target
  2: { duration: 1.8, targetZone: 0.85 },
  3: { duration: 1.2, targetZone: 0.9 }, // Faster, smaller target
};

/**
 * A simple NSFW word filter.
 * In a real-world app, this would be more robust or use a service.
 */
const denyList = new Set(['badword1', 'badword2', 'anotherbadword']); // Example list
export function isBrandNameSafe(name: string): boolean {
  if (!name) return true;
  return !denyList.has(name.toLowerCase().trim());
}
