<!DOCTYPE html>
<html >
<meta charset="UTF-8">
<head>
<?php require_once('head.php') ?>
</head>
<?php require_once('header.php') ?>
<style>
.img-container-404 {
width: 40%;
display: flex;
align-items: center;
justify-content: center;
}
.img-404{
width: 60%;
filter: drop-shadow(15px 10px 6px #392b1d);
}
.text-404{
width: 60%;
height: 100%;
align-items: center;
display: flex;
justify-content: center;
flex-direction: column;
font-family: var(--title-font);
font-size: 3em;
}
.text-404 p, .text-404 a{
    font-size: 0.9em;
    margin: 1%;
    font-family: var(--text-font);
    text-align: center;
}
.container-404{
    display: flex;
    height: 100vh;
    background-color: #ffeac35e;
}
body{
    margin: 0;
}
.home{
    color:var(--first-color);
    text-decoration: underline;
}
.home:hover{
    color: white;
}
@media screen and (max-aspect-ratio: 1260/930){
    .img-404{
        width: 80%;
    }
    .text-404{
        font-size: 2em;
    }
}
@media screen and (orientation: portrait) {
    .container-404{
        flex-direction: column;
        margin-top:10vh;
    }
    .img-container-404, .text-404{
        width: 100%;
        height: auto;
        margin-top: 5%;
    }
    .img-404{
        width:50%;
    }
}
</style>

<body>
    <div class="container-404">
        <div class="img-container-404">
            <img class='img-404' src='Resources/sad-afr.png' alt='Грустная афродита'>
        </div>
        <div class="text-404">
            <h1>404</h1>
            <p>Страница не найдена...</p>
            <p>Возможно, она была удалена,</p>
            <p>а может ее и не существовало вовсе...</p>
            <a href="/" class="home">На главную</a>
        </div>
    </div>
</body>
<?php require_once('footer.php') ?>
</html>