import { Canvas } from '@react-three/fiber'
import { Physics } from '@react-three/rapier'
import { Suspense } from 'react'
import Lights from './Lights'
import Field from './Field'
import Athlete from './Athlete'
import Ball from './Ball'
import { PerfMonitor } from '../hooks/useDevicePerf'
import { Preload } from '@react-three/drei'

// A fallback component to show while assets are loading
function Loader() {
  return (
    <mesh>
      <boxGeometry args={[1, 1, 1]} />
      <meshBasicMaterial color="hotpink" wireframe />
    </mesh>
  )
}

export default function CanvasStage() {
  return (
    <Canvas
      shadows
      camera={{ position: [0, 2, 10], fov: 50 }}
      dpr={[1, 2]} // Use device pixel ratio, max 2
      gl={{ preserveDrawingBuffer: true }} // Needed for screenshot capture
    >
      <Suspense fallback={<Loader />}>
        <Physics gravity={[0, -30, 0]}>
          <Lights />
          <Field />
          <Athlete />
          <Ball />
        </Physics>
        <Preload all />
        <PerfMonitor />
      </Suspense>
    </Canvas>
  )
}
