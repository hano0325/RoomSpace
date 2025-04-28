"use strict";

jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる
  $(".js-hamburger, .js-drawerClose").on("click", function () {
    if ($(".js-hamburger").hasClass("is-active")) {
      closeDrawer();
    } else {
      openDrawer();
    }
  });
  // ページ内スクロール
  $(function () {
    var headerHeight = $(".header").outerHeight(); // ヘッダーの高さを取得
  
    if (headerHeight) {
      console.log("Header height: " + headerHeight + "px");
    } else {
      console.log("Header element does not exist or its height could not be retrieved.");
    }
    // ページロード時、ハッシュがあればスクロール
    if (location.hash) {
      smoothScroll(location.hash, headerHeight);
    }
    // aタグクリック時
    $('a[href^="#"]').on('click', function (e) {
      var href = $(this).attr('href');
      var id = href.slice(1); // #を除いたid名を取得
      // idが存在するかチェック
      if (id && $("#" + id).length) {
        e.preventDefault(); // 本来のリンク動作を止める
        // ハンバーガーメニューを閉じる処理
        $(".js-hamburger").removeClass("is-active");
        $(".js-drawer").removeClass("is-active").css("display", "none");
        smoothScroll(href, headerHeight); // スクロール実行
      }
    });
  });
  // スクロール関数
  function smoothScroll(href, headerHeight) {
    var speed = 600;
    var id = href.split("#")[1];
    if (!id) return;
    var target = $("#" + id);

    if (!target.length) return;
    $("html, body").stop().animate({
      scrollTop: target.offset().top - headerHeight
    }, speed, "swing");
  }
  });
  
// resizeイベント
$(window).resize(function () {
  if (window.matchMedia("(min-width: 768px)").matches) {
    closeDrawer();
  }
});

// 新しい関数: openDrawer
function openDrawer() {
  $(".js-drawer").fadeIn();
  $(".js-hamburger").addClass("is-active");
  $("body").addClass("no-scroll"); // スクロールを無効化
}

// 新しい関数: closeDrawer
function closeDrawer() {
  $(".js-drawer").fadeOut();
  $(".js-hamburger").removeClass("is-active");
  $("body").removeClass("no-scroll"); // スクロールを無効化
}

// ページトップに戻るボタン
$(function () {
  var pageTop = $(".js-page-top");
  pageTop.hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
      pageTop.fadeIn();
    } else {
      pageTop.fadeOut();
    }
  });
  pageTop.click(function () {
    $("body, html").animate({
      scrollTop: 0
    }, 300);
    return false;
  });
});
document.addEventListener("DOMContentLoaded", function () {
  // mvセクション用のSwiper
  var mvSwiper = new Swiper(".js-mv-swiper", {
    loop: true,
    effect: "fade",
    speed: 3000,
    allowTouchMove: false,
    autoplay: {
      delay: 3000
    }
  });
});

// キャンペーンセクション用のSwiper
var campaignSwiper = new Swiper('.js-campaign-swiper', {
  loop: true,
  // 無限ループ
  slidesPerView: 'auto',
  // 一度に表示するスライド数
  slidesPerGroup: 1,
  // 一度に移動するスライド数
  initialSlide: 1,
  // 初期表示スライド
  spaceBetween: 24,
  // スライド間のスペース
  autoplay: {
    delay: 2000,
    // 2秒ごとに自動でスライド
    disableOnInteraction: false // ユーザーが操作しても自動再生を止めない
  },

  pagination: {
    el: '.swiper-pagination',
    // ページネーションの要素
    clickable: true // ページネーションをクリック可能にする
  },

  navigation: {
    nextEl: '.swiper-button-next',
    // 次へボタン
    prevEl: '.swiper-button-prev' // 前へボタン
  },

  breakpoints: {
    // タブレットおよびPC用（768px以上）
    768: {
      slidesPerView: 'auto',
      // 一度に表示するスライド数
      slidesPerGroup: 1,
      // 一度に移動するスライド数
      initialSlide: 1,
      // 初期表示スライド
      spaceBetween: 40 // スライド間のスペース
    }
  }
});

$(document).ready(function () {
  // 初期状態で全ての答えを閉じる
  $('.js-faq-question').next().hide();

  // クリックイベントで開閉＆クラス切り替え
  $('.js-faq-question').on('click', function () {
    $(this).next().slideToggle(300); // 0.3秒でスライド
    $(this).toggleClass('is-active');
  });
});

// ローディングとMVアニメーション
window.addEventListener('DOMContentLoaded', function () {
  var header = document.querySelector('.header');
  var mv = document.querySelector('#mv');
  var titles = document.querySelectorAll('.mv__title-main, .mv-lower__title-main');

  // チラ見え防止＆文字を空に
  titles.forEach(function (title) {
    var spans = title.querySelectorAll('span');
    spans.forEach(function (span) {
      span.dataset.text = span.textContent;
      span.textContent = '';
    });

    // タイトル全体をフェードイン
    title.classList.add('is-visible');

    // 少し遅らせて文字アニメーション
    setTimeout(function () {
      spans.forEach(function (lineSpan, lineIndex) {
        var text = lineSpan.dataset.text;
        text.split('').forEach(function (_char, i) {
          var charSpan = document.createElement('span');
          charSpan.textContent = _char;
          charSpan.style.display = 'inline-block';
          lineSpan.appendChild(charSpan);
          setTimeout(function () {
            charSpan.classList.add('is-active');
          }, (i + lineIndex * 8) * 50);
        });
      });
    }, 400);
  });

  // ヘッダーとMV表示
  header.classList.add('show');
  mv.classList.add('show');
});
document.addEventListener('DOMContentLoaded', function () {
  var triggerMargin = 0;
  var scrollElements = document.querySelectorAll('.scroll-up, .scroll-left, .scroll-right');
  function activateOnScroll() {
    scrollElements.forEach(function (elem) {
      var elemTop = elem.getBoundingClientRect().top;
      var windowHeight = window.innerHeight;
      if (elemTop < windowHeight - triggerMargin) {
        elem.classList.add('is-active');
      }
    });
  }
  window.addEventListener('load', activateOnScroll);
  window.addEventListener('scroll', activateOnScroll);
});
document.addEventListener("DOMContentLoaded", function () {
  // 最初のチェックボックスに自動でチェックを入れる
  var firstCheckbox = document.querySelector(".form__checkbox input[type='checkbox']");
  if (firstCheckbox) {
    firstCheckbox.checked = true;
  }
  // すべてのチェックボックスを取得
  var checkboxes = document.querySelectorAll('.form__checkbox input[type="checkbox"]');
  // 各チェックボックスにイベントリスナーを追加
  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
      // 現在チェックされたチェックボックス以外のチェックを外す
      checkboxes.forEach(function (box) {
        if (box !== checkbox) {
          box.checked = false;
        }
      });
    });
  });
});