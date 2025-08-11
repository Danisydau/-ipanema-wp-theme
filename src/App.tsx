import CanvasStage from './components/CanvasStage'
import UIHud from './components/UIHud'
import { useGameStore } from './game/useGameStore'
import BrandLocker from './components/BrandLocker'
import ShareCard from './components/ShareCard'
import Timeline from './components/Timeline'

function App() {
  const { isBrandLockerOpen, isShareCardOpen, isTimelineOpen } = useGameStore()

  return (
    <main className="relative w-full h-screen">
      <div aria-live="polite" className="sr-only">
        {/* Announce game state changes for screen readers */}
      </div>

      <CanvasStage />
      <UIHud />

      {isBrandLockerOpen && <BrandLocker />}
      {isShareCardOpen && <ShareCard />}
      {isTimelineOpen && <Timeline />}

      {/* Fallback for low-end devices */}
      <div id="fallback-container"></div>
    </main>
  )
}

export default App
