import { create } from 'zustand'
import { devtools } from 'zustand/middleware'

// Define the types for the state and actions
interface GameState {
  mode: 'intro' | 'playing' | 'success' | 'timeline';
  score: number;
  difficulty: number;
  streak: number;
  isBrandLockerOpen: boolean;
  isShareCardOpen: boolean;
  isTimelineOpen: boolean;
  isSoundEnabled: boolean;
  isLiteMode: boolean;
  activeBrand: {
    logoUrl?: string;
    preset?: string;
  } | null;

  // Actions
  setMode: (mode: GameState['mode']) => void;
  incrementScore: () => void;
  setDifficulty: (level: number) => void;
  incrementStreak: () => void;
  resetStreak: () => void;
  openBrandLocker: () => void;
  closeBrandLocker: () => void;
  openShareCard: () => void;
  closeShareCard: () => void;
  toggleTimeline: () => void;
  toggleSound: () => void;
  setLiteMode: (isLite: boolean) => void;
  setBrand: (brand: GameState['activeBrand']) => void;
}

export const useGameStore = create<GameState>()(
  devtools(
    (set) => ({
      // Initial State
      mode: 'intro',
      score: 0,
      difficulty: 1,
      streak: 0,
      isBrandLockerOpen: false,
      isShareCardOpen: false,
      isTimelineOpen: false,
      isSoundEnabled: true,
      isLiteMode: false,
      activeBrand: null,

      // Actions
      setMode: (mode) => set({ mode }),
      incrementScore: () => set((state) => ({ score: state.score + 1 })),
      setDifficulty: (level) => set({ difficulty: level }),
      incrementStreak: () => set((state) => ({ streak: state.streak + 1 })),
      resetStreak: () => set({ streak: 0 }),
      openBrandLocker: () => set({ isBrandLockerOpen: true }),
      closeBrandLocker: () => set({ isBrandLockerOpen: false }),
      openShareCard: () => set({ isShareCardOpen: true }),
      closeShareCard: () => set({ isShareCardOpen: false }),
      toggleTimeline: () => set((state) => ({ isTimelineOpen: !state.isTimelineOpen })),
      toggleSound: () => set((state) => ({ isSoundEnabled: !state.isSoundEnabled })),
      setLiteMode: (isLite) => set({ isLiteMode: isLite }),
      setBrand: (brand) => set({ activeBrand: brand }),
    }),
    { name: 'PlayWithRonaldinhoStore' }
  )
)
