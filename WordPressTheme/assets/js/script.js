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
    // ヘッダーの高さ取得
    var headerHeight = $(".header").outerHeight();
    if (headerHeight) {
      console.log("Header height: ".concat(headerHeight, "px"));
    } else {
      console.log("Header element does not exist or its height could not be retrieved.");
    }
    var hash = location.hash;
    if (hash) {
      $("html, body").stop().scrollTop(0);
      scroll(hash, headerHeight);
    }
    $('a[href*="#"]').click(function () {
      // ヘッダーの高さ分下げる
      $(".js-hamburger").removeClass("is-active"); // ハンバーガーボタンの状態をリセット
      $(".js-drawer").removeClass("is-active"); // メニューを非表示状態にする
      // メニューコンテナを非表示に設定
      $(".js-drawer").css("display", "none");
      var href = $(this).attr("href");
      scroll(href, headerHeight);
      return false;
    });
  });
  function scroll(href, headerHeight) {
    var speed = 600;
    href = "#" + href.split("#")[1];
    console.log(href);
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top - headerHeight;
    $("body.html").animate({
      crollTop: position
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
$(function () {
  // ヘッダーの高さ分だけコンテンツを下げる
  var height = $(".js-header").height();
  $("main").css("margin-top", height);

  // ヘッダーの高さ取得
  var headerHeight = $(".js-header").height();
  $('a[href^="#"]').click(function () {
    var speed = 600;
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    // ヘッダーの高さ分下げる
    var position = target.offset().top - headerHeight;
    $("body,html").animate({
      scrollTop: position
    }, speed, "swing");
    return false;
  });
});