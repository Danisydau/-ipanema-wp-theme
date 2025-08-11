import { useState, useEffect } from 'react';
import { useThree } from '@react-three/fiber';
import { useGameStore } from '../game/useGameStore';

const FPS_THRESHOLD = 45; // Below this FPS...
const DURATION_THRESHOLD_S = 3; // ...for this many seconds, trigger lite mode.

/**
 * A hook to monitor device performance (primarily FPS) and
 * automatically switch to a "lite mode" if performance is poor.
 */
export const useDevicePerf = () => {
  const setLiteMode = useGameStore((state) => state.setLiteMode);
  const isLiteMode = useGameStore((state) => state.isLiteMode);
  const clock = useThree((state) => state.clock);

  const [lowFpsTime, setLowFpsTime] = useState(0);

  useEffect(() => {
    if (isLiteMode) return; // Already in lite mode, no need to monitor

    const unsub = useThree(({ gl }) => {
      // This is a simple subscription to the render loop
      const handle = gl.info.render.frame;

      const lastTime = clock.getElapsedTime();

      return () => {
        const currentTime = clock.getElapsedTime();
        const deltaTime = currentTime - lastTime;
        const fps = 1 / deltaTime;

        if (fps < FPS_THRESHOLD) {
          setLowFpsTime((prev) => prev + deltaTime);
        } else {
          setLowFpsTime(0); // Reset if FPS recovers
        }
      };
    });

    return unsub;
  }, [isLiteMode, clock]);

  useEffect(() => {
    if (lowFpsTime > DURATION_THRESHOLD_S && !isLiteMode) {
      console.warn(`Performance issue detected. FPS below ${FPS_THRESHOLD} for over ${DURATION_THRESHOLD_S}s. Switching to Lite Mode.`);
      setLiteMode(true);
    }
  }, [lowFpsTime, isLiteMode, setLiteMode]);

  return { isLiteMode };
};

/**
 * A component wrapper to activate the hook within the R3F canvas.
 */
export const PerfMonitor = () => {
  useDevicePerf();
  return null; // This component doesn't render anything
};
