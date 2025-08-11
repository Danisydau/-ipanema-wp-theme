import { RigidBody, BallCollider } from '@react-three/rapier'
import { useTexture } from '@react-three/drei'
import { useRef } from 'react'
import * as THREE from 'three'

export default function Ball() {
  const ballRef = useRef<any>()

  // Placeholder texture for the ball
  // const ballTexture = useTexture('/assets/ball_base.png')

  // A simple material for now
  const ballMaterial = new THREE.MeshStandardMaterial({
    color: 'white',
    roughness: 0.3,
    metalness: 0.1,
  })

  return (
    <RigidBody
      ref={ballRef}
      colliders={false} // Use a custom BallCollider
      position={[0.5, 3, 0]}
      restitution={0.8}
      friction={0.5}
      mass={0.3}
    >
      <mesh castShadow receiveShadow material={ballMaterial}>
        <sphereGeometry args={[0.2, 32, 32]} />
      </mesh>
      <BallCollider args={[0.2]} />
    </RigidBody>
  )
}
