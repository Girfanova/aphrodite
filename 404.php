<!DOCTYPE html>
<html >
<meta charset="UTF-8">
<head>
<?php require_once('head.html') ?>
</head>
<?php require_once('header.php') ?>
<style>

.img-404{
width:20vh;
}

.text-404{
width: 100%;
height: 100%;
align-items: center;
display: flex;
justify-content: center;
flex-direction: column;
/* font-family: var(--first-title-font); */
font-size: 5em;
}
.text-404 p, .text-404 a{
    font-size: 0.3em;
    margin: 1%;
    font-family: var(--text-font);
    text-align: center;
}
.container-404{
    display: flex;
    height: 100vh;
    background-color: #ffeac35e;
}

.home{
    color:var(--first-color);
    text-decoration: underline;
}
.home:hover{
    color: var(--third-color);
}

</style>

<body>
    <div class="container-404">
        <div class="text-404">
            <img class="img-404" src='Resources/sad.svg'>
            <h1>404</h1>
            <p>Страница не найдена...<br>Возможно, она была удалена,<br>а может ее и не существовало вовсе...</p>
            <a href="/" class="home">Перейти на главную</a>
        </div>
    </div>
</body>
<?php require_once('footer.html') ?>
</html>