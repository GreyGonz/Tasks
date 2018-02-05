<template>
  <div>
    <header>
      <div class="logo">
        <h3>Welcome</h3>
      </div>
      <nav>
        <ul>
          <li><router-link :to="{ path: 'login' }">Login</router-link></li>
          <li><router-link :to="{ path: 'register' }">Register</router-link></li>
          <li><router-link :to="{ path: '/'}">Home</router-link></li>
        </ul>
      </nav> 
    </header>
  </div>
</template>

<script>
export default {
  name: 'layout'
}
</script>

<style>

  body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
  }

  header {
    background: #4f4f4f;
    display: grid;
    grid-template-columns: 200px auto;
    grid-template-rows: 100%;
  }

  .logo {
    display: flex;
    justify-content: center;
    align-items: center;
    grid-column: 1;
    grid-row: 1;
    color: whitesmoke;
  }

  nav {
    display: flex;
    justify-content: flex-end;
    align-items: stretch;
    grid-column: 2;
    grid-row: 1;
  }

  ul {
    background: #919191;
    width: 25%;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-around;
    align-items: stretch;
    list-style-type: none;
  }

  li {
    display: flex;
    align-items: stretch;
  }

  a {
    color: whitesmoke;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
  }

</style>
