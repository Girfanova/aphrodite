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
    if (document.querySelector('#schedule-master')){

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
                document.querySelector('#more_btn').innerHTML = 'Загрузить еще';
                document.querySelector('#more_btn').addEventListener('click', get_more_records);
            }
        }
    })
}
function get_more_records() {
    var table = document.querySelector('#record-table');
    var offset = table.rows.length - 2;
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
$('#form-schedule').on("submit", function () {
    var dataForm = $(this).serialize();
    $.ajax({
        url: 'requests/save-edit-schedule.php',         
        method: 'post',            
        async: false,
        dataType: 'html',         
        data: dataForm,    
        success: function (res) {  
            document.querySelector('#schedule-master').insertAdjacentHTML('beforeend',  `
            <div style="width:100%; text-align:center;">${res}</div>
            `)
            setTimeout (() => getSchedule(), 1000); 
        }
    });
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
            <div>
            <input type='radio' value='${html[k]['id']}' name='changed-category' checked id='cat${html[k]['id']}'>
            <label for='cat${html[k]['id']}'>${html[k]['name']}</label>
            </div>
            `);
                    k++;
                }
                else {
                    document.querySelector('.form-body').insertAdjacentHTML('beforeend', `
            <div>
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
function makeDoneRecord(id){
    $.ajax({
        method: 'post',
        data:{id:id},
        url:'requests/done-record.php',
        success:function(){
            document.querySelector('#record' + id).querySelector('.done-btn').innerHTML="<input type='checkbox' checked onclick='removeDoneRecord("+id+");'>";
            document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML="&mdash;";
        },
    })
}

//услуга выполнена (отмена)
function removeDoneRecord(id){
    $.ajax({
        method: 'post',
        data:{id:id},
        url:'requests/remove-done-record.php',
        success:function(){
           document.querySelector('#record' + id).querySelector('.done-btn').innerHTML="<input type='checkbox' onclick='makeDoneRecord("+id+");'>";
           document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML="<input type='checkbox' onclick='makeCanceledRecord("+id+");'>";
        },
    })
}
//услуга отменена
function makeCanceledRecord(id){
    $.ajax({
        method: 'post',
        data:{id:id},
        url:'requests/canceled-record.php',
        success:function(){
           document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML="<input type='checkbox' checked onclick='removeCanceledRecord("+id+");'>";
           let doneBtn = document.querySelector('#record' + id).querySelector('.done-btn');
           if (doneBtn) doneBtn.innerHTML="&mdash;";
           let status = document.querySelector('#record' + id).querySelector('.status');
           if (status) status.innerHTML="Отменено";
        },
    })
}
//услуга отменена (отмена)
function removeCanceledRecord(id){
    $.ajax({
        method: 'post',
        data:{id:id},
        url:'requests/remove-canceled-record.php',
        success:function(){
           document.querySelector('#record' + id).querySelector('.canceled-btn').innerHTML="<input type='checkbox' onclick='makeCanceledRecord("+id+");'>";
           let doneBtn = document.querySelector('#record' + id).querySelector('.done-btn');
           if (doneBtn) doneBtn.innerHTML="<input type='checkbox' onclick='makeDoneRecord("+id+");'>";
           let status = document.querySelector('#record' + id).querySelector('.status');
           if (status) status.innerHTML="В ожидании";
        },
    })
}
