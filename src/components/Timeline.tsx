import { useGameStore } from '../game/useGameStore'
import { motion, AnimatePresence } from 'framer-motion'
import { useLayoutEffect, useRef } from 'react'
import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const chapters = [
  {
    title: "The Early Years",
    content: "A rising star emerges, dazzling the world with raw talent and an infectious smile. The legend begins.",
    id: "early"
  },
  {
    title: "Peak Moments",
    content: "World cups, league titles, and iconic goals. A showcase of a player at the absolute height of his powers.",
    id: "peak"
  },
  {
    title: "Marketing Impact",
    content: "From iconic ads to a global brand, his influence transcended the pitch and changed sports marketing forever.",
    id: "marketing"
  },
]

export default function Timeline() {
  const { toggleTimeline } = useGameStore()
  const component = useRef(null)
  const scroller = useRef(null)

  useLayoutEffect(() => {
    let ctx = gsap.context(() => {
      const panels = gsap.utils.toArray(".timeline-panel");
      gsap.to(panels, {
        xPercent: -100 * (panels.length - 1),
        ease: "none",
        scrollTrigger: {
          trigger: scroller.current,
          pin: true,
          scrub: 1,
          snap: 1 / (panels.length - 1),
          end: () => "+=" + (scroller.current as any)?.offsetWidth
        }
      });
    }, component);
    return () => ctx.revert();
  }, []);

  return (
    <AnimatePresence>
      <motion.div
        ref={component}
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        className="absolute inset-0 bg-night-pitch z-30 overflow-hidden"
      >
        <div ref={scroller} className="w-full h-full flex flex-nowrap">
          <button onClick={toggleTimeline} className="absolute top-8 right-8 z-50 text-2xl font-bold">✕</button>

          {/* Intro Panel */}
          <section className="timeline-panel w-screen h-screen flex-shrink-0 flex items-center justify-center text-center p-8">
            <div>
              <h2 className="font-display text-6xl">A LEGEND'S JOURNEY</h2>
              <p className="text-xl text-ui-chrome mt-4">Scroll to explore the timeline</p>
            </div>
          </section>

          {/* Chapter Panels */}
          {chapters.map((chapter) => (
            <section key={chapter.id} className="timeline-panel w-screen h-screen flex-shrink-0 flex items-center justify-center p-8">
              <div className="max-w-md text-center">
                <h3 className="font-display text-5xl text-warm-highlight">{chapter.title}</h3>
                <p className="mt-4 text-lg">{chapter.content}</p>
              </div>
            </section>
          ))}

          {/* CTA Panel */}
           <section className="timeline-panel w-screen h-screen flex-shrink-0 flex items-center justify-center text-center p-8">
            <div>
              <h2 className="font-display text-6xl">CREATE YOUR MOMENT</h2>
              <button
                onClick={toggleTimeline}
                className="mt-8 bg-warm-highlight text-night-pitch font-bold uppercase px-8 py-4 rounded-full text-lg shadow-lg hover:bg-white transition-colors"
              >
                Back to the Playground
              </button>
            </div>
          </section>
        </div>
      </motion.div>
    </AnimatePresence>
  )
}
