/**
 * Добавление продуктов в корзину
 * @param $itemId id продукта
 * @return в случае успеха обновятся данные корзины на стр
  */
function addToCart(itemId){
    console.log("js - addToCart()");
    $.ajax({
        type: 'POST',
        async: true,
        url: "/cart/addtocart/" + itemId + '/',
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#addCart_'+ itemId).hide();
                $('#removeCart_'+ itemId).show();
            }
        }
    });
}

/**
 * Удаление продуктов из корзины
 * @param $itemId id продукта
 * @return в случае успеха обновятся данные корзины на стр
 */
function removeFromCart(itemId){
    console.log("js - removeFromToCart("+itemId+")");
    $.ajax({
        type: 'POST',
        async: true,
        url: "/cart/removefromcart/" + itemId + '/',
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#addCart_'+ itemId).show();
                $('#removeCart_'+ itemId).hide();
            }
        }
    });
}

/**
 * Подсчёт стоимости купленного товара
 * @param itemId ID продукта
 */
function conversionPrice(itemId){
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;
    $('#itemRealPrice_' + itemId).html(itemRealPrice);
}

/**
 * Получение данных с формы
 */
function getData(obj_form){
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
        if(this.name && this.name != ''){
            hData[this.name] = this.value;
            console.log('hData[' + this.name + '] = ' + hData[this.name]);
        }
    });
    return hData;
};

/**
 * Регистрация ного пользователя
 */
function registerNewUser(){
    var postData = getData('#registerBox');

    $.ajax({
        type: 'POST',
        async: true,
        url: "/user/register/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                alert('Регистрация прошла успешно');

                //блок в левом столбце
                $('#registerBox').hide();

                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['userName']);
                $('#userBox').show()

                //страница заказа
                $('#loginBox').hide();
                $('#btnSaveOrder').show();
            }else{
                alert(data['message']);
            }
        }
    });
}

/**
 * Фу выхода
 function logout() {
    console.log('Logout');
    $.ajax({
        type: 'POST',
        async: true,
        url: '/user/logout/',
        success: function() {
            console.log('user logged out');
            $('#registerBox').show();
            $('#userBox').hide();
        }
    });
}*/

/**
 * Авторизация
 */
function login(){
    var email = $('#loginEmail').val();
    var pwd = $('#loginPwd').val();
    var postData = "email="+ email +"&pwd=" +pwd;

    $.ajax({
        type: 'POST',
        async: true,
        url: "/user/login/",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                $('#registerBox').hide();
                $('#loginBox').hide();

                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['displayName']);
                $('#userBox').show();

                $('#btnSaveOrder').show();
            } else {
                alert(data['message']);
            }
        }
    });
}

/**
 * Показать или прятать форму регистрации
 */
function showRegisterBox(){

    if ($("#registerBoxHidden").css('display') != 'block') {
        $("#registerBoxHidden").show();
    } else {
        $("#registerBoxHidden").hide();
    }

   // $("#registerBoxHidden").toggle();﻿
}

/**
 * Обновленние данных пользователя
 */
function updateUserData(){
   console.log("js - updateUserData()");
    var phone = $('#newPhone').val();
    var address = $('#newAddress').val();
    var pwd1 = $('#newPwd1').val();
    var pwd2 = $('#newPwd2').val();
    var curPwd = $('#curPwd').val();
    var name = $('#newName').val();

    var postData = {phone: phone,
                    address: address,
                    pwd1: pwd1,
                    pwd2: pwd2,
                    curPwd: curPwd,
                    name: name};

    $.ajax({
        type: 'POST',
        async: true,
        url: "/user/update/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#userLink').html(data['userName']);
                alert(data['message']);
            }else{
                alert(data['message']);
            }
        }
    });
}

/**
 * Сохранение заказа
 */
function saveOrder(){
    var postData = getData('form');
    $.ajax({
        type: 'POST',
        async: true,
        url: "/cart/saveorder/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                alert(data['message']);
                document.location = '/';
            }else{
                alert(data['message']);
            }
        }
    });
}

//Показать или прятать данные о заказе
function showProducts(id) {
    var objName = "#purchasesForOrderId_" + id;
    if($(objName).css('display') != 'table-row'){
       $(objName).show();
    }else{
       $(objName).hide();
    }
}