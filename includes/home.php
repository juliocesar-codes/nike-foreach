<div class="grid-prod">
    <?php
    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll();
    foreach($produtos as $id => $produto){
        $id += 1;
        $prodNome = $produto['nome'];
        $prodModelo = $produto['modelo'];
        $prodCategoria = $produto['categoria'];
        $prodPreco = $produto['preco'];
        $prodDesconto = $produto['desconto'];
    
        $qColor = $pdo->query("SELECT * FROM cores WHERE prod_id = $id");
        $colors = $qColor->fetchAll();
        $cor = $colors[0]['cor'];
    ?>
        <a href="detail.php?id=<?= $id; "{$id}"; ?>">
            <div class="prod">
                <div class="prod-img">
                    <img src="assets/shoes/<?= "{$prodModelo}-{$cor}-1.avif"; ?>" alt="">
                </div>
                <div class="prod-card">
                    <div class="prod-name">
                        <?= "{$prodNome}"; ?>
                    </div>
                    <div class="prod-cat">
                        <?= "{$prodCategoria}"; ?>
                    </div>
                    <div class="prod-price">
                        <div>
                            <span class="price-current">
                                <?php
                                Discount($prodPreco, $prodDesconto);
                                ?>
                            </span>
                            <span class="payment">no Pix</span>
                        </div>
                        <div aria-label="preço antigo" class="old-price">
                            <?php
                            Price($prodPreco);
                            ?></div>
                        <div class="discount">
                            <?= "{$prodDesconto}%"; ?> off</div>
                    </div>
                </div>

            </div>
        </a>
    <?php
    }
