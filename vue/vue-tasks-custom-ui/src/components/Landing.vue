<template>
<div>
  <div class="bg">
    <span class="title">Landing</span>
    <span class="subtitle">A Vue project with CSS</span>
    <span class="author">by Gerard Rey González</span>
    <!--<img src="http://i.imgur.com/8qR03.jpg">-->
    <img src="https://images7.alphacoders.com/403/403375.jpg">
  </div>
  <div class="content">
    <div class="card">
      <i class="fab fa-vuejs"></i>
      <h3 class="card-title">Vue</h3>
      <span></span>
    </div>
    <div class="card">
      <i class="fab fa-css3-alt"></i>
      <h3 class="card-title">CSS</h3>
    </div>
  </div>
  <div class="bg2">
    <img src="https://images7.alphacoders.com/403/403375.jpg">
  </div>
</div>
</template>

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
    position: relative;
    background: #4f4f4f;
    display: grid;
    grid-template-columns: 200px auto;
    grid-template-rows: 100%;
    -webkit-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    -moz-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
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

  .title {
    font-family: 'Titillium Web';
    font-weight: bold;
    font-size: 72px;
    position: absolute;
    color: whitesmoke;
    top: 25%;
  }

  .subtitle {
    font-family: Roboto;
    font-size: 24px;
    position: absolute;
    color: whitesmoke;
    top: 55%;
  }

  .author {
    font-family: Roboto;
    font-size: 18px;
    position: absolute;
    color: whitesmoke;
    top: 65%;
  }

  .bg {
    position: relative;
    display: flex;
    justify-content: center;
    /*background: url(http://i.imgur.com/8qR03.jpg) no-repeat center;*/
    background: url(https://images7.alphacoders.com/403/403375.jpg) no-repeat center;
    background-size: contain;
    margin: 0;
    padding: 0;
    align-items: center;
    z-index: -1;
  }
  .bg img {
    visibility: hidden;
    display: block;
    width: 100%;
    margin: 0;
  }

  .bg2 {
    position: relative;
    background: url(https://images7.alphacoders.com/403/403375.jpg) no-repeat center;
    background-size: contain;
    margin: 0;
    padding: 0;
    align-items: center;
    z-index: -1;
  }
  .bg2 img {
    visibility: hidden;
    display: block;
    width: 100%;
    margin: 0;
  }

  .content {
    position: relative;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    margin: 0;
    padding: 20px 300px;
    height: 200px;
    -webkit-box-shadow: 0px 0px 20px 13px rgba(124,255,241,0.30);
    -moz-box-shadow: 0px 0px 20px 13px rgba(124,255,241,0.30);
    box-shadow: 0px 0px 20px 13px rgba(124,255,241,0.30);
  }

  .card {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 200px;
    padding: 10px;
    border-radius: 3px;
    -webkit-box-shadow: 0px 0px 20px 5px rgba(0,0,0,0.15);
    -moz-box-shadow: 0px 0px 20px 5px rgba(0,0,0,0.15);
    box-shadow: 0px 0px 20px 5px rgba(0,0,0,0.15);
  }

  .card-title {
    margin: 0;
    padding: 0;
  }

  footer {
    position: relative;
    font-size: 12px;
    color: #424242;
    width: 100%;
    padding: 5px;
    -webkit-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    -moz-box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
    box-shadow: 0px 0px 20px 13px rgba(245,190,41,0.30);
  }

  footer p {
    margin: 0;
    padding: 0;
  }

</style>
