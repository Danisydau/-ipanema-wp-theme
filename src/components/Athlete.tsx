import { useGLTF, useAnimations } from '@react-three/drei'
import { useEffect, useRef } from 'react'
import * as THREE from 'three'

// This is a placeholder path.
// The actual model should be placed in /public or /src/assets
const ATHLETE_MODEL_PATH = '/assets/athlete.glb'

export default function Athlete() {
  const group = useRef<THREE.Group>(null)
  // useGLTF.preload(ATHLETE_MODEL_PATH)
  const { scene, animations } = useGLTF(ATHLETE_MODEL_PATH)
  const { actions } = useAnimations(animations, group)

  useEffect(() => {
    // This assumes the GLTF has animations named 'juggle', 'stepover', etc.
    // In a real scenario, you'd list available animations and pick one.
    const animToPlay = 'juggle' // Default animation
    if (actions[animToPlay]) {
      actions[animToPlay].reset().fadeIn(0.5).play();
    } else {
      // If the default animation isn't found, play the first one available.
      const firstAnim = Object.keys(actions)[0];
      if (firstAnim) {
        actions[firstAnim]?.reset().fadeIn(0.5).play();
      }
    }

    return () => {
      // Fade out the animation on component unmount
      if (actions[animToPlay]) {
        actions[animToPlay]?.fadeOut(0.5)
      }
    }
  }, [actions])

  // Apply properties to all meshes in the loaded model
  useEffect(() => {
    if (scene) {
      scene.traverse((child) => {
        if (child instanceof THREE.Mesh) {
          child.castShadow = true;
          child.receiveShadow = true;
        }
      });
    }
  }, [scene]);


  return (
    <group ref={group} position={[0, 0, 0]} dispose={null}>
      {/* The primitive object is a direct rendering of the loaded scene */}
      <primitive object={scene} scale={1.5} />
    </group>
  )
}
