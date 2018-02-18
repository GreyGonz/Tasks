<template>
  <div>
    <div class="timeline">
      <div class="timeline-event">
        <v-badge class="timeline-badge blue" >
         <v-icon color="white">home</v-icon>
        </v-badge>
        <div class="timeline-content">
          <v-card>
            <v-card-title primary-title>
              <div>
                <h3 class="headline mb-0">Event 1</h3>
                <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
              </div>
            </v-card-title>
          </v-card>
        </div>
      </div>
      <div class="timeline-event">
        <div class="timeline-badge red">
          <v-icon color="white">language</v-icon>
        </div>
        <div class="timeline-content">
          <v-card>
            <v-card-title primary-title>
              <div>
                <h3 class="headline mb-0">Event 2</h3>
                <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
              </div>
            </v-card-title>
          </v-card>
        </div>
      </div>
      <div class="timeline-event">
        <div class="timeline-badge green">
          <v-icon color="white">mail</v-icon>
        </div>
        <div class="timeline-content">
          <v-card>
            <v-card-title primary-title>
              <div>
                <h3 class="headline mb-0">Event 3</h3>
                <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
              </div>
            </v-card-title>
          </v-card>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
  .timeline {
    position: relative;
  }

  .timeline .timeline-event {
    position: relative;
    padding-top: 5px;
    padding-bottom: 5px;
  }

  .timeline .timeline-event .timeline-content {
    position: relative;
    /*left: 70px;*/
  }

  .timeline .timeline-badge {
    /*display:block;*/
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    top: calc(50% - 20px);
    text-align: center;
    cursor: default;
    z-index: 1;
  }

  .timeline .timeline-badge i {
    line-height: 40px;
  }

  .timeline .timeline-event:before {
    display: block;
    content: "";
    width: 2px;
    height: calc(50%);
    position: absolute;
    background: #d2d2d2;
    top: 0;
  }

  .timeline .timeline-event:after{
    display: block;
    content: "";
    width: 2px;
    height: calc(50%);
    position: absolute;
    background: #d2d2d2;
    top: calc(50% );
  }

  .timeline .timeline-event:nth-child(even):before {
    left: calc(100% + 35px);
  }

  .timeline .timeline-event:nth-child(even):after {
    left: calc(100% + 35px);
  }

  .timeline .timeline-event:nth-child(odd):before {
    left: calc(0% - 35px);
  }

  .timeline .timeline-event:nth-child(odd):after {
    left: calc(0% - 35px);
  }

  .timeline .timeline-event:nth-child(even) .timeline-badge {
    display: block;
    position: absolute;
    left: calc(100% + 15px);
  }

  .timeline .timeline-event:nth-child(odd) .timeline-badge {
    display: block;
    position: absolute;
    left: calc(0% - 55px);
  }

  .timeline .timeline-event:last-child::after {
    display: none;
  }

  .timeline .timeline-event:nth-child(even) {
    left: calc(-50% - 30px);
  }
  .timeline .timeline-event:nth-child(odd) {
    left: calc(50% + 40px);
  }

  @media (max-width: 600px) {
    .timeline .timeline-event:nth-child(even):before {
      left: calc(0% - 35px);
    }

    .timeline .timeline-event:nth-child(even):after {
      left: calc(0% - 35px);
    }

    .timeline .timeline-event:nth-child(even) .timeline-badge {
      display: block;
      position: absolute;
      left: calc(0% - 55px);
    }

    .timeline .timeline-event:nth-child(odd) .timeline-badge {
      display: block;
      position: absolute;
      left: calc(0% - 55px);
    }

    .timeline .timeline-event:nth-child(even) {
      left: 40px;
    }
    .timeline .timeline-event:nth-child(odd) {
      left: 40px;
    }
  }
</style>

<script>

</script>