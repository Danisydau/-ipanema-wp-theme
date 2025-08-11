import { useGameStore } from '../game/useGameStore'
import { motion } from 'framer-motion'

export default function UIHud() {
  const { score, streak, setMode, toggleTimeline } = useGameStore()

  const handleStealAttempt = () => {
    // This would trigger the mini-game logic
    console.log('Attempting to steal the ball...')
    setMode('playing');
  }

  return (
    <div className="absolute inset-0 pointer-events-none text-white font-sans">
      {/* Header */}
      <header className="absolute top-0 left-0 right-0 p-4 md:p-8 flex justify-between items-center">
        <h1 className="text-2xl md:text-4xl font-display tracking-wider">Play with Ronaldinho</h1>
        <div className="flex items-center gap-4">
          <button onClick={toggleTimeline} className="pointer-events-auto text-sm uppercase hover:text-warm-highlight transition-colors">
            Timeline
          </button>
          {/* Sound toggle can go here */}
        </div>
      </header>

      {/* Main CTA */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <motion.button
          initial={{ scale: 0, opacity: 0 }}
          animate={{ scale: 1, opacity: 1 }}
          transition={{ delay: 1, type: 'spring', stiffness: 260, damping: 20 }}
          onClick={handleStealAttempt}
          className="pointer-events-auto bg-warm-highlight text-night-pitch font-bold uppercase px-8 py-4 rounded-full text-lg shadow-lg hover:bg-white transition-colors"
        >
          Steal the Ball
        </motion.button>
      </div>

      {/* Score and Streak */}
      <div className="absolute bottom-0 left-0 right-0 p-4 md:p-8 flex justify-between items-center">
        <div>
          <span className="text-sm uppercase text-ui-chrome">Score</span>
          <p className="text-2xl font-bold">{score}</p>
        </div>
        <div>
          <span className="text-sm uppercase text-ui-chrome">Streak</span>
          <p className="text-2xl font-bold">{streak} 🔥</p>
        </div>
      </div>
    </div>
  )
}
