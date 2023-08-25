console.log(1 + 1);

$(function () {
  $('.menu-trigger').click(function () { //ハンバーガーボタン(.menu-trigger)をクリック
    $(this).toggleClass('active'); //ハンバーガーボタンに(.active)を追加・削除
    if ($(this).hasClass('active')) { //もしハンバーガーボタンに(.active)があれば
      $('.g-navi').addClass('active'); //(.g-navi)にも(.active)を追加
    } else { //それ以外の場合は、
      $('.g-navi').removeClass('active'); //(.g-navi)にある(.active)を削除
    }
  });
  $('.nav-wrapper ul li a').click(function () { //各メニュー(.nav-wrapper ul li a)をタップする
    $('.menu-trigger').removeClass('active'); //ハンバーガーボタンにある(.active)を削除
    $('.g-navi').removeClass('active'); //(.g-navi)にある(.active)も削除
  });

  $('#toggle-button').click(function () {
    $('nav').slideToggle();
    $('.rolling-button').toggleClass('clicked');
  });
});

$(function () {
  $('.modalopen').each(function () {
    $(this).on('click', function () {
      var apple = $(this).data('target');
      var modal = document.getElementById(apple);
      console.log(apple);
      $(modal).fadeIn();
      return false;
    });
  });
  $('.modal-inner').on('click', function (e) {
    if (!$(e.target).closest('.inner-content').length) {
      var apple = $('.modalopen').data('target');
      var modal = document.getElementById(apple);
      $(modal).fadeOut();
    }
    if (('.btn-success').on('click')) {
      $('form').submit();
    }
  });
});
