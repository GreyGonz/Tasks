<template>
  <div class="app">
    <div class="content">
      <div class="card">
        <h3>Login</h3>
        <input type="text" name="email" value="email">
        <input type="text" name="passwd" value="password">
        <div class="actions">
          <button>Login</button>
          <button>Register</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Login'
  }
</script>

<style>
  html {
    height: 100%;
  }

  body {
    height: 100%;
  }

  .content {
    /*position: absolute;*/
    margin: 0;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .card {
    display: flex;
    flex-direction: column;
    box-shadow: 0px 0px 22px 2px;
    background: whitesmoke;
    border-radius: 2px;
    padding: 5px;
  }

  .card input {
    margin: 2.5px 0px;
  }

  .card .actions {
    display: flex;
    justify-content: space-between;
  }

</style>