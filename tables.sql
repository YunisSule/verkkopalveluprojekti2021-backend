CREATE TABLE IF NOT EXISTS `user`
(
    user_id     int AUTO_INCREMENT,
    is_admin    boolean      NOT NULL,
    username    varchar(255) NOT NULL,
    password    varchar(255) NOT NULL,
    firstname   varchar(255) NOT NULL,
    lastname    varchar(255) NOT NULL,
    email       varchar(255) NOT NULL,
    address     varchar(255) NOT NULL,
    city        varchar(255) NOT NULL,
    postal_code varchar(5)   NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS `category`
(
    category_id int AUTO_INCREMENT,
    name        varchar(255) NOT NULL,
    PRIMARY KEY (category_id)
);

CREATE TABLE IF NOT EXISTS `product`
(
    product_id  int AUTO_INCREMENT,
    name        varchar(255)  NOT NULL,
    brand       varchar(255)  NOT NULL,
    description MEDIUMTEXT    NOT NULL,
    image_path  varchar(255)  NOT NULL,
    price       decimal(6, 2) NOT NULL,
    category_id int           NOT NULL,
    color       varchar(255)  NOT NULL,
    stock       int           NOT NULL,
    speed       int,
    glide       int,
    turn        int,
    fade        int,
    FULLTEXT (name, brand, description, color),
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_id) REFERENCES `category` (category_id)
);

CREATE TABLE IF NOT EXISTS `order`
(
    order_id   int AUTO_INCREMENT,
    user_id    int                                      NOT NULL,
    state      enum ('ordered', 'shipped', 'completed') NOT NULL,
    order_date datetime                                 NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (user_id) REFERENCES `user` (user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `order_row`
(
    order_row  int AUTO_INCREMENT,
    order_id   int NOT NULL,
    product_id int NOT NULL,
    quantity   int NOT NULL,
    PRIMARY KEY (order_row),
    FOREIGN KEY (order_id) REFERENCES `order` (order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES `product` (product_id) ON DELETE CASCADE
);

INSERT IGNORE INTO `user`
VALUES (1, false, 'mikko', 'salasana', 'Mikko', 'Mallikas', 'mikko@mail.com', 'katu 12', 'Helsinki', '00120');
INSERT IGNORE INTO `category`
VALUES (1, 'Kiekot');
INSERT IGNORE INTO `category`
VALUES (2, 'Kassit');
INSERT IGNORE INTO `order`
VALUES (1, 1, 'ordered', '2021-11-09 12:00:00');
INSERT IGNORE INTO `order_row`
VALUES (1, 1, 1, 50);
INSERT IGNORE INTO `order_row`
VALUES (2, 1, 2, 15);

-- PRODUCTS

-- PUTTERIT

INSERT IGNORE INTO `product`
VALUES (1, 'STEADY MINT', 'CLASH DISCS',
        'Mint on ylivakaa putteri (lähestymiskiekko), joka soveltuu erinomaisesti tuulisille keleille sekä matalan profiilinsa vuoksi mainiosti myös kämmenheittoihin. Mint pitää linjansa myös pitkissä lähestymisissä.',
        'stedmintpr1.png', 19.90, 1, 'valkoinen', 25, 4, 3, 0, 3);
INSERT IGNORE INTO `product`
VALUES (2, 'STEADY POPCORN', 'CLASH DISCS',
        'Popcorn on matalahkon profiilin omaava suoralentoinen putteri, josta saat helposti hyvän otteen. Sopii mainiosti niin puttaamiseen kuin heittoputteriksi.',
        'stedpopcpr2.png', 19.90, 1, 'valkoinen', 30, 3, 3, 0, 1);
INSERT IGNORE INTO `product`
VALUES (3, 'PREMIUM JOKERI', 'PRODISCUS',
        'JOKERi on monikäyttöinen putteri ja lähestymiskiekko, jossa vakautta riittää myös pitkiin ja koviin heittoihin.',
        'prjoketh3.png', 22.90, 1, 'vihreä', 15, 3, 3, 1, 2);
INSERT IGNORE INTO `product`
VALUES (4, 'ULTRIUM JOKERI', 'PRODISCUS',
        'JOKERi on monikäyttöinen putteri ja lähestymiskiekko, jossa vakautta riittää myös pitkiin ja koviin heittoihin.',
        'uljoketh4.png', 24.90, 1, 'sininen', 10, 3, 3, 1, 2);
INSERT IGNORE INTO `product`
VALUES (5, 'K3 HARD REKO', 'KASTAPLAST',
        'Reko has a comfortable rounded profile and a smooth bead, which will fit most players’ hands. Easy to grip and easy to throw. It features a strengthened shoulder which adds a little extra durability compared to the average putter. Reko is Swedish for good, reliable or decent. The world needs more Reko.',
        'k3hreko5.jpgs', 11.90, 1, 'pinkki', 13, 3, 3, 0, 1);
INSERT IGNORE INTO `product`
VALUES (6, 'K1 SOFT REKO', 'KASTAPLAST',
        'Reko has a comfortable rounded profile and a smooth bead, which will fit most players’ hands. Easy to grip and easy to throw. It features a strengthened shoulder which adds a little extra durability compared to the average putter. Reko is Swedish for good, reliable or decent. The world needs more Reko.',
        'k1sreko6.jpgs', 16.90, 1, 'valkoinen', 43, 3, 3, 0, 1);
INSERT IGNORE INTO `product`
VALUES (7, 'SUPERGLOW WIZARD', 'GATEWAY',
        'Gatewayn glow-muoviset kiekot sopivat loistavasti yöpelaamiseen, mutta kestävyytensä ja ominaisuuksiensa ansiosta ne ovat haluttuja myös normaaliin päiväkäyttöön. Wizard on erittäin monipuolinen putteri, jolla pärjäät myös tuulisemmissa olosuhteissa. Sen reunan alaosassa on bead, joka tekee siitä muita Gatewayn puttereita vakaamman.',
        'glwsswiza7.jpgs', 16.90, 1, 'valkoinen', 34, 2, 2, 0, 2);
INSERT IGNORE INTO `product`
VALUES (8, 'ROYAL SENSE FAITH', 'LATITUDE 64',
        'Faith on pyöreäreunainen korkeahkon profiilin putteri, jonka lentoradan kerrotaan olevan suora. Sopii erinomaisesti sekä puttaamiseen että lähestymisiin.',
        'rogfait8.jpg', 14.90, 1, 'harmaa', 19, 2, 3, 0, 1);

-- DRAIVERIT

INSERT IGNORE INTO `product`
VALUES (9, 'FUZION-X SERGEANT', 'DYNAMIC DISCS',
        'Sergeant eli kersantti on eräänlainen väylä - ja pituusdraiverien väliin sopiva hybridi, joka on ominaisuuksiltaan kuin nopeampi Getaway tai hitaampi Raider. Mainio lisä bägiin väylille, joissa väylädraiverit tuntuvat liian heppoisilta ja pituusdraiveri liian nopealta. Sergeant sopii profiililtaan mainiosti sekä kämmen -että rystyheittoihin, ja vaikka se kovalla vedolla voi hieman kääntää yli, palauttaa lennon lopun feidi sen jämäkästi takaisin.',
        'fuxsergpsts9.jpg', 23.90, 1, 'punainen', 12, 11, 4, 0, 2);
INSERT IGNORE INTO `product`
VALUES (10, 'TOURNAMENT-X ADDER', 'WESTSIDE DISCS', 'Adder on erittäin nopea ja ylivakaa pituusdraiveri',
        'touxaddenlts10.jpg', 23.90, 1, 'keltainen', 30, 13, 5, 0, 4);
INSERT IGNORE INTO `product`
VALUES (11, 'GOLD ORBIT DIAMOND', 'LATITUDE 64',
        'Diamond on erinomainen kiekko aloittelevalle harrastajalle ja lapsille. Tätä kiekkoa valmistetaan vain kevyenä (145-159 g), mikä tekee Diamondista helposti kontrolloitavan ja mukavan heittää.',
        'Diamond-10year_Gray-Black11.jpg', 23.90, 1, 'valkoinen', 44, 8, 6, 0, 1);
INSERT IGNORE INTO `product`
VALUES (12, 'FUZION-X MAVERICK', 'DYNAMIC DISCS',
        'Maverick on alivakaa väylädraiveri joka löytää paikkansa monenlaisen pelaajan repusta. Kapean reunan ansiosta se sopii hyvin useimpien käteen ja toimii mainiosti aloitteleville pelaajille suoraan lentävänä kontrollidraiverina. Kokeneemmat ja pidemmälle heittävät pelaajat saavat Maverickista luotettavan antsakiekon. Iso osa tämän kiekon tuotosta menee suoraan Zach Meltonin kisakiertueen tukemiseen.',
        'fuxmavetszm21v12.jpg', 23.90, 1, 'keltainen', 6, 7, 4, 0, 2);
INSERT IGNORE INTO `product`
VALUES (13, '500 H2 V2', 'PRODIGY DISC',
        'H2 V2 on uusi versio suositusta H2-kiekosta. H2 V2 on ylivakaa keskimatkan draiveri. Siinä on edeltäjäänsä verrattuna hieman matalampi reunan syvyys ja terävämpi ulkoreuna. Näiden uudistusten myötä uusi H2 V2 on nopeampi ja liitää pitkälle.',
        '5sh2v13.jpgs', 17.90, 1, 'sininen', 22, 10, 5, 0, 2);
INSERT IGNORE INTO `product`
VALUES (14, '750 H2 V2', 'PRODIGY DISC',
        'H2 V2 on uusi versio suositusta H2-kiekosta. H2 V2 on ylivakaa keskimatkan draiveri. Siinä on edeltäjäänsä verrattuna hieman matalampi reunan syvyys ja terävämpi ulkoreuna. Näiden uudistusten myötä uusi H2 V2 on nopeampi ja liitää pitkälle.',
        '75sh2v14.png', 18.90, 1, 'oranssi', 7, 10, 5, 0, 2);
INSERT IGNORE INTO `product`
VALUES (15, 'BIG Z ANAX', 'DISCRAFT',
        'A strong, overstable fairway driver with the sharp rim of a distance driver but the comfort, thinner rim, and precision of a fairway driver. The Anax has quickly become a staple in player\'s bags across the globe. Stamped with Paul\'s standard stock design, these discs are timeless.',
        'bizanax15.png', 23.90, 1, 'vihreä', 2, 10, 6, 0, 3);
INSERT IGNORE INTO `product`
VALUES (16, 'STAR DESTROYER', 'INNOVA',
        'Destroyer on erittäin nopea ja vakaa pitkän matkan draiveri. Iso D on nopeampi ja vakaampi kuin suosittuna pidetty Wraith. Kovaa heittäville ja tuulisiin olosuhteisiin. Jussi Meresmaa heitti Pro Destroyerilla pituusheiton maailmanmestaruuden vuonna 2008 ja samalla Suomen pituusheittoennätyksen 204 m!',
        'stswdestrw16.png', 32.90, 1, 'vihreä', 5, 12, 5, 0, 3);

-- KASSIT

INSERT IGNORE INTO `product`
VALUES (17, 'SLING SHOULDER BAG', 'WESTSIDE DISCS',
        'Kevyt, 10-12 kiekkoa vetävä minimaalinen olkalaukku, jossa yksi osasto n. 10 kiekolle ja kahden kiekkon putteritasku. Laukussa on olkahihna sekä lenkit vyölle kiinnittämistä varten.',
        'slingshwd17.jpg', 24.90, 2, 'musta', 24, NULL, NULL, NULL, NULL);
INSERT IGNORE INTO `product`
VALUES (18, 'SHUTTLE BACKPACK', 'MVP DISC SPORTS',
        'The MVP Shuttle Bag is a new compact light backpack with a great disc capacity. The MVP Shuttle Bag is perfect for quick rounds or making the move to a backpack style bag to expand your options out on course. The MVP Shuttle Bags are available in Gray with multiple accent colors: Aqua, Red, Orange, Lime Green, and Royal Blue. The main compartment is designed to hold 12-14 discs with the top compartment holding 2 disc and personal items or up to 6 discs. The Shuttle Bag also has a side panel pocket, larger side pocket storage, and a standard large drink holder. The Shuttle Bag also has adjustable padded straps for comfortable wear for players of all sizes. For a compact and affordable backpack bag check out the new MVP Shuttle bag.',
        'shutbamvp_mvp-gr-royal18.jpg', 19.00, 2, 'harmaa', 13, NULL, NULL, NULL, NULL);
INSERT IGNORE INTO `product`
VALUES (19, 'TREENIKASSI', 'PRODIGY DISC',
        'Treenikassi Practice Bag V2 on loistava ratkaisu kiekkojen kuljetukseen ja säilytykseen. Laukkuun mahtuu 30-45 kiekkoa, ja ne on helppo pitää järjestyksessä siirrettävien väliseinien avulla. Practice Bag sopii erinomaisesti esimerkiksi koulujen ja seurojen koulutuskäyttöön tai kenelle tahansa aktiiviharrastajalle. Tässä vuodelle 2020 parannellussa versiossa on materiaalina Nylon Ripstop -kangas, joka on entistä kestävämpää ja hylkii myös vettä. Practice Bag V2 -kassissa on laukun molempiin päihin lisätty taskut. Toisessa päässä laukkua on nyt juomapullotasku, ja toisessa magneettisella lipalla varustettu tarviketasku.',
        'prabgprv220_prod-v3navy19.jpq', 35.00, 2, 'sininen', 34, NULL, NULL, NULL, NULL);
INSERT IGNORE INTO `product`
VALUES (20, 'DG LUXURY BACKPACK E4', 'LATITUDE 64',
        'DG Luxury BackPack on tehty kestävästä nailonkankaasta. Repun etutasku on suunniteltu tasapainottamaan reppua ja siten sen pitäisi pysyä hyvin pystyssä. Kiekko-osioon mahtuu noin 20 kiekkoa, mutta jos taskutkin täyttää kiekoilla vetää reppu noin 30-35 kiekkoa. Latituden Luxury E4 -reppubägillä on takuu koskien valmistusvikoja ja materiaalivirheitä. Takuu ei korvaa tilanteissa, joissa reppua on käytetty tahallisesti väärin, eikä se myöskään korvaa normaalista kulumisesta johtuvia vikoja.',
        'luxbaglae4_la-r-b20.jpq', 199.00, 2, 'punainen', 22, NULL, NULL, NULL, NULL);
INSERT IGNORE INTO `product`
VALUES (21, 'KYLMÄLAUKKU', 'ZÜCA',
        'The CoolZÜCA Cooler has been designed to complement the ZÜCA rolling product line by fitting neatly on top of the seat and attaching securely to the telescoping handle.',
        'dgcartzucool21.jpg', 40.00, 2, 'musta', 13, NULL, NULL, NULL, NULL);

