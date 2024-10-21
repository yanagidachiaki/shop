document.addEventListener("DOMContentLoaded", function () {
    // ハンバーガーメニューの処理
    const hamburger = document.getElementById("hamburger");
    const nav = document.getElementById("nav");

    hamburger.addEventListener("click", function () {
        nav.classList.toggle("is-open"); // ナビゲーションメニューの開閉を切り替える
        hamburger.classList.toggle("is-active"); // ハンバーガーボタンの状態を切り替える
    });

});
