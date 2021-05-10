<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?=PROJNAME?> | Доставка и оплата</title>
    <script defer src="/js/script.js"></script>
    <script type="module" defer src="/ajax/ajax-main.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/main-modal.view.php"?>
    <div class="wrapper wrapper-catalog">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/header.view.php"?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/catalog.view.php"?>
        <main class="main row">
            <div class="container">
                <h2>Порядок оплаты</h2>
                <div class="grid-payment">
                    <div class="row">
                        <img src="/imgs/delievery.png" alt="Доставка">
                    </div>
                    <div class="row"> 
                        <p>Для того, чтобы купить товар, Вам необходимо будет добавить нужное наименование в необходимом количестве в коризну. После необходимо подтвердить покупку.
                            После подтверждения покупки, в вашем личном кабинете в разделе заявки появится новая заявка. По каждый из заявок существует её статус</p>
                    </div>
                    <div class="col">                
                        <h3>Статусы</h3>
                        <ul>
                            <li><span>В рассмотрении</span></li>
                            <li><span>Принята</span></li>
                            <li><span>Закончена</span></li>
                            <li><span>Отменена</span></li>
                        </ul>
                    </div>
                    <div class="row">
                        <img src="/imgs/payment.png" alt="Оплата">
                    </div>
                </div>
                
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.view.php"?>
    </div>
</body>
</html>
