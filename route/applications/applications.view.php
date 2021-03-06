<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?= PROJNAME ?>| Заявки</title>
    <script defer src="/js/script.js"></script>
    <script type="module" defer src="/ajax/ajax-main.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/main-modal.view.php"?>
    <div class="wrapper wrapper-catalog">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/header.view.php"?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/catalog.view.php"?>
        <main class="main">
            <div class="container">
                <h2>Ваши заявки</h2>
                <div class="user-applications">
                    <?php if(isset($userApplications) && count($userApplications)>0):?>
                    <?php foreach ($userApplications as $userApplication):?>
                        <a href="">
                            <div class="row user-application">
                                <span>Заявка №<?=$userApplication->id?></span>
                                <span><?=$userApplication->name?></span>
                                <span><?=$userApplication->created_at?></span>
                                <span><?=$userApplication->sum_price?> руб.</span>
                            </div>
                        </a>
                    <?php endforeach;?>
                    <?php else:?>
                        <span>У вас ещё нет заявок. </span>
                    <?php endif;?>
                </div>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.view.php"?>
    </div>
</body>
</html>