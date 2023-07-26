<!--I like vue a lot for its boilerplate driven components (but like I mean that in a good way. It's less confusing then react or svelt for me) */ -->

<template>
  <div id="app">
    <div class="title-box">
      <h1 class="title">Book Catalogue for Joshua "Spinning Sphere" Rawlings</h1>
      <p class="subtitle">by Cade Thornton</p> 
    </div>
    <div class="content-container">
      <ThreeScene />
      <nav class="nav"> <!-- look at all the navs -->
        <router-link to="/createabook" class="nav-link">Create a Book</router-link>
        <router-link to="/readabook" class="nav-link">Read a Book</router-link>
        <router-link to="/updateabook" class="nav-link">Update a Book</router-link>
        <router-link to="/destroyabook" class="nav-link">Destroy a Book</router-link>
        <router-link to="/displaybooks" class="nav-link">Display Books</router-link>
      </nav>
      <!-- this stops the three js bug -->
      <div class="router-view-container">
        <router-view />
      </div>
    </div>
  </div>
</template>

<script>

//threejs stuff
import ThreeScene from './components/ThreeScene.vue';

export default {
  components: {
    ThreeScene,
  },
};
</script>


<style scoped>
/* Im not gonna put my css styles in a separate file because my brain is about to shut off*/
.title-box {
  position: relative;
  background-color: #1d9a9e;
  padding: 2px;
  text-align: center;
  background: linear-gradient(to right, #ff0000, #a7a424);
}

.title {
  margin: 0;
  font-size: 48px;
}

.subtitle {
  margin: 20px 0; /*moved it down by adding margin-top*/
  font-size: 24px;
  color: #000000; /*set the text color to black*/
}

#app {
  position: relative;
  background-color: #000000;
  height: 100vh;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.content-container {
  height: calc(100% - 150px); /*set the height to 100% minus the height of the nabar */
  overflow-y: auto; /*add scrollable space below the navbar */
}

/* Updated styles for the navbar */
.nav {
  text-align: center; 
}

/*updated styles for the nav-link */
.nav-link {
  display: inline-block;
  margin: 0 10px;
  color: #ffffff;
  text-decoration: none;
  font-size: 20px;
  padding: 10px 15px;
  border-radius: 5px;
  background-color: #1d9a9e;
  transition: background-color 0.3s ease-in-out;
}

.nav-link:hover {
  background-color: #888888;
}

.nav-link:focus {
  outline: none;
  background-color: #888888;
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.5);
}

.nav-link:active {
  background-color: #888888;
  box-shadow: none;
}

</style>
