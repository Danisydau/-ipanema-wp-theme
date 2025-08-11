import { useThree } from '@react-three/fiber';
import { Environment } from '@react-three/drei';

export default function Lights() {
  const { scene } = useThree();

  // This is a simple but effective lighting setup
  // In a real project, this would be fine-tuned with the art team.

  // Set a background color that matches the vibe
  scene.background = new THREE.Color(0x0d1017);

  return (
    <>
      {/* Soft ambient light for the whole scene */}
      <ambientLight intensity={0.5} />

      {/* A main key light to simulate a stadium floodlight */}
      <directionalLight
        castShadow
        position={[10, 20, 5]}
        intensity={2}
        shadow-mapSize-width={2048}
        shadow-mapSize-height={2048}
        shadow-camera-far={50}
        shadow-camera-left={-20}
        shadow-camera-right={20}
        shadow-camera-top={20}
        shadow-camera-bottom={-20}
      />

      {/* A fill light from the other side to soften shadows */}
      <directionalLight position={[-5, 10, -10]} intensity={0.5} />

      {/* Environment lighting from an HDRI for realistic reflections */}
      {/* The 'sunset' preset is a good starting point for a warm vibe */}
      <Environment preset="sunset" background={false} />
    </>
  )
}
