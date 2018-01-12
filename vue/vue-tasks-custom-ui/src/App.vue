<template>
    <body>
        <div class="container">
            <main>
                <section class="content-header">CONTENT HEADER</section>
                <section>content header 2</section>
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
        border: solid black 1px;
        padding: 0.5em;
    }

    main {
        background: #0a568c;
        grid-row: 2;
        grid-column: 2;
    }

    header {
        background: #00a157;
        grid-row: 1;
        grid-column-start: 1;
        grid-column-end: 4;
    }

    .left-side-bar {
        grid-row: 2;
        grid-column: 1;
    }

    .right-side-bar {
        grid-row: 2;
        grid-column: 3;
    }
    section {
        background: #2e9ad0;
    }

    footer {
        background: #2e383c;
        color: whitesmoke;
        grid-row: 3;
        grid-column-start: 1;
        grid-column-end: 4;
    }

    .content-header {
        background: #9cc2cb;
    }
</style>
