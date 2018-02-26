<template>
  <div class="layout-app">
    <header>
      <div class="logo">
        <h3>Landing</h3>
      </div>
      <nav>
        <ul>
          <li><router-link :to="{ path: '/'}">Home</router-link></li>
          <div class="login">
            <li><router-link :to="{ path: 'login' }">Login</router-link></li>
            <li><router-link :to="{ path: 'register' }">Register</router-link></li>
          </div>
        </ul>
      </nav>
    </header>
    <main>
      <router-view></router-view>
    </main>
    <footer>
      <p>Gerard Rey Gonzàlez 2018</p>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'layout'
}
</script>

<style>

  @import url(https://fonts.googleapis.com/css?family=Titillium+Web);
  @import url(https://fonts.googleapis.com/css?family=Roboto);
  @import url(https://use.fontawesome.com/releases/v5.0.6/css/all.css);

  body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
  }

  header {
    background: #4f4f4f;
    grid-row: 1;
    display: grid;
    grid-template-columns: 200px auto;
    grid-template-rows: 100%;
    -webkit-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    -moz-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
  }

  .layout-app {
    height: 100%;
    display: grid;
    grid-template-columns: 100%;
    grid-template-rows: 50px auto 25px;
  }

  main {
    height: 100%;
    width: 100%;
    grid-row: 2;
    background: #272725;
    z-index: -1;
  }

  .logo {
    font-family: 'Titillium Web';
    font-size: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
    grid-column: 1;
    grid-row: 1;
    color: whitesmoke;
  }

  h3 {
    margin: 10px;
  }

  nav {
    display: flex;
    justify-content: flex-end;
    align-items: stretch;
    grid-column: 2;
    grid-row: 1;
  }

  ul {
    /*background: #919191;*/
    width: 25%;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-between;
    align-items: stretch;
    list-style-type: none;
  }

  .login {
    display: flex;
    flex-direction: row;
    padding-right: 10px;
  }

  li {
    display: flex;
    align-items: stretch;
    padding: 0px 10px;
  }

  li:hover {
    background: #65552B;
  }

  a {
    font-family: Roboto;
    color: whitesmoke;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
  }

  i {
    font-size: 40px;
  }

  footer {
    font-size: 12px;
    color: #424242;
    padding: 5px;
    -webkit-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    -moz-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    grid-row: 3;
  }

  footer p {
    margin: 0;
    padding: 0;
  }

</style>
