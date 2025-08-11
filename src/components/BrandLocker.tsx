import { useGameStore } from '../game/useGameStore'
import { motion, AnimatePresence } from 'framer-motion'
import { useRef } from 'react'

const presets = [
  '/assets/logo_placeholder.svg',
  // Add paths to other preset logos here
]

export default function BrandLocker() {
  const { closeBrandLocker, setBrand } = useGameStore()
  const fileInputRef = useRef<HTMLInputElement>(null)

  const handleUploadClick = () => {
    fileInputRef.current?.click()
  }

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const file = event.target.files?.[0]
    if (file) {
      const logoUrl = URL.createObjectURL(file)
      setBrand({ logoUrl })
      // Here you would also handle the texture update logic
      console.log('Logo uploaded:', logoUrl)
    }
  }

  const handlePresetSelect = (presetUrl: string) => {
    setBrand({ preset: presetUrl })
    // Here you would also handle the texture update logic
    console.log('Preset selected:', presetUrl)
  }

  return (
    <AnimatePresence>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        className="absolute inset-0 bg-black/70 flex items-center justify-center z-10 p-4"
        onClick={closeBrandLocker}
      >
        <motion.div
          initial={{ y: 50, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          exit={{ y: 50, opacity: 0 }}
          transition={{ type: 'spring', damping: 25, stiffness: 200 }}
          className="bg-night-pitch border border-gray-700 rounded-lg shadow-2xl p-6 w-full max-w-md pointer-events-auto"
          onClick={(e) => e.stopPropagation()}
        >
          <h2 className="font-display text-3xl text-warm-highlight mb-4">Brand Locker</h2>
          <p className="text-ui-chrome mb-6">Apply your brand to the kit.</p>

          <div className="space-y-4">
            <input
              type="file"
              ref={fileInputRef}
              className="hidden"
              accept="image/png, image/svg+xml"
              onChange={handleFileChange}
            />
            <button
              onClick={handleUploadClick}
              className="w-full bg-warm-highlight text-night-pitch font-bold uppercase py-3 rounded-md hover:bg-white transition-colors"
            >
              Upload Logo
            </button>
            <div className="relative text-center my-2">
              <span className="text-ui-chrome text-sm bg-night-pitch px-2">OR</span>
              <div className="absolute left-0 top-1/2 w-full h-px bg-gray-700 -z-10"></div>
            </div>
            <div className="grid grid-cols-3 gap-4">
              {presets.map((p) => (
                <button
                  key={p}
                  onClick={() => handlePresetSelect(p)}
                  className="bg-gray-800 rounded-md p-2 hover:bg-gray-700 aspect-square flex items-center justify-center"
                >
                  <img src={p} alt="Preset logo" className="max-w-full max-h-full" />
                </button>
              ))}
            </div>
          </div>

          {/* Placeholder for transform controls (scale, rotate, etc.) */}
          <div className="mt-6 pt-4 border-t border-gray-700">
            <h3 className="text-lg font-bold">Customize Placement</h3>
            <p className="text-sm text-ui-chrome">(Controls coming soon)</p>
          </div>

          <button
            onClick={closeBrandLocker}
            className="w-full mt-6 bg-gray-600 text-white font-bold uppercase py-3 rounded-md hover:bg-gray-500 transition-colors"
          >
            Done
          </button>
        </motion.div>
      </motion.div>
    </AnimatePresence>
  )
}
