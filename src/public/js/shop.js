document.addEventListener("DOMContentLoaded", function () {
    // ハンバーガーメニューの処理
    const hamburger = document.getElementById("hamburger");
    const nav = document.getElementById("nav");

    hamburger.addEventListener("click", function () {
        nav.classList.toggle("is-open"); // ナビゲーションメニューの開閉を切り替える
        hamburger.classList.toggle("is-active"); // ハンバーガーボタンの状態を切り替える
    });

});

 // 予約フォームの要素を取得
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');
    const numberSelect = document.getElementById('number');

    // 予約概要を表示する要素を取得
    const summaryDate = document.getElementById('summary-date');
    const summaryTime = document.getElementById('summary-time');
    const summaryNumber = document.getElementById('summary-number');

    // 日付入力が変更されたときに予約概要に反映
    dateInput.addEventListener('input', function() {
        summaryDate.textContent = dateInput.value;
    });

    // 時間入力が変更されたときに予約概要に反映
    timeInput.addEventListener('input', function() {
        summaryTime.textContent = timeInput.value;
    });

    // 人数選択が変更されたときに予約概要に反映
    numberSelect.addEventListener('change', function() {
        // 選択された人数に応じて "人" を付加
        const selectedOption = numberSelect.options[numberSelect.selectedIndex].text;
        summaryNumber.textContent = selectedOption;
    });

