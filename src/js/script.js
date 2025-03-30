
jQuery(function ($) { // この中であればWordpressでも「$」が使用可能になる
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

    var topBtn = $(".cycle__button");
    topBtn.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 800) {
        topBtn.fadeIn();
        } else {
        topBtn.fadeOut();
        }
    });



const swiper = new Swiper(".swiper", {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
    el: ".swiper-pagination",
    clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next", // 順番に注意
    prevEl: ".swiper-button-prev",
    },
    breakpoints: {
    768: {
        slidesPerView: 1.5,
        centeredSlides: true,
        spaceBetween: 40,
},
    },
});

// スクロールアニメーション
$(window).on('load scroll', function () {
  var triggerMargin = 150;

  // 共通関数：表示エリアに入ったら is-active を付与
  function activateOnScroll(targetClass) {
    var elements = document.querySelectorAll(targetClass);
    for (var i = 0; i < elements.length; i++) {
      var elem = elements[i];
      if (window.innerHeight > elem.getBoundingClientRect().top + triggerMargin) {
        elem.classList.add('is-active');
      }
    }
  }

  activateOnScroll('.scroll-up');
  activateOnScroll('.scroll_left');
  activateOnScroll('.scroll_right');
});
