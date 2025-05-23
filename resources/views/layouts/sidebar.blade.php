<style>
    body {
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        height: calc(100vh - 60px);
        margin-top: 60px;
    }

    .sidebar {
        width: 250px;
        background-color: #facc15;
        color: #6b4226;
        padding: 20px;
        position: fixed;
        top: 100px;
        left: 0;
        bottom: 20px;
        overflow-y: auto;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .main-content {
        margin-left: 250px;
        padding: 30px 60px;
        flex: 1;
        overflow-y: auto;
        height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        gap: 20px;
        scrollbar-width: none;
    }

    .main-content::-webkit-scrollbar {
        width: 8px;
    }

    .main-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }

    .add-todo {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    .section-title {
        font-weight: bold;
        margin: 25px 0 10px;
        color: #6b4226;
    }

    .template1-button,
    .template2-button,
    .today-button,
    .study-button,
    .family-button,
    .school-button,
    .work-button,
    .others-button {
        width: 210px;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .template1-button {
        background-color: #fff;
        color: #000;
        border-color: #fff;
    }

    .template2-button {
        background-color: #ff0000;
        color: #000;
        border-color: #ff0000;
    }

    .template1-button:hover {
        border-color: #000;
    }

    .template2-button:hover,
    .today-button:hover,
    .study-button:hover,
    .family-button:hover,
    .school-button:hover,
    .work-button:hover,
    .others-button:hover {
        border-color: white;
    }

    .today-button { background-color: #17d239; color: white; }
    .study-button { background-color: #f5156f; color: white; }
    .family-button { background-color: #113ceb; color: white; }
    .school-button { background-color: #f77d1a; color: white; }
    .work-button { background-color: #b42ed9; color: white; }
    .others-button { background-color: #000; color: white; }

    .add-button {
        background-color: #6b4226;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
    }

    
</style>

<div class="sidebar">
    <div class="menu">
        <h3 class="section-title">テンプレート</h3>
        <ul style="list-style: none; padding-left: 0;">
            <li><button class="template1-button">タスク一覧</button></li>
            <li><button class="template2-button">完了タスク一覧</button></li>
        </ul>
        <h3 class="section-title">作成ジャンル</h3>
        <ul style="list-style: none; padding-left: 0;">
            <li><button class="today-button">T O D A Y</button></li>
            <li><button class="study-button">勉　強</button></li>
            <li><button class="family-button">家　族</button></li>
            <li><button class="school-button">娯　楽</button></li>
            <li><button class="work-button">バ　イ　ト</button></li>
            <li><button class="others-button">そ　の　他</button></li>
        </ul>
    </div>
</div>
