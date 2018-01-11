<template>
  <body class="hold-transition login-page">
     <div class="login-box">
    <div class="login-logo">
      <a href="#/"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form @submit.prevent="submit" method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" v-model="email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" v-model="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
          Facebook</a>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
          Google+</a>
      </div>
      <!-- /.social-auth-links -->

      <a href="#">I forgot my password</a><br>
      <a href="#" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
  </div>
  </body>
</template>

<script>

import axios from 'axios'

export default {
  name: 'login',
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    submit () {
      axios.post('http://localhost:8081/oauth/token', {
        'grant_type': 'password',
        'client_id': 2,
        'client_secret': 'JrNu0gFHRGT2OSgF3gg74rbhKDN300qlsimvrhcM',
        'username': this.email,
        'password': this.password
      }).then(response => {
        console.log('Hey boi')
        console.log(response)
        console.log(response.data)
      }).catch(error => {
        console.log('ERROR ' + error)
      })
    }
  }
}
</script>

