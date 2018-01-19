<template>
    <body>
        <div class="container">
            <div class="logo">
                <b>Admin</b>LTE
            </div>
            <nav>
                <a class="hamburger" href="#">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </a>
                <ul class="nav-ul">
                    <li class="nav-ul-li">
                        <a href="#mail">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/></svg>
                        </a>
                    </li>
                    <li class="nav-ul-li">
                        <a href="#notification">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 8v7h8V8a4 4 0 1 0-8 0zm2.03-5.67a2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8a6 6 0 0 1 4.03-5.67zM12 18a2 2 0 1 1-4 0h4z"/></svg>
                        </a>
                    </li>
                    <li class="nav-ul-li">
                        <a href="#tasks">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.667 12H2v8H0V0h12l.333 2H20l-3 6 3 6H8l-.333-2z"/></svg>
                        </a>
                    </li>
                    <li class="nav-ul-li">
                        <a href="#user">
                            <img class="avatar rounded" src="http://www.gravatar.com/avatar/6ffd322530fce5d7edf1059c5b76f95a.jpg"/>
                            logged_user
                        </a>
                    </li>
                    <li class="nav-ul-li"><a href="#preferences">preferences</a></li>
                </ul>
            </nav>
            <main>
                <section>CONTENT</section>
                <section>CONTENT</section>
            </main>
            <aside class="left-side-bar">
                <div class="user-panel">
                    <div>
                        <img class="avatar rounded" src="http://www.gravatar.com/avatar/6ffd322530fce5d7edf1059c5b76f95a.jpg"/>
                    </div>
                    <div>
                        <p>Gerard Rey González</p>
                        <svg height="14" width="14">
                            <circle cx="7" cy="7" r="3" stroke="#3d763e" stroke-width="1" fill="#3d763e" />
                        </svg>
                        Online
                    </div>
                </div>
                <form action="">
                    <input type="text" placeholder="Search" />
                    <button type="submit">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                    </button>
                </form>
                <nav>
                    <ul>
                        <li class="header">Menu</li>
                        <li><a href="#dashboard">Dashborad</a></li>
                        <li><a href="">asdf</a></li>
                        <li><a href="">adsf</a></li>
                        <li><a href="">asdf</a></li>
                        <li><a href="">asdf</a></li>
                        <li><a href="">asdf</a></li>
                        <li><a href="">asdf</a></li>
                        <li><a href="">asdf</a></li>
                    </ul>
                </nav>
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

    .rounded {
        border-radius: 50%;
    }

    .icon {
        display: inline-block;
        height: 1em;
        width: 1em;
        fill: currentColor;
    }

    .container {
        display: grid;
        grid-template-columns: 200px 1fr 200px;
        grid-template-rows: 40px 1fr 40px;
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
        align-items: center;
    }

    .logo:hover {
        background: #357ca5;
    }

    nav {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        grid-row:1;
        grid-column: 2/4;
        padding: 0;
        background: #4e8aba;
        color: #fff;      
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

    .avatar {
        width: 30px;        
    }
    
    ul, li {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-ul {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        margin: 0;
    }

    .nav-ul-li {
        display: flex;
        justify-content: center;
        align-items: stretch;
    }

    .nav-ul-li:hover {
        background: #417DA6;
    }

    .nav-ul-li a {
        display: flex;
        align-items: center;
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

    .user-panel {
        display: flex;
        padding: 10px;
        height: 45px;
    }

    .user-panel .avatar {
        width: 45px;
    }

    .user-panel p {
        margin: 0;
        padding: 0 10px;
    }

    .left-side-bar nav {
        background:#283135;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

    .left-side-bar ul {
        display: flex;
        flex-direction: column;
        margin: 0;
        background: #283135;
    }

    .left-side-bar li {
        display: flex;
        justify-content: flex-start;
        align-items: stretch;
    }

    .left-side-bar a {
        padding: 10px;
        width: 100%;
        color: #b8c7ce;
    }

    .left-side-bar a:hover {
        background: #242C30;
        color: white;
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
