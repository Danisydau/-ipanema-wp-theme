# Play with Ronaldinho - Interactive Demo

This is a production-ready demo website for an interactive "Play with Ronaldinho" experience, built as a technical showcase. It features a 3D athlete performing freestyle tricks, a "Steal the Ball" mini-game, and dynamic brand placement on the athlete's kit.

## Tech Stack

- **Frontend:** React + TypeScript + Vite
- **3D:** react-three-fiber (Three.js) + @react-three/drei
- **Physics:** @dimforge/rapier3d (via @react-three/rapier)
- **State:** Zustand
- **Animations:** GSAP (for UI/scroll) + R3F frame loops
- **Styles/UI:** Tailwind CSS
- **Sound:** Web Audio API (hooks in place)
- **Branding overlays:** HTML5 Canvas compositing
- **Build/Perf:** Code-splitting, lazy-loading assets, Draco/KTX2 compression ready.
- **Analytics:** Simple event emitter concept ready to be plugged into a provider.
- **Fallback:** Logic and hooks in place for a 2D Canvas/Pixi.js “lite mode”.

---

## Setup and Running the Project

To get the project running locally, follow these steps.

**1. Prerequisites:**
   - Node.js (v18 or higher recommended)
   - npm or yarn

**2. Installation:**
   ```bash
   npm install
   ```

**3. Running the Development Server:**
   ```bash
   npm run dev
   ```
   The site will be available at `http://localhost:5173` by default.

**4. Building for Production:**
   ```bash
   npm run build
   ```
   The production-ready files will be located in the `/dist` directory.

---

## Asset Swap Instructions

This project uses placeholder assets. To replace them with licensed or custom assets, follow these guidelines.

### 1. Athlete Model

- **File:** `/src/assets/athlete.glb` (or update path in `Athlete.tsx`)
- **Format:** `glTF` (`.glb`) with Draco compression recommended.
- **Rig:** Must be a **Mixamo-compatible** rig for the animations to work correctly.
- **Animations:** The model should contain embedded animations. The code currently looks for an animation named `"juggle"`. You can change this in `Athlete.tsx`.
- **Scale & Naming:** Ensure the model is exported at a reasonable scale. The root node in the scene is scaled in `Athlete.tsx` if needed.

### 2. Replacing the Generic Athlete with Ronaldinho

When you have the approved, licensed Ronaldinho model:
1.  **Name and Place:** Name the file `ronaldinho.glb` and place it in `/public/assets/`.
2.  **Update Path:** In `src/components/Athlete.tsx`, change `ATHLETE_MODEL_PATH` to point to the new file.
3.  **Check Scale:** Adjust the `scale` prop on the `<primitive>` object in `Athlete.tsx` to match the new model's size.
4.  **Animation Names:** Check the animation names within the new `.glb` file. Update the `useEffect` hook in `Athlete.tsx` to call the correct animation names (e.g., `actions['ronaldinho_freestyle_1']`).
5.  **UV Maps:** Ensure the jersey/kit part of the model has clean, non-overlapping UVs. This is critical for the brand placement feature. Provide the texture artist with a UV layout map.

### 3. Textures & Environment

- **HDRI:** Replace `/src/assets/stadium.hdr` with a high-quality HDRI for environment lighting.
- **Base Textures:** Replace the `.png` files in `/src/assets/` (`jersey_base.png`, `ball_base.png`, `boots_base.png`).
  - **UVs:** These textures **must** match the UV layouts of your 3D models.
  - **Dimensions:** Use power-of-two dimensions (e.g., 1024x1024, 2048x2048) for optimal performance and mipmapping. KTX2 compressed format is recommended for production builds.

---

## IP & Rights Disclaimer

**IMPORTANT:** The default athlete model included is a generic placeholder. It is used for demonstration purposes only and holds no association with Ronaldinho or any other specific individual.

**DO NOT** deploy this project with any unlicensed assets. Before launching, you **MUST** replace the placeholder model, textures, and any other assets with fully licensed, approved materials of the intended subject (Ronaldinho), as per legal and contractual agreements. The developers of this template are not liable for any misuse of intellectual property.
