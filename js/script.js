window.onload = function () {
    const parallax = document.querySelector(".parallax");

    if (parallax) {
        const text = document.querySelector(".main_caption__text");
        const imageAfr = document.querySelector(".afr");

        const forText = 60;
        const forImageAfr = 20;

        const speed = 0.03;

        let positionX = 0, positionY = 0;
        let coordXprocent = 0, coordYprocent = 0;

        parallax.addEventListener("mousemove", function (e) {
            const parallaxWidth = parallax.offsetWidth;
            const parallaxHeight = parallax.offsetHeight;

            const coordX = e.pageX - parallaxWidth / 2;
            const coordY = e.pageY - parallaxHeight / 2;

            coordXprocent = coordX / parallaxWidth * 100;
            coordYprocent = coordY / parallaxHeight * 100;
        })
        setMouseParallaxStyle();
        function setMouseParallaxStyle() {
            const distX = coordXprocent - positionX;
            const distY = coordYprocent - positionY;

            positionX += distX * speed;
            positionY += distY * speed;

            text.style.cssText = `transform:translate(${positionX / forText}%, ${positionY / forText}%)`;
            imageAfr.style.cssText = `transform:translate(${positionX / forImageAfr}%, ${positionY / forImageAfr}%)`;
            requestAnimationFrame(setMouseParallaxStyle);
        }
    }


};
var map = document.getElementById('map');
var address1 = document.getElementById('address1');
var address2 = document.getElementById('address2');
var map_container = document.getElementById('map-container');
var address1_num = document.getElementById('address1_num');
var address2_num = document.getElementById('address2_num');
function address1_show() {
    if (!address1.classList.contains('checked')) {
        map.src = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d575.3354922252689!2d56.07967746334676!3d54.77395549999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43d9384745f701c5%3A0x588f801b147a90ab!2z0YPQuy4g0K7RgNC40Y8g0JPQsNCz0LDRgNC40L3QsCwgNjAsINCj0YTQsCwg0KDQtdGB0L8uINCR0LDRiNC60L7RgNGC0L7RgdGC0LDQvSwgNDUwMTA1!5e0!3m2!1sru!2sru!4v1687283595052!5m2!1sru!2sru";
        address2.classList.remove('checked');
        address1.classList.toggle('checked');
        address1_num.style.display = 'inline';
        address2_num.style.display = 'none';
    }
}
function address2_show() {
    if (!address2.classList.contains('checked')) {
        map.src = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9207.515978860847!2d56.04980389497779!3d54.764514234808736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43d9384b5394a4bf%3A0x4116b0d37046a6af!2z0JDRhNGA0L7QtNC40YLQsA!5e0!3m2!1sru!2sru!4v1687459893694!5m2!1sru!2sru";
        address1.classList.remove('checked');
        address2.classList.toggle('checked');
        address2_num.style.display = 'inline';
        address1_num.style.display = 'none';
    }
}

var menu = document.getElementById('menu');
var menu_burg = document.getElementById('menu-burg');
var op_sublist = document.getElementById('op_menu_sub-list');
var header = document.getElementById('header');
var authorization_btn = document.querySelector('.header_authorization_btn');
menu_burg.addEventListener('click', function () {
    if (menu.classList.contains('active')) {
        document.querySelector('.menu_sub-list').classList.remove('active');
        menu.classList.remove('active');
        menu_burg.classList.remove('active');
        if (authorization_btn) authorization_btn.classList.remove('active');
        if (window.scrollY < window.screen.height / 3) {
            // header.style.background = "rgba(0, 0, 0, 0.558)";
            header.classList.add('header-active');
            header.classList.remove('header-not-active');
            // document.querySelector('.menu_sub-list').style.background = "rgba(0, 0, 0, 0.558)";
        }
        document.body.style.overflow = "visible";
    }
    else {
        // document.querySelector('.menu_sub-list').style.background = "black";
        menu.classList.toggle('active');
        menu_burg.classList.toggle('active');
        if (authorization_btn) authorization_btn.classList.toggle('active');
        document.body.style.overflow = "hidden";
    }
})
op_sublist.addEventListener('click', function () {
    if ((/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) || (window.innerWidth < 1000)) {
        const menu = document.querySelector('.menu_sub-list');
        if (menu.classList.contains('active')) {
            menu.classList.remove('active');
        }
        else {
            menu.classList.toggle('active');
        }
    }
})


var popup = document.querySelector('.popup');
var log_btn = document.querySelector('.popup-choice__log');
var reg_btn = document.querySelector('.popup-choice__reg');
var log_form = document.querySelector('.popup-form__log');
var reg_form = document.querySelector('.popup-form__reg');
var close_btn = document.getElementById("close-btn");
var open_btn = document.querySelector(".authorization");


var open_header_btn = document.querySelector(".header_authorization_btn");
var open_authorization_btn = document.querySelector(".authorization_btn");
if (popup) {
    if (reg_btn) reg_btn.addEventListener("click", function () {
        if (!reg_btn.classList.contains('popup-choice_checked')) {
            log_btn.classList.remove('popup-choice_checked');
            reg_btn.classList.toggle('popup-choice_checked');
            log_form.style.display = "none";
            reg_form.style.display = "block";
        }
    })
    if (log_btn) log_btn.addEventListener("click", function () {
        if (!log_btn.classList.contains('popup-choice_checked')) {
            reg_btn.classList.remove('popup-choice_checked');
            log_btn.classList.toggle('popup-choice_checked');
            reg_form.style.display = "none";
            log_form.style.display = "block";
        }
    })
    close_btn.addEventListener("click", function () {
        closePopup();
    })
    if (open_btn) {
        open_btn.addEventListener("click", function () {
            popup.classList.toggle("popup_open");
            document.body.style.overflow = "hidden";
        })
    }
    if (open_header_btn) {
        open_header_btn.addEventListener("click", function () {
            popup.classList.toggle("popup_open");
            document.body.style.overflow = "hidden";
        })
    }
    if (open_authorization_btn) {
        open_authorization_btn.addEventListener("click", function () {
            popup.classList.toggle("popup_open");
            log_btn.classList.remove('popup-choice_checked');
            reg_btn.classList.toggle('popup-choice_checked');
            log_form.style.display = "none";
            reg_form.style.display = "block";
            document.body.style.overflow = "hidden";
        })
    }
}

function openRegPopup() {
    var popup = document.querySelector('.popup');
    popup.classList.toggle("popup_open");
    document.body.style.overflow = "hidden";
    log_btn.classList.remove('popup-choice_checked');
            reg_btn.classList.toggle('popup-choice_checked');
            log_form.style.display = "none";
            reg_form.style.display = "block";
}
function openPopup() {
    var popup = document.querySelector('.popup');
    popup.classList.toggle("popup_open");
    document.body.style.overflow = "hidden";
}
function closePopup() {
    popup.classList.remove("popup_open");
    document.body.style.overflow = "visible";
    if (document.querySelector('.form-body'))
        document.querySelector('.form-body').innerHTML = '';
}
var offset = 0;
var sliderLine = document.querySelector(".slider__items");
var prew_btn = document.querySelector(".prew-btn");
var next_btn = document.querySelector(".next-btn");

if (sliderLine) {
    let timeOut = 7000;
    timer = setInterval(nextSlide, timeOut);

    function nextSlide() {
        offset += 100;
        if (offset > 200) offset = 0;
        sliderLine.style.left = -offset + '%';
    }

    next_btn.addEventListener('click', function () {
        offset += 100;
        if (offset > 200) offset = 0;
        sliderLine.style.left = -offset + '%';
        clearInterval(timer);
        timer = setInterval(nextSlide, timeOut);
    })
    prew_btn.addEventListener('click', function () {
        offset -= 100;
        if (offset < 0) offset = 200;
        sliderLine.style.left = -offset + '%';
        clearInterval(timer);
        timer = setInterval(nextSlide, timeOut);
    })
}

//Прокрутка и появление меню
var menu_list = document.querySelectorAll('.menu_list a');
var logo = document.getElementById('logo');
var auth_circle = document.getElementById('auth_circle');
var authorization = document.getElementById('auth');
function clear_bgr_menu() {
    header.classList.add('header-not-active');
    header.classList.remove('header-active');
    header.classList.remove('header');
    for (let menu_list_a of menu_list)
        menu_list_a.style.color = "black";
    // logo.src = "Resources/логотип11-черный.png";
    logo.style.filter = "invert(0)";
    if (auth_circle) {
        auth_circle.style.background = 'none';
        auth_circle.style.color = 'black';
        auth_circle.style.border = '3px solid';
    }
    if (authorization) authorization.style.filter = "invert(0)";
    // document.querySelector('.menu_sub-list').style.background = "rgba(0, 0, 0, 0)";
    if (menu_burg) {
        menu_burg.classList.add('black-menu-burg');
        menu_burg.classList.remove('white-menu-burg');
    }
}
function black_bgr_menu() {
    header.classList.add('header-active');
    header.classList.remove('header-not-active');
    for (let menu_list_a of menu_list)
        menu_list_a.style.color = "white";
    // logo.src = "Resources/логотип11.png";
    logo.style.filter = "invert(1)";
    if (authorization) authorization.style.filter = "invert(1)";
    if (auth_circle) {
        auth_circle.style.background = 'none';
        auth_circle.style.color = 'white';
        auth_circle.style.border = '3px solid';
    }
    if (menu_burg) {
        menu_burg.classList.add('white-menu-burg');
        menu_burg.classList.remove('black-menu-burg');
    }
}
if (document.location.pathname == '/') {
    window.addEventListener('scroll', function () {
        if (scrollY > window.screen.height / 5) {
            black_bgr_menu();
        } else {
            clear_bgr_menu();
        }
    })

    header.addEventListener("mouseover", black_bgr_menu);
    header.addEventListener("mouseout", function () {
        if ((scrollY < window.screen.height / 5) & (!menu.classList.contains('active')))
            clear_bgr_menu();

    });
}
else {
    black_bgr_menu();
}



//Проверка полей входа
var password_log = document.getElementById("password_log");
if (password_log) password_log.addEventListener('input', () => passwordCheckcount(password_log));
function passwordCheckcount(password) {
    if (document.querySelector('#message-block-log')) document.querySelector('#message-block-log').innerHTML = '';
    if (password.value.length < 8) {
        password.style.borderColor = "red";
        document.querySelector(`[for="${password.id}"]`).innerHTML = 'Пароль меньше 8 символов';
        // document.getElementById("password_log_label").innerHTML = 'Пароль меньше 8 символов';
    }
    else {
        password.style.borderColor = "green";
        document.querySelector(`[for="${password.id}"]`).innerHTML = '';
    }
}
//Проверки введенных полей 
var password_reg = document.getElementById("password_reg");
var password_reg2 = document.getElementById("password_reg2");


function isTextValid(value) {
    const KIRILLITSA = /[^а-яА-ЯёЁ ]/i;
    return KIRILLITSA.test(value);
}

function checkInputText(text_block) {
    if (!(isTextValid(text_block.value))) {
        text_block.style.borderColor = 'green';
        document.getElementById(text_block.name + '_label').innerHTML = '';
        return true;
    }
    else {
        text_block.style.borderColor = "red";
        document.getElementById(text_block.name + '_label').innerHTML = "Вводите только кириллицу";
        return false;
    }
}

function passwordCheck() {
    if (!(password_reg.value == password_reg2.value)) {
        password_reg.style.borderColor = "red";
        password_reg2.style.borderColor = "red";
        document.getElementById("password_reg_label2").innerHTML = 'Пароли не совпадают';
        return false;

    }
    else {
        password_reg.style.borderColor = "green";
        password_reg2.style.borderColor = "green";
        document.getElementById("password_reg_label2").innerHTML = '';
        return true;

    }
}
function passwordCheckcount_reg() {
    if (password_reg.value.length < 8) {
        password_reg.style.borderColor = "red";
        document.getElementById("password_reg_label").innerHTML = 'Пароль меньше 8 символов';
        return false;
    }
    else if (!/[A-Za-zА-Яа-я]/.test(password_reg.value)) {
        password_reg.style.borderColor = "red";
        document.getElementById("password_reg_label").innerHTML = 'Пароль должен содержать хотя бы одну букву';
        return false;
    }
    else if (!/\d/.test(password_reg.value)) {
        password_reg.style.borderColor = "red";
        document.getElementById("password_reg_label").innerHTML = 'Пароль должен содержать хотя бы одну цифру';
        return false;
    }
    else {
        password_reg.style.borderColor = "green";
        document.getElementById("password_reg_label").innerHTML = '';
        return true;
    }
}
if (password_reg) password_reg.addEventListener('input', passwordCheckcount_reg);
if (password_reg2) password_reg2.addEventListener('input', passwordCheck);

var auth_btn = document.getElementById("auth-btn");

//обработка регистрации
if (document.getElementById('popup-form-reg')) document.getElementById('popup-form-reg').addEventListener('submit', function (event) {
    var surname = document.getElementById('surname').value;
    var name = document.getElementById('name').value;
    var password = password_reg.value;
    var phone = document.getElementById('phone_reg').value;
    if (checkInputText(document.getElementById('surname')) && checkInputText(document.getElementById('name')) && passwordCheck() && passwordCheckcount_reg() && /^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/.test(phone)) {
        event.preventDefault();
        $.ajax({
            url: "requests/registration.php",
            method: "post",
            dataType: 'json',
            data: { surname: surname, name: name, password_reg: password, phone_reg: phone },
            beforeSend: function () {
                document.querySelector('#message-block-reg').innerHTML = "Проверка данных...";
                document.querySelector('#message-block-reg').style.color = 'grey';
            },
            success: function (res) {
                document.querySelector('#message-block-reg').innerHTML = res['message'];
                document.querySelector('#message-block-reg').style.color = 'green';
                if (res['status'] == 'success'){
                    setTimeout(() => location.href = 'lk.php', 1500);
                    // setTimeout(() => location.reload(), 1500);
                }
                   
                else {
                    document.querySelector('#message-block-reg').style.color = 'red';
                    document.querySelector('#phone_reg').style.borderColor = 'red';
                }
            }

        });
        return false;
    }
    else {
        document.querySelector("#message-block-reg").innerHTML = "Проверьте введенные данные";
        document.querySelector('#message-block-reg').style.color = 'red';
        return false;
    }
})
//обработка входа
if (document.getElementById('popup-form-log')) document.getElementById('popup-form-log').addEventListener('submit', function (event) {
    var password = document.getElementById('password_log').value;
    var phone = document.getElementById('phone_log').value;
    if (/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/.test(phone)) {
        event.preventDefault();
        $.ajax({
            url: "requests/login.php",
            method: "post",
            dataType: 'json',
            beforeSend: function () {
                document.querySelector('#message-block-log').innerHTML = "Проверка данных...";
                document.querySelector('#message-block-log').style.color = 'grey';
            },
            data: { password_log: password, phone_log: phone },
            success: function (res) {
                document.querySelector('#message-block-log').innerHTML = res['message'];
                if (res['status'] == 'success'){
                    document.querySelector('#message-block-log').style.color = 'green';
                    setTimeout(() => location.href = 'lk.php', 1500);
                    // setTimeout(() => location.reload(), 1500);

                }
                else document.querySelector('#message-block-log').style.color = 'red';
            }
        });
        return false;
    }
    else { 
        document.querySelector("#message-block-log").innerHTML = "Проверьте введенные данные";
        document.querySelector('#message-block-log').style.color = 'red';
        return false;
    }
})
//редактирование профиля
var formEditProfile = document.querySelector('#form-edit-profile');
if (formEditProfile) formEditProfile.addEventListener('submit', checktruevalueEdit);
function checktruevalueEdit() {
    var surnameEdit = document.getElementById('surname_edit');
    var nameEdit = document.getElementById('name_edit');
    // var phoneEdit = document.getElementById('phone_edit');
    if ((checkInputText(surnameEdit) && checkInputText(nameEdit))) {
        $.ajax({
            url:"requests/save-edit-profile.php",
            method:'post',
            dataType:'json',
            data:{surname_edit : surnameEdit.value, name_edit : nameEdit.value}, 
            // data:{surname_edit : surnameEdit.value, name_edit : nameEdit.value, phone_edit : phoneEdit.value}, 
            success:function(res){
                document.querySelector("#message-block-name").innerHTML = res['response'];
                document.querySelector("#message-block-name").style.color = 'red';
                
                if (res['status'] == 'success'){
                    document.querySelector("#message-block-name").style.color = 'green';
                    setTimeout(() => location.href = 'edit-profile.php', 1500)

                }
            }
        });
        return false;
    }
    else { 
        document.querySelector("#message-block-name").innerHTML = "Проверьте введенные данные";
        document.querySelector("#message-block-name").style.color = 'red';
        return false; 
    }
}

if (document.getElementById('form-change-password')) document.getElementById('form-change-password').addEventListener('submit', function (event) {
    var old_password = document.getElementById('old-password');
    var new_password = document.getElementById('password_reg');
    var new_password1 = document.getElementById('password_reg2');
    old_password.style.color = 'black';
    new_password.style.color = 'black';
    new_password1.style.color = 'black';
    event.preventDefault();
    if (old_password.value == new_password.value)  {document.querySelector('#message-block-password').innerHTML = 'Старый пароль не может совпадать с новым'; document.querySelector('#message-block-password').style.color = 'red'}
    else if (passwordCheckcount_reg() == false) {document.querySelector('#message-block-password').innerHTML = 'Пароль должен быть не менее 8 символов и содержать хотя бы 1 букву'; document.querySelector('#message-block-password').style.color = 'red'}
    else if (new_password.value != new_password1.value) {document.querySelector('#message-block-password').innerHTML = 'Проверьте введенные данные'; document.querySelector('#message-block-password').style.color = 'red'}
    else {
        $.ajax({
            url: "requests/check-true-password.php",
            method: "post",
            async: false,
            data: { password: old_password.value },
            success: function (res) {
                if (res == false) { document.querySelector('#message-block-password').innerHTML = "Неверный старый пароль"; old_password.style.color = 'red'; document.querySelector('#message-block-password').style.color = 'red' };
                if (res == true) {
                    if (new_password.value == new_password1.value) {
                        ajaxChangePassword(new_password.value);
                        
                    }

                }
            }
        });
        function ajaxChangePassword(password) {
            $.ajax({
                url: "requests/change-password.php",
                method: "post",
                async: false,
                data: { password: password },
                success: function (result) {
                    document.querySelector('#message-block-password').innerHTML = result;
                    document.querySelector('#message-block-password').style.color = 'green';
                    setTimeout(() => location.href = 'edit-profile.php', 1500)
                }
            })
        }
    }
    return false;
})
function checkRecordForm() {

}

$("#phone_feedback").mask("+7(999)999-99-99", { autoclear: false });
$("#tel").mask("+7(999)999-99-99", { autoclear: false });
$("#phone_reg").mask("+7(999)999-99-99", { autoclear: false });
$("#phone_log").mask("+7(999)999-99-99", { autoclear: false });

var rec_label = document.getElementById('record-table-label');
var done_label = document.getElementById('done-table-label');
var canc_label = document.getElementById('canceled-table-label');
var rec_table = document.getElementById('record-table');
var done_table = document.getElementById('done-table');
var canc_table = document.getElementById('canceled-table');


if (rec_label) rec_label.addEventListener("click", function () {
    if (!rec_label.classList.contains('label-checked')) {
        rec_label.classList.toggle('label-checked');
        done_label.classList.remove('label-checked');
        canc_label.classList.remove('label-checked');
        done_table.style.display = "none";
        canc_table.style.display = "none";
        rec_table.style.display = "table";
    }
})
if (done_label) done_label.addEventListener("click", function () {
    if (!done_label.classList.contains('label-checked')) {
        done_label.classList.toggle('label-checked');
        rec_label.classList.remove('label-checked');
        canc_label.classList.remove('label-checked');
        rec_table.style.display = "none";
        canc_table.style.display = "none";
        done_table.style.display = "table";
    }
})
if (canc_label) canc_label.addEventListener("click", function () {
    if (!canc_label.classList.contains('label-checked')) {
        canc_label.classList.toggle('label-checked');
        rec_label.classList.remove('label-checked');
        done_label.classList.remove('label-checked');
        rec_table.style.display = "none";
        done_table.style.display = "none";
        canc_table.style.display = "table";
    }
})

//
var portfolio_label = document.getElementById('portfolio-table-label');
var service_label = document.getElementById('service-table-label');
var promotions_label = document.getElementById('promotions-table-label');
var contacts_label = document.getElementById('users-table-label');
var portfolio_table = document.getElementById('portfolio-table');
var service_table = document.getElementById('service-table');
var promotions_table = document.getElementById('promotions-table');
var contacts_table = document.getElementById('users-table');


if (portfolio_label) portfolio_label.addEventListener("click", function () {
    if (!portfolio_label.classList.contains('label-checked')) {
        portfolio_label.classList.toggle('label-checked');
        service_label.classList.remove('label-checked');
        promotions_label.classList.remove('label-checked');
        contacts_label.classList.remove('label-checked');
        promotions_table.style.display = "none";
        service_table.style.display = "none";
        contacts_table.style.display = "none";
        portfolio_table.style.display = "block";
    }
})
if (service_label) service_label.addEventListener("click", function () {
    if (!service_label.classList.contains('label-checked')) {
        service_label.classList.toggle('label-checked');
        portfolio_label.classList.remove('label-checked');
        promotions_label.classList.remove('label-checked');
        contacts_label.classList.remove('label-checked');
        promotions_table.style.display = "none";
        portfolio_table.style.display = "none";
        contacts_table.style.display = "none";
        service_table.style.display = "block";
    }
})
if (promotions_label) promotions_label.addEventListener("click", function () {
    if (!promotions_label.classList.contains('label-checked')) {
        promotions_label.classList.toggle('label-checked');
        portfolio_label.classList.remove('label-checked');
        service_label.classList.remove('label-checked');
        contacts_label.classList.remove('label-checked');
        promotions_table.style.display = "block";
        service_table.style.display = "none";
        contacts_table.style.display = "none";
        portfolio_table.style.display = "none";
    }
})
if (contacts_label) contacts_label.addEventListener("click", function () {
    if (!contacts_label.classList.contains('label-checked')) {
        contacts_label.classList.toggle('label-checked');
        portfolio_label.classList.remove('label-checked');
        promotions_label.classList.remove('label-checked');
        service_label.classList.remove('label-checked');
        contacts_table.style.display = "block";
        service_table.style.display = "none";
        promotions_table.style.display = "none";
        portfolio_table.style.display = "none";
    }
})

//обработка загрузки фото портфолио на страницу

function changeInputPhoto(input) {
    var labelVal = document.querySelector('.upload-text').innerText;
    var countFiles = '';
    if (input.files && input.files.length >= 1)
        countFiles = input.files.length;

    if (countFiles) {
        document.querySelector('.upload-text').innerText = 'Выбрано файлов: ' + countFiles;
        document.querySelector('.add-photo-btn').classList.add('btn-visible');
    }
    else {
        document.querySelector('.upload-text').innerText = labelVal;
        document.querySelector('.add-photo-btn').classList.remove('btn-visible');
    }
};

function add_service(form) {
    var dataForm = $(form).serialize();
    $.ajax({
        url: 'requests/save-add-service.php',
        method: 'post',
        async: false,
        dataType: 'html',
        data: dataForm,
        success: function (data) {
            alert(data);
            var popup_service_edit = document.querySelector(".popup-service-add");
            popup_service_edit.classList.remove("popup_open");
            document.body.style.overflow = "visible";
            $('#popup').html = '';
        }
    });
    getServices();
    return false;
}


$('#form-make-record').on("submit", function () {
    time_text = document.getElementById('record-times').value;
    var Valid = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/.test(time_text);
    console.log(time_text);
    if (Valid) {
        var dataForm = $(this).serialize();
        $.ajax({
            url: "requests/save-new-record.php",
            async: false,
            data: dataForm,
            method: 'post',
            success: function () {
                // alert("Успешная запись");
                location.href = 'lk.php';
            }
        });
        return true;
    } else {
        alert(time_text);
        return false;
    }


});
function onEntry(entry) {
    entry.forEach(change => {
        if (change.isIntersecting) {
            change.target.classList.add('about-salon-show');
        }
        else {
            change.target.classList.remove('about-salon-show')
        }
    })
}
var options = { threshold: [0.2] };
var observer = new IntersectionObserver(onEntry, options);
var elements = document.querySelectorAll('.about-salon');
for (let elem of elements) {
    observer.observe(elem);
}

//загрузка таблиц админа
if (document.querySelector('#portfolio-table')) {
    function getPortfolio() {
        $.ajax({
            method: 'post',
            url: 'admin-portfolio.php',
            dataType: 'html',
            async: 'false',
            success: function (res) {
                document.querySelector('#portfolio-table').innerHTML = res;
            }
        })
    }
    getPortfolio();
}

if (document.querySelector('#service-table')) {
    function getServices() {
        $.ajax({
            method: 'post',
            url: 'admin-service.php',
            dataType: 'html',
            async: 'false',
            success: function (res) {
                document.querySelector('#service-table').innerHTML = res;
            }
        })
    }
    getServices();
}

if (document.querySelector('#promotions-table')) {
    function getPromotions() {
        $.ajax({
            method: 'post',
            url: 'admin-promotions.php',
            dataType: 'html',
            async: 'false',
            success: function (res) {
                document.querySelector('#promotions-table').innerHTML = res;
            }
        })
    }
    getPromotions();
}

if (document.querySelector('#reviews-table')) {
    function getReviews() {
        $.ajax({
            method: 'post',
            url: 'admin-reviews.php',
            dataType: 'html',
            async: 'false',
            success: function (res) {
                document.querySelector('#reviews-table').innerHTML = res;
            }
        })
    }
    getReviews();
}

//функция экранирования
function escapeHtml(str) {
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/`/g, '&#x60;');
}

//обработка добавления, удаления и редактирования отзывов
function review_edit(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'get-edit-review.php',
        type: 'json',
        async: false,
        success: function (res) {
            openPopup();
            let review = JSON.parse(res);
            document.querySelector('.popup-title').innerHTML = 'Редактирование отзыва';
            document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
            <label>Содержание</label>
            <div>
            <textarea style="min-height:200px; width:96%; height:auto; resize:none; padding:2%;" id='review_content' name='review_content' required>${review['content']}</textarea>
            </div>
            <label>Автор</label>
            <input type='text' id='review_author' name='review_author' value='${escapeHtml(review['name'])}' required>
            <label>Дата</label>
            <input type='date' id='review_date' name='review_date' value='${escapeHtml(review['date'])}' required>
            <input type='text' id='review_id' name='review_id' style='visibility:hidden;' value='${review['id']}'>
            `);
            function saveEditReview() {
                var author = document.querySelector('#review_author').value;
                var date = document.querySelector('#review_date').value;
                var content = document.querySelector('#review_content').value;
                let id = document.querySelector('#review_id').value;
                var dataForm = $(this).serialize();
                $.ajax({
                    method: 'post',
                    dataType: 'html',
                    url: 'requests/save-edit-review.php',
                    async: false,
                    data: dataForm,
                    success: function () {
                        closePopup();
                        document.querySelector('#form').removeEventListener('submit', saveEditReview);
                        document.getElementById('review_name' + id).innerHTML = author;
                        document.getElementById('review_content' + id).innerHTML = content;
                        document.getElementById('review_date' + id).innerHTML = date;
                    }
                })
            }
            document.querySelector('#form').addEventListener('submit', saveEditReview);
        }
    })
}

function review_add() {
    openPopup();
    document.querySelector('.popup-title').innerHTML = 'Добавление отзыва';
    document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
            <label>Содержание</label>
            <div>
            <textarea style="min-height:200px; width:96%; height:auto; resize:none; padding:2%;" id='review_content' name='review_content' required></textarea>
            </div>
            <label>Автор</label>
            <input type='text' id='review_author' name='review_author' value='' required>
            <label>Дата</label>
            <input type='date' id='review_date' name='review_date' value='' required>
            `);
    document.querySelector('#form').addEventListener('submit', saveAddReview)
    function saveAddReview() {
        var dataForm = $(this).serialize();
        $.ajax({
            method: 'post',
            dataType: 'html',
            url: 'requests/save-add-review.php',
            async: false,
            data: dataForm,
            success: function (res) {
                alert(res);
                closePopup();
                document.querySelector('#form').removeEventListener('submit', saveAddReview);
                getReviews();
            }
        })
    }
}
function review_delete(id) {
    if (confirm('Хотите удалить отзыв?')) {
        $.ajax({
            method: 'post',
            data: { id: id },
            url: 'requests/review-delete.php',
            success: function () {
                $('#admin-review' + id).remove();
            }
        })
    }
}



// портфолио добавление, удаление, редактирование

function add_photo() {
    var formData = new FormData();
    //Если выбранные изображение больше 10
    if ($('#uploadimage')[0].files.length > 10) { alert('Файлов больше 10'); return false };
    //Insert File Listes In An Object FormData (Создание вставки массивов изображений $_FILES в объект formdata )
    // alert('Неверный тип данных. Загрузите .png .jpeg .jpg или .gif');
    $.each($('#uploadimage')[0].files, function (count, This_File) {
        //If MIME Type Of Picture Not Match With That Formats (Если не соответствует тип)
        // if (!This_File.type.match(/(.png)|(.jpeg)|(.jpg)|(.gif)$/i) || ($('#uploadimage')[0].files[count].size / 1024).toFixed(0) > 1524) {
        if (!This_File.type.match(/(.png)|(.jpeg)|(.jpg)|(.gif)$/i)) {
            alert('Неверный тип файла - ' + This_File.name + '.\nЗагрузите png, jpeg, jpg, или gif.');
            return false;
        }
        //Иначе
        else {
            //Append Objects ( вставляем массивы изображений $_FILES в объект formdata )
            formData.append("image" + count, This_File);

            //Если мы уже вставили все изображения
            if (count == $('#uploadimage')[0].files.length - 1) {
                //var query = 0;
                //Вторая защита (если имя НЕ неизвестно)
                if ($("#uploadimage")[0].files[0].name != undefined) {
                    //Query 
                    $.ajax({
                        url: 'requests/upload-images.php',
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        async: false,
                        dataType: 'json',
                        data: formData,
                        success: function (res){
                            alert("Фото с именем/ами" + res['picName'] + " \nуже были загружены");
                        }
                    });
                    $.ajax({
                        url: "admin-portfolio.php",
                        cache: false,
                        success: function (php) {
                            $("#portfolio-table").html(php);
                        }
                    });
                }
            }
        }
    });

}

function portfolio_edit(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'requests/portfolio-edit-popup.php',
        type: 'json',
        async: false,
        success: function (res) {
            openPopup();
            let portfolio = JSON.parse(res);
            document.querySelector('.popup-title').innerHTML = 'Добавление описания';
            if (portfolio['portfolio_description'] == null) description = ''
            else description = escapeHtml(portfolio['portfolio_description']);
            document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
            <label>Фото</label>
            <div>            
            <img width="200px" src="Resources/portfolio/${portfolio['portfolio_picture']}">
            </div>
            <label>Описание</label>
            <input type='text' id='portfolio_description' name='portfolio_description' value='${description}'>
            <input type='text' id='portfolio_id' name='id' style='visibility:hidden;' value='${portfolio['portfolio_id']}'>
            `);
            function saveEditPortfolio() {
                var description = document.querySelector('#portfolio_description').value;
                var id = document.querySelector('#portfolio_id').value;
                var dataForm = $(this).serialize();
                $.ajax({
                    method: 'post',
                    dataType: 'html',
                    url: 'requests/save-edit-portfolio.php',
                    async: false,
                    data: dataForm,
                    success: function () {
                        closePopup();
                        document.querySelector('#form').removeEventListener('submit', saveEditPortfolio);
                        document.getElementById('admin-portfolio' + id).querySelector(".description").innerHTML = description;
                    }
                })
            }
            document.querySelector('#form').addEventListener('submit', saveEditPortfolio);
        }
    })
}
function portfolio_delete(id) {
    if (confirm("Вы хотите удалить фото?")) {
        $.ajax({
            url: 'requests/portfolio-photo-delete.php',
            method: 'get',
            async: false,
            dataType: 'html',
            data: { id_image: id },
            success: function () {
                $('#admin-portfolio' + id).remove();
            }
        });
    }
}


// акции добавление редактирование удаление

function promotion_edit(id) {

    $.ajax({
        method: 'post',
        data: { promotion_id: id },
        url: 'requests/promotion-edit-popup.php',
        type: 'json',
        async: false,
        success: function (res) {
            openPopup();
            let promotion = JSON.parse(res);
            document.querySelector('.popup-title').innerHTML = 'Редактирование акции';
            document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
            <label>Заголовок</label>
            <input type='text' id='promotion_title' name='promotion_title' value='${escapeHtml(promotion['title'])}' required>
            <label>Описание</label>
            <input type='text' id='promotion_description' name='promotion_description' value='${escapeHtml(promotion['description'])}' required>
            <label>Фон</label>
            <img width=200px src='Resources/promotions/${promotion['picture']}'>                    
	        <input type='file' id='promotion_picture' name='promotion_picture'>
            <input type='text' id='promotion_id' name='promotion_id' style='visibility:hidden;' value='${promotion['id']}'>
            `);
            function saveEditPromotion() {
                var formData = new FormData();
                var file = $("#promotion_picture")[0].files[0];
                if (file != undefined) {
                    var type = file.type.split('/')[1];
                    if (!type.match(/(png)|(jpeg)|(jpg)|(gif)$/i)) {
                        alert('Неверный тип файла - ' + file.name + '.\nЗагрузите png, jpeg, jpg, или gif.');
                        return false;
                    }
                    else {
                        formData.append("promotion_picture", file);
                    }
                };
                formData.append("promotion_title", $('#promotion_title').val());
                formData.append("promotion_id", $('#promotion_id').val());
                formData.append("promotion_description", $('#promotion_description').val());

                var title = document.querySelector('#promotion_title').value;
                var description = document.querySelector('#promotion_description').value;
                var photo = document.querySelector('#promotion_picture').value;
                var id = document.querySelector('#promotion_id').value;
                $.ajax({
                    method: 'post',
                    dataType: 'html',
                    contentType: false,
                    processData: false,
                    url: 'requests/save-edit-promotion.php',
                    async: false,
                    data: formData,
                    success: function () {
                        closePopup();
                        document.querySelector('#form').removeEventListener('submit', saveEditPromotion);
                        let promotion = document.getElementById('admin-promotion' + id);
                        promotion.querySelector('.promotion-table-title').innerHTML = title;
                        promotion.querySelector('.promotion-table-description').innerHTML = description;
                        if (photo != '')
                            promotion.querySelector('.promotion-table-img').src = "Resources/promotions/" + photo.split(/(\\|\/)/g).pop();
                    }
                })
            }
            document.querySelector('#form').addEventListener('submit', saveEditPromotion);
        }
    })

}

function promotion_add() {
    openPopup();
    document.querySelector('.popup-title').innerHTML = 'Добавление акции';
    document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
    <label>Заголовок</label>
    <input type='text' id='promotion_title' name='promotion_title' required>
    <label>Описание</label>
    <input type='text' id='promotion_description' name='promotion_description' required>
    <label>Фон</label>                  
    <input type='file' id='promotion_picture' name='promotion_picture' required>`);
    document.querySelector('#form').addEventListener('submit', saveAddPromotion);
    function saveAddPromotion() {
       var formData = new FormData();
        var file = $("#promotion_picture")[0].files[0];
        if (file != undefined) {
            var type = file.type.split('/')[1];
            console.log(type);
            if (!type.match(/(png)|(jpeg)|(jpg)|(gif)$/i)) {
                alert('Неверный тип файла - ' + file.name + '.\nЗагрузите png, jpeg, jpg, или gif.');
                return false;
            }
            else {
                formData.append("promotion_picture", file);
            }
        };
        formData.append("promotion_title", $('#promotion_title').val());
        formData.append("promotion_description", $('#promotion_description').val());

        $.ajax({
            method: 'post',
            dataType: 'html',
            url: 'requests/save-add-promotion.php',
            async: false,
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                closePopup();
                document.querySelector('#form').removeEventListener('submit', saveAddPromotion);
                getPromotions();
            }
        })
    }

}

function promotion_delete(id) {
    if (confirm("Вы хотите удалить акцию?")) {
        $.ajax({
            url: 'requests/promotion-delete.php',
            method: 'get',
            async: false,
            dataType: 'html',
            data: { promotion_id: id },
            success: function () {
                $('#admin-promotion' + id).remove();
            }
        });
    }
}


// услуги редактирование удаление добавление
function service_edit(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'requests/service-edit-popup.php',
        type: 'json',
        async: false,
        success: function (res) {
            openPopup();
            let service = JSON.parse(res);
            console.log(service);
            document.querySelector('.popup-title').innerHTML = 'Редактирование услуги';
            document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
            <label>Категория</label>
            <div>
            <select name="category_name" id="category_name" required>
            </select>
            </div>
            <label>Название</label>
            <input type='text' id='service_name' name='service_name' value='${escapeHtml(service['name'])}' required>
            <label>Стоимость</label>
            <input type='text' id='service_price' name='service_price' value='${escapeHtml(service['price'])}' required>
            <div style='margin:3%;'>
            <label>Для записи?</label>
                    <input type="radio" id="rec1" name="is_recording" value="1" required/>
                    <label for="rec1">Да</label>
                <input type="radio" id="rec0" name="is_recording" value="0" />
                <label for="rec0">Нет</label>

            </div>
            <label>Длительность</label>
            <input type='number' id='service_duration' name='service_duration' value='${service['duration']}'>мин.
            <input type='text' id='service_id' name='service_id' style='visibility:hidden;' value='${service['id']}'>
            `);
            if (service['recording'] == 1) document.getElementById('rec1').checked = true;
            else document.getElementById('rec0').checked = true;
            var k = 0;
            while (k < service['categories'].length) {
                if (service['categories'][k][2] == 'selected')
                    document.querySelector('#category_name').insertAdjacentHTML('beforeend', `<option value='${service['categories'][k][1]}' selected>${service['categories'][k][0]}</option>`);
                else
                    document.querySelector('#category_name').insertAdjacentHTML('beforeend', `<option value='${service['categories'][k][1]}'>${service['categories'][k][0]}</option>`);
                k++;
            }
            console.log(document.querySelector('#category_name'));
            function saveEditService() {
                var dataForm = $(this).serialize();
                $.ajax({
                    method: 'post',
                    dataType: 'html',
                    url: 'requests/save-edit-service.php',
                    async: false,
                    data: dataForm,
                    success: function () {
                        closePopup();
                        document.querySelector('#form').removeEventListener('submit', saveEditService);
                        getServices();
                    }
                })
            }
            document.querySelector('#form').addEventListener('submit', saveEditService);
        }
    })

// radio-кнопки для записи
function durationRequired(radio){
    if (radio.value == 1)
    document.querySelector('#service_duration').required = true;
else
    document.querySelector('#service_duration').required = false;
}
var radioIsRec = document.querySelectorAll('input[type="radio"][name="is_recording"]');
if (radioIsRec){
    console.log(radioIsRec);
    radioIsRec.forEach(radio => {
        radio.addEventListener('change', () => durationRequired(radio));
    });
}}

function service_add() {
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: 'requests/service-add-popup.php',
        async: false,
        success: function (res) {
            var categories_name = (res);
            openPopup();
            document.querySelector('.popup-title').innerHTML = 'Добавление услуги';
            document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
    <label>Категория</label>
    <div>
    <select name="category_name" id="category_name" required>
    </select>
    </div>
    <label>Название</label>
    <input type='text' id='service_name' name='service_name' required>
    <label>Стоимость</label>
    <input type='text' id='service_price' name='service_price' required>
    <div style="margin:3%;">
    <label>Для записи?</label>
        <input type="radio" id="rec1" name="is_recording" value="1" required/>
        <label for="rec1">Да</label>
        <input type="radio" id="rec0" name="is_recording" value="0" />
        <label for="rec0">Нет</label>

</div>
    <label>Длительность</label>
    <input type='number' id='service_duration' name='service_duration'>мин.
    `);
            var k = 0;
            while (k < categories_name.length) {
                document.querySelector('#category_name').insertAdjacentHTML('beforeend', `<option value='${categories_name[k][1]}'>${categories_name[k][0]}</option>`);
                k++;
            }
            document.querySelector('#form').addEventListener('submit', saveAddService);
        }
    })
    function saveAddService() {
        var dataForm = $(this).serialize();
        $.ajax({
            method: 'post',
            dataType: 'html',
            url: 'requests/save-add-service.php',
            async: false,
            data: dataForm,
            success: function () {
                closePopup();
                document.querySelector('#form').removeEventListener('submit', saveAddService);
                getServices();
            }
        })
    }
    // radio-кнопки для записи
function durationRequired(radio){
    if (radio.value == 1)
    document.querySelector('#service_duration').required = true;
else
    document.querySelector('#service_duration').required = false;
}
var radioIsRec = document.querySelectorAll('input[type="radio"][name="is_recording"]');
if (radioIsRec){
    console.log(radioIsRec);
    radioIsRec.forEach(radio => {
        radio.addEventListener('change', () => durationRequired(radio));
    });
}
}

function service_delete(id, service_id) {
    if (confirm("Вы хотите удалить услугу?")) {
        $.ajax({
            url: 'requests/service-delete.php',
            method: 'get',
            async: false,
            dataType: 'html',
            data: { service_id: id },
            success: function (data) {
                $('#admin-service' + id).remove();
                let row = $('#admin-category-service' + service_id).attr('rowspan');
                $('#admin-category-service' + service_id).attr('rowspan', row - '1');
            }
        });
    }
}

//форма редактирования профиля, смена пароля
var password_old = document.querySelector('#old-password');
var password_new = document.querySelector('#new-password');
var password_new1 = document.querySelector('#new-password1');
if (password_old) password_old.addEventListener('input',() => passwordCheckcount(password_old));



