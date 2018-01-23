<template>
  <v-app dark>
    <v-container>
      <v-layout column>
        <v-flex xs12 text-xs-center mt-5>
          <h1>Welcomemes!</h1>
        </v-flex>
        <v-flex xs12 text-xs-center>
          <v-btn primary to="/login">Login</v-btn>
          <v-btn to="/register">Register</v-btn>
        </v-flex>
      </v-layout>
    </v-container>
  </v-app>
</template>