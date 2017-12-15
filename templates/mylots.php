<main>
    <nav class="nav">
        <ul class="nav__list container">
            <li class="nav__item">
                <a href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Крепления</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Ботинки</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Одежда</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Инструменты</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Разное</a>
            </li>
        </ul>
    </nav>
    <section class="rates container">
        <h2>Мои ставки</h2>
        <table class="rates__list">
            <?php foreach ($cookies as $key => $value) : ?>
                <tr class="rates__item">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img src="<?=$value['url']; ?>" width="54" height="40" alt="<?=$value['name']; ?>">
                        </div>
                        <h3 class="rates__title"><a href="lot.html"><?=$value['name']; ?></a></h3>
                    </td>
                    <td class="rates__category">
                        <?=$value['categories']; ?>
                    </td>
                    <td class="rates__timer">
                        <div class="timer timer--finishing">07:13:34</div>
                    </td>
                    <td class="rates__price">
                        <?=$value['bet']; ?>
                    </td>
                    <td class="rates__time">
                        <?=$value['lotDate']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>