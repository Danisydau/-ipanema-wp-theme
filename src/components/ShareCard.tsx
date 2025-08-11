import { useGameStore } from '../game/useGameStore'
import { motion, AnimatePresence } from 'framer-motion'
import { useThree } from '@react-three/fiber'
import { useState, useCallback } from 'react'

export default function ShareCard() {
  const { closeShareCard } = useGameStore()
  const { gl } = useThree() // To access the canvas renderer
  const [imageDataUrl, setImageDataUrl] = useState<string | null>(null)
  const [isGenerating, setIsGenerating] = useState(false)

  const handleGenerate = useCallback(() => {
    setIsGenerating(true)
    // Preserve drawing buffer is needed for this to work
    // It can be set on the <Canvas preserveDrawingBuffer />
    try {
      const dataUrl = gl.domElement.toDataURL('image/webp', 0.8)
      setImageDataUrl(dataUrl)
    } catch (e) {
      console.error("Could not generate share card from WebGL.", e)
      // Fallback to html2canvas could be implemented here
    } finally {
      setIsGenerating(false)
    }
  }, [gl])

  return (
    <AnimatePresence>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        className="absolute inset-0 bg-black/70 flex items-center justify-center z-20 p-4"
        onClick={closeShareCard}
      >
        <motion.div
          initial={{ scale: 0.8, opacity: 0 }}
          animate={{ scale: 1, opacity: 1 }}
          exit={{ scale: 0.8, opacity: 0 }}
          className="bg-night-pitch border border-gray-700 rounded-lg shadow-2xl p-6 w-full max-w-lg pointer-events-auto"
          onClick={(e) => e.stopPropagation()}
        >
          <h2 className="font-display text-3xl text-warm-highlight mb-4">Generate Share Card</h2>

          {imageDataUrl ? (
            <div className="space-y-4">
              <img src={imageDataUrl} alt="Your branded moment" className="rounded-md w-full" />
              <a
                href={imageDataUrl}
                download="play-with-ronaldinho.webp"
                className="block w-full text-center bg-warm-highlight text-night-pitch font-bold uppercase py-3 rounded-md hover:bg-white transition-colors"
              >
                Download Image
              </a>
            </div>
          ) : (
            <div className="text-center space-y-4">
              <p className="text-ui-chrome">Capture the current scene with your brand.</p>
              <button
                onClick={handleGenerate}
                disabled={isGenerating}
                className="w-full bg-warm-highlight text-night-pitch font-bold uppercase py-3 rounded-md hover:bg-white transition-colors disabled:bg-gray-500"
              >
                {isGenerating ? 'Capturing...' : 'Capture Scene'}
              </button>
            </div>
          )}

          <button
            onClick={closeShareCard}
            className="w-full mt-6 bg-gray-600 text-white font-bold uppercase py-2 rounded-md hover:bg-gray-500 transition-colors"
          >
            Close
          </button>
        </motion.div>
      </motion.div>
    </AnimatePresence>
  )
}
