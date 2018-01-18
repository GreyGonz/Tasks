<template>
    <body>
        <div class="container">
            <div class="logo">
                <span>HEADER</span>
            </div>
            <nav>
                <a class="hamburger" href="#">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </a>
                <ul class="nav-ul">
                    <li class="nav-ul-li"><a href="#">mail</a></li>
                    <li class="nav-ul-li"><a href="#">notification</a></li>
                    <li class="nav-ul-li"><a href="#">tasks</a></li>
                    <li class="nav-ul-li"><a href="#">logged_user</a></li>
                    <li class="nav-ul-li"><a href="#">preferences</a></li>
                </ul>
            </nav>
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

    a {
        text-decoration: none;
        color: inherit;
    }

    .icon {
        display: inline-block;
        height: 1em;
        width: 1em;
        fill: currentColor;
    }

    .container {
        display: grid;
        grid-template-columns: 150px 1fr 150px;
        grid-template-rows: 40px 1fr 40px;
    }

    main, header, footer, aside, section {
        padding: 1.2em;
    }

    main {
        background: #ECEFF5;
        grid-row: 2;
        grid-column: 2;
    }

    .logo {
        display: flex;
        background: #417DA6;
        color: #FFFFFF;
        grid-row: 1;
        grid-column: 1;
        justify-content: center;
    }

    .logo span {
        margin-top: auto;
        margin-bottom: auto;
    }

    nav {
        display: flex;
        flex-direction: row;
        background: #4e8aba;
        color: #fff;
        grid-row:1;
        grid-column: 2/4;
        padding: 0;
        justify-content: space-between;
    }

    .hamburger {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0 1em;   
    }

    .hamburger:hover {
        background: #417DA6;
    }

    ul, li {
        list-style: none;
    }

    .nav-ul {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        margin: 0;
    }

    .nav-ul-li:hover {
        background: #417DA6;
    }

    .nav-ul-li {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0 0.5em;
    }

    aside {
        background: #283135;
        color: #fff;
    }

    .left-side-bar {
        grid-row: 2/4;
        grid-column: 1;
    }

    .right-side-bar {
        grid-row: 2/4;
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
        grid-column: 2/4;
    }
</style>
