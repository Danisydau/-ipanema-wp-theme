import { RigidBody } from '@react-three/rapier'
import { useTexture } from '@react-three/drei'

export default function Field() {
  // A simple grass texture would be loaded here.
  // For now, we'll use a green color.
  // const grassTexture = useTexture('/grass.jpg')

  return (
    <>
      {/* The ground plane */}
      <RigidBody type="fixed" colliders="cuboid" restitution={0.5}>
        <mesh receiveShadow position={[0, -0.5, 0]} rotation={[-Math.PI / 2, 0, 0]}>
          <planeGeometry args={[100, 100]} />
          {/* A placeholder green material for the grass */}
          <meshStandardMaterial color="#2a5c3d" />
        </mesh>
      </RigidBody>

      {/* Placeholder for stadium crowd cards or ad boards */}
      {/* These could be instanced for performance */}
      <mesh position={[-20, 5, -20]} rotation={[0, Math.PI / 4, 0]}>
        <planeGeometry args={[30, 10]} />
        <meshStandardMaterial color="gray" emissive="gray" emissiveIntensity={0.2} />
      </mesh>
      <mesh position={[20, 5, -30]} rotation={[0, -Math.PI / 6, 0]}>
        <planeGeometry args={[30, 10]} />
        <meshStandardMaterial color="gray" emissive="gray" emissiveIntensity={0.2} />
      </mesh>
    </>
  )
}
