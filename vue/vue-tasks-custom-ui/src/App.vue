<template>
    <body>
        <div class="container">
            <main>
                <section>CONTENT</section>
                <section>CONTENT</section>
            </main>
            <aside class="left-side-bar">
                aside left
            </aside>
            <aside class="right-side-bar">
                aside right
            </aside>
            <footer>Footer</footer>
            <header>
                <!-- <i class="fa fa-address-card"></i> -->
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                HEADER
            </header>
        </div>
    </body>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style>
    body, html, .container {
        margin: 0;
        height: 100%;
    }
    body {
        font-family: monospace;
        font-weight: 500;
        font-size: 14px;
        color: #333;
    }
    .icon {
        display: inline;
        height: 1em;
        width: 1em;
        fill: currentColor;
    }

    .container {
        display: grid;
        grid-template-columns: 100px 1fr 100px;
        grid-template-rows: 150px 1fr 100px;
    }

    main, header, footer, aside, section {
        display: grid;
        /*border: solid black 1px;*/
        padding: 0.5em;
    }

    main {
        background: #ECEFF5;
        grid-row: 2;
        grid-column: 2;
    }

    .content-header {
        position: relative;
        padding: 10px;
    }

    header {
        background: #4e8aba;
        color: #FFFFFF;
        grid-row: 1;
        grid-column-start: 1;
        grid-column-end: 4;
    }

    aside {
        background: #283135;
    }
    .left-side-bar {
        grid-row-start: 2;
        grid-row-end: 4;
        grid-column: 1;
    }

    .right-side-bar {
        grid-row-start: 2;
        grid-row-end: 4;
        grid-column: 3;
    }
    section {
        background: #FFFFFF;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }

    footer {
        background: #FFFFFF;
        color: #464646;
        border-top: 1px solid #d2d6de;
        grid-row: 3;
        grid-column-start: 2;
        grid-column-end: 3;
    }
</style>
