<template>
  <div ref="mount"></div>
</template>

<script>

//most of this isn't my code and came from three js docs and some youtube tutorials but I did the integration for it into vue which was mind numbing
import * as THREE from 'three';

let scene, camera, renderer, sphere, animationFrameId;

export default {
  mounted() {
    this.initThree();
    this.animate();
  },
  beforeUnmount() {
    this.stop();
    this.clean();
  },
  methods: {
    initThree() {
      const width = this.$refs.mount.clientWidth;
      const height = this.$refs.mount.clientHeight;

      scene = new THREE.Scene();
      camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
      renderer = new THREE.WebGLRenderer({ antialias: true });

      renderer.setSize(width, height);
      this.$refs.mount.appendChild(renderer.domElement);

      const textureLoader = new THREE.TextureLoader();
      textureLoader.load('/josh.jpg', (texture) => {
        const geometry = new THREE.SphereGeometry(2.5, 32, 32);
        const material = new THREE.MeshBasicMaterial({ map: texture });
        sphere = new THREE.Mesh(geometry, material);

        scene.add(sphere);
      });

      camera.position.z = 5;
    },
    animate() {
      animationFrameId = requestAnimationFrame(this.animate);
      if (sphere) {
        sphere.rotation.x += 0.01;
        sphere.rotation.y += 0.01;
      }
      renderer.render(scene, camera);
    },
    stop() {
      cancelAnimationFrame(animationFrameId);
    },
    clean() {
      this.$refs.mount.removeChild(renderer.domElement);
    }
  },
};
</script>


<style scoped>
div {
  /* needed a style to stop it screwing up the other UI*/
  width: 100%;
  height: 400px;
}
</style>


