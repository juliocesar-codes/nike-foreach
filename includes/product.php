<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

$stmt = $pdo->query("SELECT * FROM produtos WHERE id = $id");
$product = $stmt->fetchAll();

$prodNome = $product[0]['nome'];
$prodModelo = $product[0]['modelo'];
$prodCategoria = $product[0]['categoria'];
$prodPreco = $product[0]['preco'];
$prodDesconto = $product[0]['desconto'];

$qCores = $pdo->query("SELECT * FROM cores WHERE prod_id = $id");
$cores = $qCores->fetchAll();
$cor = $cores[0]['cor'];

    $product_file = "{$prodModelo}-{$cor}";

$qSizes = $pdo->query("SELECT tamanho FROM tamanhos WHERE prod_id = $id");
$sizes = $qSizes->fetchAll();

} else {
    header('Location: 404.php');
    exit;
}

?>

<div class="product">
    <div class="product-img">
        <div class="large">
            <img src="assets/shoes/<?= "{$product_file}-1.avif"; ?>" alt="" id="large">
        </div>
        <div class="thumbs">
            <?php
            for ($i = 1; $i <= 8; $i++) {
            ?>
                <div class="thumbnail" onmouseover="changeImage('<?= $i; ?>')">
                    <img src="assets/shoes/<?= "{$product_file}-{$i}.avif"; ?>" alt="" id="thumb<?= "{$i}"; ?>">
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="product-desc">
        <h1><?= "{$prodNome}"; ?></h1>
        <h3><?= "{$prodCategoria}"; ?></h3>
        <div class="classification">
            <div class="stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <p><span>4.5</span>20 avaliações</p>
        </div>
        <div class="price">
            <h2><?= Discount($prodPreco, $prodDesconto); ?>
            </h2>
            <h4>ou 10x de R$ <?= number_format(($prodPreco - $prodPreco / 100 * $prodDesconto) / 10, 2, ",", "."); ?>
            </h4>
        </div>
        <div class="color-selector">
            <?php
            $colors = $cores;
            foreach ($colors as $color) {
            ?>
                <div onmousedown="colorSelector('<?= $color; ?>')" id="<?= "{$color}"; ?>" class="choice">
                    <img src="assets/shoes/<?= "{$prodModelo}-{$cor}-1.avif"; ?>" alt="">
                </div>
            <?php
            }
            ?>
        </div>
        <div class="size">
            <h3>Tamanhos</h3>
            <?php
            $tamanhos = array_column($sizes, 'tamanho');
            for ($s = 35; $s <= 44; $s++) {
                if (in_array($s, $tamanhos)) {
            ?>
                    <input type="radio" class="trigger" name="size" id="<?= $s; ?>">
                    <label for="<?= $s; ?>"><?= $s; ?></label>
                <?php
                } else {
                ?>
                    <input type="radio" class="trigger" name="size" id="<?= $s; ?>" disabled>
                    <label for="<?= $s; ?>"><?= $s; ?></label>
            <?php
                }
            }
            ?>
        </div>
        <div class="buttons">
            <a href="#" class="cart">Adicionar ao carrinho</a>
            <a href="#" class="fav">Salvar nos favoritos<i class="fa-regular fa-heart"></i></a>
        </div>
        <div class="share">
            <a href="https://api.whatsapp.com/send/?text=Ol%C3%A1!%20Olha%20s%C3%B3%20esse%20site%20que%20eu%20criei%20na%20aula.%20https%3A%2F%2Ffhricardo.github.io%2Fnike-air-jordan%2F"
                target="_blank">
                <p>Compatilhar no <i class="fa-brands fa-whatsapp"></i> WhatsApp</p>
            </a>
        </div>
        <div class="about">
            <p>Inspirado no AJ1 original, essa edição cano médio mantém o visual icônico que você ama, enquanto
                a escolha de cores e o couro conferem uma identidade distinta.</p>
        </div>
        <div class="benefits">
            <input type="checkbox" id="Benefits" class="trigger">
            <div class="benefits-text">
                <label for="Benefits">
                    <h3>Benefícios</h3>
                    <ul class="benefit-det">
                        <li>Cabedal em material genuíno, sintético e tecido para sensação de suporte.</li>
                        <li>Entressola de espuma e amortecimento Nike Air proporcionam conforto e leveza.</li>
                        <li>Solado de borracha com ponto de giro cria tração duradoura.</li>
                    </ul>
                </label>
            </div>

        </div>
    </div>
</div>
<script>
    var thisColor = "<?= "{$colors[0]}"; ?>"
    console.log(thisColor)

    function changeImage(img) {
        console.log(img)
        let picture = document.getElementById("large")
        picture.src = `assets/shoes/<?= "{$product['model']}"; ?>-${thisColor}-${img}.avif`
    }

    function colorSelector(color) {
        console.log(color)
        thisColor = color
        var theImage = 1;
        while (theImage <= 8) {
            let cod = `thumb${theImage}`
            thumbFile = `assets/shoes/<?= $product['model']; ?>-${thisColor}-${theImage}.avif`
            console.log(thumbFile)
            var thumb = document.getElementById(cod)
            thumb.src = thumbFile
            theImage++
        }
        changeImage(1)
    }
</script>