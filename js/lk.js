const showTab = (elTabBtn) => {
    const elTab = elTabBtn.closest('.tab');
    if (elTabBtn.classList.contains('tab-btn-active')) {
        return;
    }
    const targetId = elTabBtn.dataset.targetId;
    const elTabPane = elTab.querySelector(`.tab-pane[data-id="${targetId}"]`);
    if (elTabPane) {
        const elTabBtnActive = elTab.querySelector('.tab-btn-active');
        elTabBtnActive.classList.remove('tab-btn-active');
        const elTabPaneShow = elTab.querySelector('.tab-pane-show');
        elTabPaneShow.classList.remove('tab-pane-show');
        elTabBtn.classList.add('tab-btn-active');
        elTabPane.classList.add('tab-pane-show');
    }
}

document.addEventListener('click', (e) => {
    if (e.target && !e.target.closest('.tab-btn')) {
        return;
    }
    const elTabBtn = e.target.closest('.tab-btn');
    showTab(elTabBtn);
});
$(document).ready(function () {
    if (document.querySelector('#schedule-master')) {

        select = document.getElementById('filter-select').value;
        $.ajax({
            url: 'record-list-table.php',
            method: 'get',
            async: false,
            dataType: 'html',
            data: { select: select },
            success: function (data) {
                document.getElementById('record-list-table').innerHTML = data;
            }
        })
    }
})
function do_filter() {
    select = document.getElementById('filter-select').value;
    $.ajax({
        url: 'record-list-table.php',
        method: 'get',
        async: false,
        dataType: 'html',
        data: { select: select },
        success: function (data) {
            document.getElementById('record-list-table').innerHTML = data;
            if (document.querySelector('#more_btn')) {
                document.querySelector('#more_btn').innerHTML = '+ Загрузить еще';
                document.querySelector('#more_btn').addEventListener('click', get_more_records);
            }
        }
    })
}
function get_more_records() {
    var table = document.querySelector('#record-table');
    var offset = table.rows.length - 1;
    var select = document.getElementById('filter-select').value;
    $.ajax({
        url: 'get-more-records.php',
        method: 'GET',
        async: false,
        dataType: 'html',
        data: { offset: offset, select: select },
        success: function (html) {
            if (html == '') {
                document.querySelector('#more_btn').innerHTML = 'Больше нет данных';
                document.querySelector('#more_btn').style.cursor = "default";
                document.querySelector('#more_btn').removeEventListener('click', get_more_records);
            }
            $('#record-list-table').append(html);
            offset += 10;
        },
        error: function () {
            alert('Возникла ошибка');
        }
    })
}
if (document.querySelector('#more_btn')) {
    document.querySelector('#more_btn').addEventListener('click', get_more_records);
}

function getSchedule() {
    var id = document.querySelector('input[name="selected-master"]:checked').value;
    $.ajax({
        method: 'get',
        url: 'get-master-schedule.php',
        dataType: 'html',
        data: { id: id },
        async: 'false',
        success: function (res) {
            document.querySelector('#schedule-master').innerHTML = res;
            var checked = document.querySelectorAll('.checkbox');
            for (let input of checked) {
                if (input.classList.contains('check')) {
                    input.parentNode.parentNode.classList.toggle('disabled');
                    input.parentNode.parentNode.querySelectorAll('td.td > input').forEach(element => {
                        element.disabled = true;
                    });
                }
            }
        }
    })
}
$("document").ready(function () {
    if (document.querySelector('#schedule-master'))
        getSchedule();
})
function show_master_schedule() {
    getSchedule();
}
function getOverrecord(event, recordsID) {
    event.preventDefault();
    $.ajax({
        method: 'post',
        dataType: 'html',
        data: { recordsID },
        url: 'get-overrecord.php',
        success: function (res) {
            document.querySelector('#record-list-table').innerHTML = res;
            showTab(document.querySelector('#rec-btn'));
        }
    })

}
$('#form-schedule').on("submit", function () {
    var scheduleElements = document.querySelectorAll('.schedule-error');
    console.log(scheduleElements);
    scheduleElements.forEach(day => {
        console.log(day);
        day.classList.remove('schedule-error');
    });
    var scheduleInfo = document.querySelector('.schedule-info');
    if (scheduleInfo) scheduleInfo.remove();
    var dataForm = $(this).serialize();
    var recDay = [];
    $.ajax({
        url: 'requests/check-before-save-edit-schedule.php',
        method: 'post',
        async: false,
        dataType: 'json',
        data: dataForm,
        success: function (res) {
            if (res == 'success') changeSchedule();
            else {


                var masterSelected = document.querySelector('input[name="selected-master"]:checked').value;
                var recordsID = [];
                res.forEach(day => {
                    document.getElementById(masterSelected + '-day' + day[0]).classList.add('schedule-error');
                    recordsID.push(day[1]);
                    recDay.push(day[0]);
                    console.log(day[1]);
                });
                console.log(recordsID);
                document.querySelector('#schedule-master').insertAdjacentHTML('beforeend', `
            <div class='schedule-info'>Есть записи, не входящие в новый график мастера. <br>Измените график или <a class='schedule-info__link' onclick='getOverrecord(event, [${recordsID}]);' href='#'>перенесите записи</a></div>
            `);
            }
        }
    });
    function changeSchedule() {
        $.ajax({
            url: 'requests/save-edit-schedule.php',
            method: 'post',
            async: false,
            dataType: 'html',
            data: dataForm,
            success: function (res) {
                document.querySelector('#schedule-master').insertAdjacentHTML('beforeend', `
            <div style="width:100%; text-align:center;">${res}</div>
            `)
                setTimeout(() => getSchedule(), 1000);
            }
        });

    }
})
$('#start-0').on('input', function () {
    console.log('hello');
})
function change_work(input) {
    if (input.classList.contains('check')) {
        input.value = 2;
        input.parentNode.parentNode.classList.toggle('disabled');
        // input.parentNode.parentNode.style.backgroundColor = 'white';
        input.classList.remove('check');
        input.parentNode.parentNode.querySelectorAll('td.td > input').forEach(element => {
            // element.readOnly = false;
            element.disabled = false;
        });
    }
    else {
        input.value = 1;
        input.parentNode.parentNode.classList.toggle('disabled');
        // input.parentNode.parentNode.style.backgroundColor = '#e7e6e6';
        input.classList.add('check');
        input.parentNode.parentNode.querySelectorAll('td.td > input').forEach(element => {
            // element.readOnly = true;
            element.disabled = true;
        });
    }
};

function get_info_master() {
    var id = document.querySelector('input[name="selected-master"]:checked').value;
    $.ajax({
        method: 'get',
        url: "requests/edit-master.php",
        dataType: 'json',
        success: function (html) {
            console.log(html);
            document.querySelector('.popup').classList.toggle('popup_open');
            document.querySelector('.popup-title').innerHTML = 'Специализация мастера';
            var spec = document.querySelector('#spec').textContent;
            var k = 0;
            console.log(spec);
            while (k < html.length) {
                if (spec == html[k]['name']) {
                    document.querySelector('.form-body').insertAdjacentHTML('beforeend', `
            <div class='check-category-container'>
            <input type='radio' value='${html[k]['id']}' name='changed-category' checked id='cat${html[k]['id']}'>
            <label for='cat${html[k]['id']}'>${html[k]['name']}</label>
            </div>
            `);
                    k++;
                }
                else {
                    document.querySelector('.form-body').insertAdjacentHTML('beforeend', `
            <div class='check-category-container'>
            <input type='radio' value='${html[k]['id']}' name='changed-category' id='cat${html[k]['id']}'>
            <label for='cat${html[k]['id']}'>${html[k]['name']}</label>
            </div>
            `);
                    k++;
                }
            }
            function saveEditMaster() {
                var selected_cat = document.querySelector('input[name="changed-category"]:checked').value;
                $.ajax({
                    method: 'post',
                    dataType: 'html',
                    url: 'requests/save-edit-master.php',
                    async: false,
                    data: { id: id, selected_cat: selected_cat },
                    success: function (html) {
                        console.log(html);
                        closePopup();
                        document.querySelector('#form').removeEventListener('submit', saveEditMaster);
                        getSchedule();
                    }
                })
            }
            document.querySelector('#form').addEventListener('submit', saveEditMaster);

        }
    });
    //открываем модалку с мастером
}

//услуга выполнена
function makeDoneRecord(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'requests/done-record.php',
        success: function () {
            document.querySelector('#record' + id).querySelector('.done-btn').innerHTML = "<input type='checkbox' checked onclick='removeDoneRecord(" + id + ");'>";
            document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML = "&mdash;";
        },
    })
}

//услуга выполнена (отмена)
function removeDoneRecord(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'requests/remove-done-record.php',
        success: function () {
            document.querySelector('#record' + id).querySelector('.done-btn').innerHTML = "<input type='checkbox' onclick='makeDoneRecord(" + id + ");'>";
            document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML = "<input type='checkbox' onclick='makeCanceledRecord(" + id + ");'>";
        },
    })
}
//услуга отменена
function makeCanceledRecord(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'requests/canceled-record.php',
        success: function () {
            document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML = "<input type='checkbox' checked onclick='removeCanceledRecord(" + id + ");'>";
            let doneBtn = document.querySelector('#record' + id).querySelector('.done-btn');
            if (doneBtn) doneBtn.innerHTML = "&mdash;";
            let status = document.querySelector('#record' + id).querySelector('.status');
            if (status) status.innerHTML = "Отменено";
        },
    })
}
//услуга отменена (отмена)
function removeCanceledRecord(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'requests/remove-canceled-record.php',
        success: function () {
            document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML = "<input type='checkbox' onclick='makeCanceledRecord(" + id + ");'>";
            let doneBtn = document.querySelector('#record' + id).querySelector('.done-btn');
            if (doneBtn) doneBtn.innerHTML = "<input type='checkbox' onclick='makeDoneRecord(" + id + ");'>";
            let status = document.querySelector('#record' + id).querySelector('.status');
            if (status) status.innerHTML = "В ожидании";
        },
    })
}
if (document.querySelector("#graph-btn")) {
    document.querySelector("#graph-btn").addEventListener("click", function () {
        $.ajax({
            url: 'graph.php',
            method: 'get',
            dataType: 'html',
            success: function (res) {
                document.querySelector("#graph-container").innerHTML = res;
            }
        })
    })
}
function getTime(e, id) {
    let date1 = new Date(e);
    let day_of_week = date1.getDay();
    let date = date1.toISOString().split('T')[0];
    let masterSelectedForGetTime = document.getElementById('record-master').value;
    console.log(id);
    console.log(date);
    console.log(masterSelectedForGetTime);
    console.log(day_of_week);
    $.ajax({
        method: 'POST',
        url: "requests/get-free-master-records.php",
        async: false,
        data: { day_of_week: day_of_week, date: date, service_id: id, master_id: masterSelectedForGetTime },
        success: function (html) {
            let times = JSON.parse(html);
            document.getElementById('record-time').innerHTML = times;
        }
    });
}
function resetDateTimes(date, id) {
    document.getElementById('record_date').value = date;
    getTime(date, id);
}
function recordEdit(id) {
    $.ajax({
        method: 'post',
        data: { id: id },
        url: 'requests/get-edit-record.php',
        type: 'json',
        async: false,
        success: function (res) {
            openPopup();
            var today = new Date();
            var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000)).toISOString().slice(0, 10);
            var lastDay = new Date(today.getTime() + (7 * 24 * 60 * 60 * 1000)).toISOString().slice(0, 10);
            let record = JSON.parse(res);
            console.log(res);
            document.querySelector('.popup-title').innerHTML = 'Перенос записи';
            document.querySelector('.form-body').insertAdjacentHTML('afterbegin', `
            <label>Услуга</label>
            <div>
            <div class='input' name='record-name'>${record[0]['service']}</div>
            </div>
            <label>Клиент</label>
            <div>
            <div class='input' name='record-user'>${record[0]['user_name']}</div>
            </div>
            <label>Мастер</label>
            <select onchange="resetDateTimes('${(record[0]['date_record'])}', ${record[0]['service_id']});" id='record-master' name='master_id'>
            <option value='${(record[0]['master_id'])}'>${(record[0]['master_name'])}</option>
            </select>
            <label>Дата</label>
            <input type='date' onchange='getTime(this.value, ${record[0]['service_id']})' min='${tomorrow}' max='${lastDay}' id='record_date' name='date_record' value='${(record[0]['date_record'])}' required>
            <label>Время</label>
            <select id='record-time' name='time_record'>
            <option>${(record[0]['time_record']).slice(0, -3)}</option>
            </select>
            <input type='text' id='record_id' name='record_id' style='visibility:hidden;' value='${record[0]['id']}'>
            `);
            masters = record[1];
            console.log(masters);
            document.querySelector('#record-master').insertAdjacentHTML('beforeend', `
                <option value='${masters['id']}'>${masters['master_name']}</option>
                `);
            getTime(record[0]['date_record'], record[0]['service_id']);
            console.log(record[0]['date_record'], record[0]['service_id']);

            function saveEditRecord() {
                var date_record = document.querySelector('#record_date').value;
                var isoDate = new Date(date_record);
                var date_record = ('0' + isoDate.getDate()).slice(-2) + '.' + ('0' + (isoDate.getMonth() + 1)).slice(-2) + '.' + isoDate.getFullYear();
                console.log(typeof date_record);
                var time_record = document.querySelector('#record-time').value;
                let id = document.querySelector('#record_id').value;
                var dataForm = $(this).serialize();
                if (time_record == 'Нет записи') alert('Выберете другого мастера или дату.');
                else
                $.ajax({
                    method: 'post',
                    dataType: 'html',
                    url: 'requests/save-edit-record.php',
                    async: false,
                    data: dataForm,
                    success: function (master) {
                        closePopup();
                        console.log(master);
                        document.querySelector('#form').removeEventListener('submit', saveEditRecord);
                        document.getElementById('record' + id).querySelector('.master').innerHTML = master;
                        document.getElementById('record' + id).querySelector('.time').innerHTML = time_record;
                        document.getElementById('record' + id).querySelector('.date').innerHTML = date_record;
                    }
                })
            }
            document.querySelector('#form').addEventListener('submit', saveEditRecord);
        }
    })
}