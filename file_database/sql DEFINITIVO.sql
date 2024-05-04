CREATE TABLE `supermarkets` (
  `chain` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` point NOT NULL,
  PRIMARY KEY (`chain`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO supermarkets (chain, name, location)
VALUES
  ('Coop', 'Roma Sud', ST_GeomFromText('POINT(41.892751 12.486421)')),
  ('Todis', 'Piazza Navona', ST_GeomFromText('POINT(41.900611 12.463422)')),
  ('Carrefour', 'Porta Maggiore', ST_GeomFromText('POINT(41.866280 12.527536)')),
  ('Esselunga', 'Via del Corso', ST_GeomFromText('POINT(41.897361 12.478153)')),
  ('Coop', 'Trastevere', ST_GeomFromText('POINT(41.884903 12.460778)')),
  ('Todis', 'Piazza di Spagna', ST_GeomFromText('POINT(41.902453 12.476432)')),
  ('Carrefour', 'Fiumicino', ST_GeomFromText('POINT(41.793349 12.315575)')),
  ('Esselunga', 'Tuscolano', ST_GeomFromText('POINT(41.865292 12.502428)')),
  ('Coop', 'Monteverde', ST_GeomFromText('POINT(41.885456 12.442292)')),
  ('Todis', 'Garbatella', ST_GeomFromText('POINT(41.860048 12.465022)')),
  ('Carrefour', 'Tiburtina', ST_GeomFromText('POINT(41.913002 12.514929)')),
  ('Esselunga', 'Appio Claudio', ST_GeomFromText('POINT(41.877431 12.508034)')),
  ('Coop', 'San Giovanni', ST_GeomFromText('POINT(41.881104 12.507951)')),
  ('Todis', 'Marconi', ST_GeomFromText('POINT(41.898163 12.458444)')),
  ('Carrefour', 'Anagnina', ST_GeomFromText('POINT(41.881045 12.554222)')),
  ('Esselunga', 'Ciampino', ST_GeomFromText('POINT(41.723047 12.509103)')),
  ('Coop', 'Prati', ST_GeomFromText('POINT(41.903506 12.471773)')),
  ('Todis', 'Balduina', ST_GeomFromText('POINT(41.915257 12.478132)')),
  ('Carrefour', 'Laurentina', ST_GeomFromText('POINT(41.855445 12.483314)')),
  ('Esselunga', 'Gregorio VII', ST_GeomFromText('POINT(41.911403 12.465072)')),
  ('Coop', 'Eur', ST_GeomFromText('POINT(41.830397 12.470904)')),
  ('Todis', 'Ostiense', ST_GeomFromText('POINT(41.867424 12.484839)')),
  ('Carrefour', 'Cinecittà', ST_GeomFromText('POINT(41.852232 12.568705)')),
  ('Esselunga', 'Monti', ST_GeomFromText('POINT(41.896803 12.490781)')),
  ('Coop', 'Aventino', ST_GeomFromText('POINT(41.880237 12.484294)')),
  ('Todis', 'San Lorenzo', ST_GeomFromText('POINT(41.897922 12.514731)')),
  ('Carrefour', 'Parioli', ST_GeomFromText('POINT(41.920283 12.492215)')),
  ('Esselunga', 'San Paolo', ST_GeomFromText('POINT(41.860662 12.478776)')),
  ('Coop', 'Prenestino', ST_GeomFromText('POINT(41.876939 12.555413)')),
  ('Todis', 'Tor Pignattara', ST_GeomFromText('POINT(41.876731 12.573583)')),
  ('Carrefour', 'Aurelia', ST_GeomFromText('POINT(41.896993 12.424998)')),
  ('Esselunga', 'Villa Ada', ST_GeomFromText('POINT(41.926189 12.502845)')),
  ('Coop', 'Torre Maura', ST_GeomFromText('POINT(41.865688 12.615586)')),
  ('Todis', 'Casilina', ST_GeomFromText('POINT(41.869731 12.588598)')),
  ('Carrefour', 'Tuscolana', ST_GeomFromText('POINT(41.869871 12.529141)')),
  ('Esselunga', 'Villa Borghese', ST_GeomFromText('POINT(41.914895 12.491772)')),
  ('Coop', 'San Lorenzo', ST_GeomFromText('POINT(41.901047 12.516926)')),
  ('Todis', 'Aurelio', ST_GeomFromText('POINT(41.894726 12.430344)')),
  ('Carrefour', 'Collatino', ST_GeomFromText('POINT(41.892112 12.591329)')),
  ('Esselunga', 'Torrino', ST_GeomFromText('POINT(41.824627 12.470923)')),
  ('Coop', 'Piazza Bologna', ST_GeomFromText('POINT(41.910775 12.518717)')),
  ('Todis', 'Gianicolense', ST_GeomFromText('POINT(41.877858 12.450804)')),
  ('Carrefour', 'Cipro', ST_GeomFromText('POINT(41.906707 12.449112)')),
  ('Esselunga', 'Cinecittà', ST_GeomFromText('POINT(41.851588 12.571788)')),
  ('Coop', 'Ostia', ST_GeomFromText('POINT(41.745629 12.283401)')),
  ('Todis', 'Centocelle', ST_GeomFromText('POINT(41.868377 12.578287)')),
  ('Carrefour', 'Ponte Milvio', ST_GeomFromText('POINT(41.927403 12.469468)')),
  ('Esselunga', 'Trionfale', ST_GeomFromText('POINT(41.910431 12.425242)')),
  ('Coop', 'Monte Mario', ST_GeomFromText('POINT(41.935759 12.447064)')),
  ('Todis', 'Primavalle', ST_GeomFromText('POINT(41.918976 12.434181)')),
  ('Carrefour', 'Axa', ST_GeomFromText('POINT(41.861085 12.525102)')),
  ('Esselunga', 'Talenti', ST_GeomFromText('POINT(41.936588 12.547327)')),
  ('Coop', 'Grottarossa', ST_GeomFromText('POINT(41.981713 12.532292)')),
  ('Todis', 'Piramide', ST_GeomFromText('POINT(41.877832 12.484828)')),
  ('Carrefour', 'Euclide', ST_GeomFromText('POINT(41.915861 12.490706)')),
  ('Esselunga', 'Torrevecchia', ST_GeomFromText('POINT(41.933870 12.416921)')),
  ('Coop', 'Portuense', ST_GeomFromText('POINT(41.866985 12.467944)')),
  ('Todis', 'Tor Vergata', ST_GeomFromText('POINT(41.854510 12.603783)')),
  ('Carrefour', 'Nomentana', ST_GeomFromText('POINT(41.919477 12.532757)')),
  ('Esselunga', 'Portonaccio', ST_GeomFromText('POINT(41.905526 12.512989)')),
  ('Coop', 'Magliana', ST_GeomFromText('POINT(41.830877 12.429167)')),
  ('Todis', 'Giustiniana', ST_GeomFromText('POINT(41.945652 12.421984)')),
  ('Carrefour', 'Boccea', ST_GeomFromText('POINT(41.906495 12.409423)')),
  ('Esselunga', 'Corso Francia', ST_GeomFromText('POINT(41.937656 12.481287)')),
  ('Coop', 'Villa Pamphili', ST_GeomFromText('POINT(41.881563 12.440373)')),
  ('Todis', 'Tormarancia', ST_GeomFromText('POINT(41.823960 12.484655)')),
  ('Carrefour', 'Selva Candida', ST_GeomFromText('POINT(41.950928 12.366331)')),
  ('Coop', 'Garbatella', ST_GeomFromText('POINT(41.864568 12.479283)')),
  ('Todis', 'EUR Laurentina', ST_GeomFromText('POINT(41.827364 12.477832)')),
  ('Esselunga', 'Piazza Vittorio', ST_GeomFromText('POINT(41.894543 12.504739)')),
  ('Coop', 'Monti', ST_GeomFromText('POINT(41.895267 12.490112)'));

CREATE TABLE categories (
  name VARCHAR(50) PRIMARY KEY,
  image VARCHAR(255),
  description TEXT
);

INSERT INTO categories (name, image, description) VALUES
('Carne', 'categories/carne.jpg', 'Tutti i tagli di carne fresca e preconfezionata, dai classici filetti alle salsicce artigianali.'),
('Vegetali', 'categories/vegetali.jpg', 'Un vasto assortimento di frutta e verdura fresca di stagione, proveniente da coltivazioni locali e biologiche.'),
('Pesce', 'categories/pesce.jpg', 'Pesce fresco e surgelato proveniente dai mari del mondo: dalla classica trota di fiume ai crostacei più pregiati.'),
('Bevande', 'categories/bevande.jpg', 'Birre artigianali, vini selezionati, bibite analcoliche e liquori per soddisfare ogni palato e occasione.'),
('Igiene e Casa', 'categories/igiene_casa.jpg', 'Detergenti per la pulizia della casa, prodotti per igiene personale e accessori per la cura della casa e della persona.'),
('Snack', 'categories/snack.jpg', 'Snack dolci e salati per uno spuntino veloce o per accompagnare i momenti di relax.'),
('Dolci', 'categories/dolci.jpg', 'Dolci freschi e da forno, pasticceria secca, cioccolatini e caramelle per coccolarsi con un tocco di dolcezza.'),
('Surgelati', 'categories/surgelati.jpg', 'Prodotti surgelati di alta qualità, dalla pizza agli antipasti, per comodità e praticità senza rinunciare al gusto.'),
('Dispensa', 'categories/dispensa.jpg', 'Prodotti di base per la tua dispensa: dalla pasta ai legumi, dal riso alle conserve, tutto il necessario per le tue ricette quotidiane.'),
('Salumi e Formaggi', 'categories/salumi_formaggi.jpg', 'Salumi freschi e stagionati, formaggi italiani e internazionali, per creare taglieri e antipasti gustosi e ricchi di sapori.'),
('Healty', 'categories/salutare.jpg', 'Scelta di prodotti sani e biologici, senza conservanti o additivi artificiali, per uno stile di vita sano e equilibrato.');

CREATE TABLE products (
  Nome VARCHAR(255) PRIMARY KEY,
  peso INT,
  image VARCHAR(255),
  category VARCHAR(50),
  description TEXT,
  nutrients TEXT,
  health FLOAT CHECK (health >= 0.0 AND health <= 10.0) DEFAULT NULL,
  UNIQUE(Nome, category),
  FOREIGN KEY (category) REFERENCES categories(name)
);

INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES
  ('Spaghetti Molisano', 500, 'products/spaghetti.jpg', 'Dispensa', 'Spaghetti di alta qualità con una consistenza perfetta.', 'nutrienti da specificare', 7.0),
  ('Farfalle Barilla', 500, 'products/farfalle.jpg', 'Dispensa', 'Farfalle leggere e versatili, ideali per salse e insalate.', 'nutrienti da specificare', 7.0),
  ('Rigatoni De Cecco', 500, 'products/rigatoni.jpg', 'Dispensa', 'Rigatoni robusti e porosi, perfetti per trattenere il sugo.', 'nutrienti da specificare', 7.0),
  ('Mezze Maniche Barilla', 500, 'products/mezze_maniche.jpg', 'Dispensa', 'Mezze Maniche dal taglio corto, ideali per minestre e zuppe.', 'nutrienti da specificare', 7.0),
  ('Lasagne Barilla', 500, 'products/lasagne.jpg', 'Dispensa', 'Lasagne classiche per preparare deliziosi piatti al forno.', 'nutrienti da specificare', 7.0),
  ('Ditalini Barilla', 500, 'products/ditalini.jpg', 'Dispensa', 'Ditalini piccoli e cilindrici, perfetti per minestre.', 'nutrienti da specificare', 7.0),
  ('Fusilli Molisano', 500, 'products/fusilli.jpg', 'Dispensa', 'Fusilli avvolgenti e divertenti, ottimi con qualsiasi condimento.', 'nutrienti da specificare', 7.0),
  ('Radiatori Molisano', 500, 'products/radiatori.jpg', 'Dispensa', 'Radiatori dalla forma unica, ideali per catturare il sugo.', 'nutrienti da specificare', 7.0),
  ('Orecchiette Barilla', 500, 'products/orecchiette.jpg', 'Dispensa', 'Orecchiette pugliesi, perfette con broccoli e salsiccia.', 'nutrienti da specificare', 7.0),
  ('Pomodori San Marzano', 1000, 'products/pomodori.jpg', 'Vegetali', 'Pomodori San Marzano, dolci e succosi, ideali per sughi e salse.', 'nutrienti da specificare', 10.0),
  ('Insalata', 1000, 'products/insalata.jpg', 'Vegetali', 'Insalata fresca e croccante, perfetta per insalate miste.', 'nutrienti da specificare', 10.0),
  ('Datterini Gialli', 1000, 'products/datterini_gialli.jpg', 'Vegetali', 'Datterini gialli, dolci e aromatici, ottimi da gustare crudi.', 'nutrienti da specificare',10.0),
  ('Datterini Rossi', 1000, 'products/datterini_rossi.jpg', 'Vegetali', 'Datterini rossi, intensi e saporiti, perfetti per sughi.', 'nutrienti da specificare', 10.0),
  ('Zucchine', 1000, 'products/zucchine.jpg', 'Vegetali', 'Zucchine fresche e versatili, ottime grigliate o in padella.', 'nutrienti da specificare', 10.0),
  ('Melanzane', 1000, 'products/melanzane.jpg', 'Vegetali', 'Melanzane dal sapore ricco, ideali per parmigiana e grigliate.', 'nutrienti da specificare', 10.0),
  ('Zucca', 1000, 'products/zucca.jpg', 'Vegetali', 'Zucca dolce e nutriente, perfetta per zuppe e purè.', 'nutrienti da specificare', 10.0),
  ('Patate', 1000, 'products/patate.jpg', 'Vegetali', 'Patate fresche e versatili, ottime per purè e arrosti.', 'nutrienti da specificare', 10.0),
  ('Mele', 1000, 'products/mele.jpg', 'Vegetali', 'Mele croccanti e dolci, perfette per spuntini e dessert.', 'nutrienti da specificare', 10.0),
  ('Pere', 1000, 'products/pere.jpg', 'Vegetali', 'Pere succose e aromatiche, ideali per insalate e macedonie.', 'nutrienti da specificare', 10.0),
  ('Fragole', 1000, 'products/fragole.jpg', 'Vegetali', 'Fragole dolci e ricche di vitamina C, ottime da sole o con panna.', 'nutrienti da specificare', 10.0),
  ('Cavolfiori', 1000, 'products/cavolfiori.jpg', 'Vegetali', 'Cavolfiori bianchi e nutrienti, perfetti per zuppe e contorni.', 'nutrienti da specificare', 10.0),
  ('Broccoli', 1000, 'products/broccoli.jpg', 'Vegetali', 'Broccoli verdi e ricchi di antiossidanti, ottimi al vapore o in padella.', 'nutrienti da specificare', 10.0),
  ('Finocchi', 1000, 'products/finocchi.jpg', 'Vegetali', 'Finocchi dal sapore anisato, ideali per insalate e contorni.', 'nutrienti da specificare', 10.0),
  ('Cetrioli', 1000, 'products/cetrioli.jpg', 'Vegetali', 'Cetrioli freschi e idratanti, perfetti per snack e insalate.', 'nutrienti da specificare', 10.0),
  ('Cipolle', 1000, 'products/cipolle.jpg', 'Vegetali', 'Cipolle aromatiche e versatili, ottime per sughi e stufati.', 'nutrienti da specificare', 10.0),
  ('Aglio', 1000, 'products/aglio.jpg', 'Vegetali', 'Aglio pungente e salutare, utilizzato in molte preparazioni.', 'nutrienti da specificare', 10.0),
  ('Carote', 1000, 'products/carote.jpg', 'Vegetali', 'Carote arancioni e ricche di betacarotene, ottime crude o cotte.', 'nutrienti da specificare',10.0),
  ('Kiwi', 1000, 'products/kiwi.jpg', 'Vegetali', 'Kiwi verdi e ricchi di vitamina C, perfetti per frullati e dessert.', 'nutrienti da specificare', 10.0),
  ('Arance', 1000, 'products/arance.jpg', 'Vegetali', 'Arance succose e dolci, ideali per spremute e gusti freschi.', 'nutrienti da specificare', 10.0),
  ('Ciliegie', 1000, 'products/ciliegie.jpg', 'Vegetali', 'Ciliegie rosse e dolci, ottime da sole o per dolci.', 'nutrienti da specificare', 10.0);

INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES
  ('Albicocche', 1000, 'products/albicocche.jpg', 'Vegetali', 'Albicocche arancioni e ricche di vitamina A, perfette per snack.', 'nutrienti da specificare', 10.0),
  ('Pesche', 1000, 'products/pesche.jpg', 'Vegetali', 'Pesche succose e profumate, ideali per macedonie e gelati.', 'nutrienti da specificare', 10.0),
  ('Patate Dolci', 1000, 'products/patate_dolci.jpg', 'Vegetali', 'Patate dolci arancioni e ricche di fibre, ottime al forno o in purea.', 'nutrienti da specificare', 8.0),
  ('Hamburger di Vitello', 250, 'products/hamburger_vitello.jpg', 'Carne', 'Hamburger di vitello succulenti e gustosi, perfetti per grigliate.', 'nutrienti da specificare', 7.5),
  ('Salsicce', 1000, 'products/salsicce.jpg', 'Carne', 'Salsicce aromatiche e saporite, ideali per cucinare al forno o alla griglia.', 'nutrienti da specificare', 6.0),
  ('Petto di Pollo Amadori', 250, 'products/petto_pollo.jpg', 'Carne', 'Petto di pollo tenero e magro, ottimo per piatti leggeri.', 'nutrienti da specificare', 8.5),
  ('Pancetta', 1000, 'products/pancetta.jpg', 'Carne', 'Pancetta affumicata e croccante, perfetta per insaporire molti piatti.', 'nutrienti da specificare', 6.0),
  ('Bistecca di Vitello', 250, 'products/bistecca_vitello.jpg', 'Carne', 'Bistecca di vitello succosa e pregiata, ideale per grigliate.', 'nutrienti da specificare', 8.0),
  ('Arista di Maiale', 1000, 'products/arista_maiale.jpg', 'Carne', 'Arista di maiale arrosto, ricca di sapore e perfetta per pranzi festivi.', 'nutrienti da specificare', 7.0),
  ('Costolette di Agnello', 250, 'products/costolette_agnello.jpg', 'Carne', 'Costolette di agnello tenere e aromatiche, ideali per cucina mediterranea.', 'nutrienti da specificare', 7.5),
  ('Pollo Aia', 250, 'products/pollo.jpg', 'Carne', 'Pollo fresco e versatile, utilizzato in molte ricette.', 'nutrienti da specificare', 8.5),
  ('Cotolette di Pollo Amadori', 250, 'products/cotolette_pollo.jpg', 'Carne', 'Cotolette di pollo croccanti e gustose, perfette per piatti veloci.', 'nutrienti da specificare', 7.0),
  ('Spinacine Aia', 250, 'products/spinacine.jpg', 'Carne', 'Spinacine di carne macinata, ideali per ripieni e sughi.', 'nutrienti da specificare', 7.0),
  ('Macinato', 250, 'products/macinato.jpg', 'Carne', 'Carne macinata fresca, utilizzata in molti piatti come ragù e polpette.', 'nutrienti da specificare', 7.5),
  ('Spiedini', 250, 'products/spiedini.jpg', 'Carne', 'Spiedini di carne mista, ideali per grigliate e barbecue.', 'nutrienti da specificare', 7.0),
  ('Arrosticini', 250, 'products/arrosticini.jpg', 'Carne', 'Arrosticini abruzzesi, gustosi e tradizionali.', 'nutrienti da specificare', 7.5),
  ('Trippa', 250, 'products/trippa.jpg', 'Carne', 'Trippa cucinata lentamente, ricca di sapore e perfetta per piatti rustici.', 'nutrienti da specificare', 5.0),
  ('Orata', 1000, 'products/orata.jpg', 'Pesce', 'Orata fresca e delicata, ideale per cucina mediterranea.', 'nutrienti da specificare', 8.0),
  ('Triglie', 1000, 'products/triglie.jpg', 'Pesce', 'Triglie rosse e saporite, ottime per zuppe e grigliate.', 'nutrienti da specificare', 8.5),
  ('Tonno Rio Mare', 200, 'products/tonno_rio_mare.jpg', 'Pesce', 'Tonno in scatola di alta qualità, ricco di proteine e omega-3.', 'nutrienti da specificare', 8.0),
  ('Filetti di Merluzzo', 1000, 'products/filetti_merluzzo.jpg', 'Pesce', 'Filetti di merluzzo bianco, ideali per cucina leggera.', 'nutrienti da specificare', 9.0),
  ('Calamari', 1000, 'products/calamari.jpg', 'Pesce', 'Calamari freschi e teneri, perfetti per fritti e insalate.', 'nutrienti da specificare', 8.0),
  ('Baccala', 1000, 'products/baccala.jpg', 'Pesce', 'Baccalà essiccato e salato, utilizzato in molte ricette tradizionali.', 'nutrienti da specificare', 7.5),
  ('Salmone', 1000, 'products/salmone.jpg', 'Pesce', 'Salmone affumicato e ricco di grassi sani, ottimo per antipasti.', 'nutrienti da specificare', 9.0),
  ('Sgombro Rio Mare', 1000, 'products/sgombro_rio_mare.jpg', 'Pesce', 'Sgombro in scatola, ricco di omega-3 e sapore intenso.', 'nutrienti da specificare', 8.0),
  ('Spigole', 1000, 'products/spigole.jpg', 'Pesce', 'Spigole fresche e delicate, ideali per cucina mediterranea.', 'nutrienti da specificare', 8.0),
  ('Tuck', 200, 'products/tuck.jpg', 'Snack', 'Snack croccante e gustoso, perfetto per spuntini veloci.', 'nutrienti da specificare', 7.0),
  ('Patatine Fonzies', 100, 'products/patatine_fonzies.jpg', 'Snack', 'Patatine ondulate e saporite, ideali per aperitivi.', 'nutrienti da specificare', 4.0),
  ('Taralli Pugliesi', 100, 'products/taralli_pugliesi.jpg', 'Snack', 'Taralli croccanti e tradizionali, ottimi da gustare con vino.', 'nutrienti da specificare', 6.0),
  ('Patate Classiche San Carlo', 250, 'products/patate_classiche.jpg', 'Snack', 'Patatine classiche e salate, perfette per accompagnare panini.', 'nutrienti da specificare', 5.0),
  ('Patate Rustiche San Carlo', 250, 'products/patate_rustiche.jpg', 'Snack', 'Patatine rustiche e speziate, ideali per aperitivi.', 'nutrienti da specificare', 5.0),
  ('Arachidi Cameo', 100, 'products/arachidi_cameo.jpg', 'Snack', 'Arachidi tostate e croccanti, ottime per spuntini salutari.', 'nutrienti da specificare', 6.5),
  ('Noci', 100, 'products/noci.jpg', 'Snack', 'Noci fresche e ricche di grassi sani, perfette per insalate.', 'nutrienti da specificare', 8.0),
  ('Nachos Doritos', 100, 'products/nachos_doritos.jpg', 'Snack', 'Nachos croccanti e speziati, ideali per accompagnare salse.', 'nutrienti da specificare', 5.5),
  ('Mandorle Sgusciate', 100, 'products/mandorle_sgusciate.jpg', 'Snack', 'Mandorle fresche e nutrienti, ottime da sole o per dolci.', 'nutrienti da specificare', 8.5),
  ('Gallette di riso scotti', 200, 'products/gallette_riso.jpg', 'Snack', 'Gallette di riso croccanti e leggere, perfette per spuntini.', 'nutrienti da specificare', 9.5),
  ('Gallette di mais scotti', 200, 'products/gallette_mais.jpg', 'Snack', 'Gallette di mais croccanti e senza glutine, ideali per chi ha intolleranze.', 'nutrienti da specificare', 9.0),
  ('Pop Corn', 200, 'products/pop_corn.jpg', 'Snack', 'Pop corn caldi e fragranti, perfetti per serate al cinema.', 'nutrienti da specificare', 6.0),
  ('Croccantelle Forno Damiani', 300, 'products/croccantelle_forno_damiani.jpg', 'Snack', 'Croccantelle al forno, leggere e gustose.', 'nutrienti da specificare', 7.0),
  ('Coca Cola', 1500, 'products/coca_cola.jpg', 'Bevande', 'Coca Cola classica, rinfrescante e frizzante.', 'nutrienti da specificare', 4.5),
  ('Coca Cola Zero', 1500, 'products/coca_cola_zero.jpg', 'Bevande', 'Coca Cola Zero senza zucchero, ideale per chi vuole evitare calorie.', 'nutrienti da specificare', 6.0),
  ('Fanta', 1500, 'products/fanta.jpg', 'Bevande', 'Fanta aranciata, dolce e frizzante.', 'nutrienti da specificare', 5.0),
  ('Sprite', 1500, 'products/sprite.jpg', 'Bevande', 'Sprite limonata, dissetante e leggera.', 'nutrienti da specificare', 5.0),
  ('Pepsi', 1500, 'products/pepsi.jpg', 'Bevande', 'Pepsi cola, dal sapore intenso.', 'nutrienti da specificare', 5.0);

INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES
  ('Pepsi Twist', 1500, 'products/pepsi_twist.jpg', 'Bevande', 'Pepsi Twist con aroma di limone, fresca e frizzante.', 'nutrienti da specificare', 5.5),
  ('Birra Heineken', 330, 'products/birra_heineken.jpg', 'Bevande', 'Birra Heineken, dal sapore equilibrato.', 'nutrienti da specificare', 4.0),
  ('Birra Peroni', 330, 'products/birra_peroni.jpg', 'Bevande', 'Birra Peroni, tipica italiana e dissetante.', 'nutrienti da specificare', 4.5),
  ('Birra Nastro azzurro', 330, 'products/birra_nastro_azzurro.jpg', 'Bevande', 'Birra Nastro Azzurro, elegante e leggera.', 'nutrienti da specificare', 4.2),
  ('Birra Corona', 330, 'products/birra_corona.jpg', 'Bevande', 'Birra Corona, dal sapore fresco e con una fetta di lime.', 'nutrienti da specificare', 4.0),
  ('Succo Pera Yoga', 1000, 'products/succo_pera_yoga.jpg', 'Bevande', 'Succo di pera Yoga, dolce e naturale.', 'nutrienti da specificare', 6.5),
  ('Succo Mela Yoga', 1000, 'products/succo_mela_yoga.jpg', 'Bevande', 'Succo di mela Yoga, ricco di vitamine.', 'nutrienti da specificare', 6.0),
  ('Succo Ananas Yoga', 1000, 'products/succo_ananas_yoga.jpg', 'Bevande', 'Succo di ananas Yoga, dolce e rinfrescante.', 'nutrienti da specificare', 6.5),
  ('Succo Albiccoca Yoga', 1000, 'products/succo_albicocca_yoga.jpg', 'Bevande', 'Succo di albicocca Yoga, ricco di vitamina C.', 'nutrienti da specificare', 6.5),
  ('Succo Arancia Rossa Bravo', 2000, 'products/succo_arancia_rossa_bravo.jpg', 'Bevande', 'Succo di arancia rossa Bravo, intenso e salutare.', 'nutrienti da specificare', 6.0),
  ('Tavernello Rosso', 1000, 'products/tavernello_rosso.jpg', 'Bevande', 'Vino rosso Tavernello, leggero e versatile.', 'nutrienti da specificare', 5.5),
  ('Tavernello Bianco', 1000, 'products/tavernello_bianco.jpg', 'Bevande', 'Vino bianco Tavernello, fresco e fruttato.', 'nutrienti da specificare', 5.5),
  ('Vino Rosso Aglianico', 750, 'products/vino_rosso_aglianico.jpg', 'Bevande', 'Vino rosso Aglianico, robusto e corposo.', 'nutrienti da specificare', 5.0),
  ('Vino Bianco Pecorino', 750, 'products/vino_bianco_pecorino.jpg', 'Bevande', 'Vino bianco Pecorino, aromatico e secco.', 'nutrienti da specificare', 5.5),
  ('Sofficini Pomodori e Mozzarella Findus', 250, 'products/sofficini_pomodori_mozzarella.jpg', 'Surgelati', 'Sofficini con ripieno di pomodori e mozzarella, perfetti per aperitivi.', 'nutrienti da specificare', 4.5),
  ('Croccole Findus', 1500, 'products/croccole_findus.jpg', 'Surgelati', 'Croccole di verdure miste, ideali per contorni.', 'nutrienti da specificare', 7.0),
  ('Pizza Margherita Buitoni', 1500, 'products/pizza_margherita_buitoni.jpg', 'Surgelati', 'Pizza Margherita con pomodoro e mozzarella, pronta in pochi minuti.', 'nutrienti da specificare', 6.0),
  ('Pizza Capricciosa Buitoni', 1500, 'products/pizza_capricciosa_buitoni.jpg', 'Surgelati', 'Pizza Capricciosa con prosciutto, funghi e olive.', 'nutrienti da specificare', 6.5),
  ('Pizza Tonno e Cipolla Buitoni', 1500, 'products/pizza_tonno_cipolla_buitoni.jpg', 'Surgelati', 'Pizza con tonno, cipolla e pomodoro.', 'nutrienti da specificare', 6.5),
  ('Pizza Quattro Formaggi Cameo', 1500, 'products/pizza_quattro_formaggi_cameo.jpg', 'Surgelati', 'Pizza con quattro formaggi, irresistibile per gli amanti del formaggio.', 'nutrienti da specificare', 6.5),
  ('Pizza Margherita Italpizza', 1500, 'products/pizza_margherita_italpizza.jpg', 'Surgelati', 'Pizza Margherita con ingredienti italiani di alta qualità.', 'nutrienti da specificare', 6.5),
  ('Pizza Diavola Buitoni', 1500, 'products/pizza_diavola_buitoni.jpg', 'Surgelati', 'Pizza Diavola con salame piccante e peperoncino.', 'nutrienti da specificare', 6.0),
  ('Bastoncini Findus', 1500, 'products/bastoncini_findus.jpg', 'Surgelati', 'Bastoncini di merluzzo sfilettato, avvolti in pangrattato dorato e croccante.', 'nutrienti da specificare', 7.0),
  ('Totani Fritti', 1500, 'products/totani_fritti.jpg', 'Surgelati', 'Totani freschi e fritti, perfetti per antipasti.', 'nutrienti da specificare', 6.0),
  ('Funghi Orogel', 1500, 'products/funghi_orogel.jpg', 'Surgelati', 'Funghi misti surgelati, ideali per risotti e sughi.', 'nutrienti da specificare', 7.5),
  ('Piselli Bonduelle', 1500, 'products/piselli_bonduelle.jpg', 'Surgelati', 'Piselli verdi surgelati, ricchi di fibre e proteine.', 'nutrienti da specificare', 8.0),
  ('Filetti Merluzzo Frosta', 1500, 'products/filetti_merluzzo_frosta.jpg', 'Surgelati', 'Filetti di merluzzo surgelati, perfetti per cucina leggera.', 'nutrienti da specificare', 8.0),
  ('Patatine Pizzoli', 1500, 'products/patatine_pizzoli.jpg', 'Surgelati', 'Patatine fritte surgelate, croccanti e gustose.', 'nutrienti da specificare', 6.0),
  ('Verdure Campagnole Orogel', 1500, 'products/verdure_campagnole_orogel.jpg', 'Surgelati', 'Verdure miste surgelate, ideali per contorni.', 'nutrienti da specificare', 7.5),
  ('Contorno Grigliato Orogel', 1500, 'products/contorno_grigliato_orogel.jpg', 'Surgelati', 'Verdure grigliate surgelate, pronte in pochi minuti.', 'nutrienti da specificare', 8.0),
  ('Verdurì Orogel', 1500, 'products/verduri_orogel.jpg', 'Surgelati', 'Verdure surgelate, ideali per minestre e zuppe.', 'nutrienti da specificare', 8.0),
  ('Sofficini Prosciutto e Formaggio Findus', 250, 'products/sofficini_prosciutto_formaggio.jpg', 'Surgelati', 'Sofficini con ripieno di prosciutto e formaggio, perfetti per aperitivi.', 'nutrienti da specificare', 5.0),
  ('Sofficini Funghi e Mozzarella Findus', 250, 'products/sofficini_funghi_mozzarella.jpg', 'Surgelati', 'Sofficini con ripieno di funghi e mozzarella, irresistibili.', 'nutrienti da specificare', 5.0),
  ('Flauti Mulino Bianco', 1500, 'products/flauti_mulino_bianco.jpg', 'Dolci', 'Flauti di pasta sfoglia con ripieno di crema, perfetti per colazione.', 'nutrienti da specificare', 5.0),
  ('Pangoccioli Mulino Bianco', 1500, 'products/pangoccioli_mulino_bianco.jpg', 'Dolci', 'Pangoccioli soffici e dolci, ideali per merenda.', 'nutrienti da specificare', 5.0),
  ('Plumcake Mulino Bianco', 1500, 'products/plumcake_mulino_bianco.jpg', 'Dolci', 'Plumcake morbido e profumato, perfetto per la colazione.', 'nutrienti da specificare', 5.0),
  ('Kinder Fetta a Latte', 1500, 'products/kinder_fetta_latte.jpg', 'Dolci', 'Kinder Fetta al Latte, goloso e irresistibile.', 'nutrienti da specificare', 5.0),
  ('Kinder Pingui', 1500, 'products/kinder_pingui.jpg', 'Dolci', 'Kinder Pingui, dolcetti al cioccolato e crema.', 'nutrienti da specificare', 5.0),
  ('Barette Kinder', 1500, 'products/barette_kinder.jpg', 'Dolci', 'Barette di cioccolato Kinder, ideali per la merenda.', 'nutrienti da specificare', 5.0),
  ('Mikado', 1500, 'products/mikado.jpg', 'Dolci', 'Mikado al cioccolato, croccanti e divertenti da gustare.', 'nutrienti da specificare', 5.0),
  ('Wafer Loacker', 1500, 'products/wafer_loacker.jpg', 'Dolci', 'Wafer Loacker, sottili e friabili.', 'nutrienti da specificare', 5.0);

INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES
  ('Cioccolata Bianca Novi', 1500, 'products/cioccolata_bianca_novi.jpg', 'Dolci', 'Cioccolata bianca Novi, delicata e cremosa.', 'nutrienti da specificare', 5.0),
  ('Cioccola Fondente Novi', 1500, 'products/cioccolata_fondente_novi.jpg', 'Dolci', 'Cioccolata fondente Novi, intensa e profumata.', 'nutrienti da specificare', 5.0),
  ('Gocciole Pavesi', 1500, 'products/gocciole_pavesi.jpg', 'Dolci', 'Gocciole Pavesi, biscotti al cacao con gocce di cioccolato.', 'nutrienti da specificare', 5.0),
  ('Abbracci Mulino Bianco', 1500, 'products/abbracci_mulino_bianco.jpg', 'Dolci', 'Abbracci Mulino Bianco, biscotti con doppia frolla.', 'nutrienti da specificare', 5.0),
  ('Grisby', 1500, 'products/grisby.jpg', 'Dolci', 'Grisby, biscotti al burro con zucchero a velo.', 'nutrienti da specificare', 5.0),
  ('Cornetti Tre Marie', 1500, 'products/cornetti_tre_marie.jpg', 'Dolci', 'Cornetti Tre Marie, soffici e golosi.', 'nutrienti da specificare', 5.0),
  ('Brownie Milka', 1500, 'products/milka.jpg', 'Dolci', 'Tavoletta di cioccolato Milka, irresistibile e cremosa.', 'nutrienti da specificare', 5.0);

INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES
  ('Pesto Barilla', 500, 'products/pesto_barilla.jpg', 'Dispensa', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 7.0),
  ('Farina 00 Barilla', 500, 'products/farina_00_barilla.jpg', 'Dispensa', 'Farina 00 Barilla, ideale per impasti lievitati e pasta fresca.', 'nutrienti da specificare', 8.5),
  ('Uova', 500, 'products/uova.jpg', 'Dispensa', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 9.0),
  ('Passata di pomodoro Mutti', 500, 'products/passata_pomodoro_mutti.jpg', 'Dispensa', 'Passata di pomodoro Mutti, perfetta per sughi e salse.', 'nutrienti da specificare', 7.5),
  ('Fagioli Valfrutta', 500, 'products/fagioli_valfrutta.jpg', 'Dispensa', 'Fagioli Valfrutta, ricchi di fibre e proteine.', 'nutrienti da specificare', 8.5),
  ('Mais Valfrutta', 500, 'products/mais_valfrutta.jpg', 'Dispensa', 'Mais Valfrutta, ideale per insalate e contorni.', 'nutrienti da specificare', 8.5),
  ('Riso Scotti', 500, 'products/riso_scotti.jpg', 'Dispensa', 'Riso Scotti, perfetto per risotti e piatti a base di riso.', 'nutrienti da specificare', 10.0),
  ('Pelati Cirio', 500, 'products/pelati_cirio.jpg', 'Dispensa', 'Pelati Cirio, pomodori pelati di alta qualità.', 'nutrienti da specificare', 7.5),
  ('Ragù alla bolognese De Cecco', 500, 'products/ragu_bolognese_de_cecco.jpg', 'Dispensa', 'Ragù alla bolognese De Cecco, pronto per condire la tua pasta.', 'nutrienti da specificare', 7.0),
  ('Salsa Cacio e Pepe Biffi', 500, 'products/salsa_cacio_pepe_biffi.jpg', 'Dispensa', 'Salsa Cacio e Pepe Biffi, dal gusto intenso e cremoso.', 'nutrienti da specificare', 7.0),
  ('Pesto alle noci Rana', 500, 'products/pesto_noci_rana.jpg', 'Dispensa', 'Pesto alle noci Rana, aromatico e ricco di sapore.', 'nutrienti da specificare', 7.0),
  ('Pan bauletto Mulino Bianco', 500, 'products/pan_bauletto_mulino_bianco.jpg', 'Dispensa', 'Pan bauletto Mulino Bianco, perfetto per tramezzini e toast.', 'nutrienti da specificare', 7.5),
  ('American Texas Toast Morato', 500, 'products/american_texas_toast_morato.jpg', 'Dispensa', 'American Texas Toast Morato, fette di pane tostate e spesse.', 'nutrienti da specificare', 7.5),
  ('Marmellata di lamponi Zueg', 500, 'products/marmellata_lamponi_zueg.jpg', 'Dispensa', 'Marmellata di lamponi Zueg, dolce e fruttata.', 'nutrienti da specificare', 8.5),
  ('Marmellata di albicocca Zueg', 500, 'products/marmellata_albicocca_zueg.jpg', 'Dispensa', 'Marmellata di albicocca Zueg, perfetta per la colazione.', 'nutrienti da specificare', 8.5),
  ('Marmellata di frutti rossi Zueg', 500, 'products/marmellata_frutti_rossi_zueg.jpg', 'Dispensa', 'Marmellata di frutti rossi Zueg, perfetta per colazioni e merende.', 'nutrienti da specificare', 8.5),
  ('Marmellata di fragole Santa Rosa', 500, 'products/marmellata_fragole_santa_rosa.jpg', 'Dispensa', 'Marmellata di fragole Santa Rosa, dolce e profumata.', 'nutrienti da specificare', 8.5),
  ('Nutella Ferrero', 500, 'products/nutella_ferrero.jpg', 'Dispensa', 'Nutella Ferrero, crema di cioccolato e nocciole.', 'nutrienti da specificare', 4.5),
  ('CremaNovi alla nocciola', 500, 'products/crema_novi_nocciola.jpg', 'Dispensa', 'Crema alla nocciola Novi, irresistibile e cremosa.', 'nutrienti da specificare', 5.5);

INSERT INTO products (Nome, peso, image, category, description, nutrients) VALUES
  ('Sapone Nivea', 200, 'products/sapone_nivea.jpg', 'Igiene e Casa', 'Sapone idratante per una pulizia delicata.', 'Acqua, Sodio Laureth Solfato, Glicerina'),
  ('Shampoo Head & Shoulders', 500, 'products/shampoo_head_shoulders.jpg', 'Igiene e Casa', 'Shampoo antiforfora con mentolo per un cuoio capelluto fresco e pulito.', 'Piritione di zinco, Mentolo, Acqua'),
  ('Bagnoschiuma Dove', 400, 'products/bagnoschiuma_dove.jpg', 'Igiene e Casa', 'Bagnoschiuma idratante per una pelle morbida e vellutata.', 'Glicerina, Acqua, Cocamidopropyl Betaina'),
  ('Dopobarba Gillette Fusion', 150, 'products/dopobarba_gillette.jpg', 'Igiene e Casa', 'Dopobarba lenitivo per una pelle protetta dopo la rasatura.', 'Alcool Denat, Profumo, Acqua'),
  ('Schiuma da barba Proraso', 200, 'products/schiuma_barba_proraso.jpg', 'Igiene e Casa', 'Schiuma da barba con mentolo per una rasatura fresca e confortevole.', 'Olio di Eucalipto, Olio di Menta Piperita, Glicerina'),
  ('Lamette Wilkinson Sword', 50, 'products/lamette_wilkinson.jpg', 'Igiene e Casa', 'Lamette con tripla lama per una rasatura precisa e confortevole.', 'Acciaio inossidabile, Plastica'),
  ('Assorbenti Lines Ultra Sottili', 100, 'products/assorbenti_lines.jpg', 'Igiene e Casa', 'Assorbenti ultra sottili per una protezione discreta e confortevole.', 'Polimero super assorbente, Copertura esterna in cotone'),
  ('Tampax Compak', 80, 'products/tampax_compak.jpg', 'Igiene e Casa', 'Assorbenti interni compatti per una protezione sicura e confortevole.', 'Fibra di Rayon, Copertura in poliestere'),
  ('Preservativi Durex Love', 10, 'products/preservativi_durex.jpg', 'Igiene e Casa', 'Preservativi lubrificati per un piacere naturale e sicuro.', 'Lattice di gomma naturale, Silicone'),
  ('Candeggina Ace', 1000, 'products/candeggina_ace.jpg', 'Igiene e Casa', 'Candeggina con formula antibatterica per una pulizia profonda e igienica.', 'Ipercloro, Acqua, Soda Caustica'),
  ('Scottex Classico', 300, 'products/scottex_classico.jpg', 'Igiene e Casa', 'Carta igienica resistente e morbida per igiene quotidiana.', 'Pulpa di cellulosa, Acqua'),
  ('Carta Igienica Regina', 500, 'products/carta_igienica_regina.jpg', 'Igiene e Casa', 'Carta igienica con struttura goffrata per una maggiore resistenza e morbidezza.', 'Pulpa di cellulosa, Amido'),
  ('Dentifricio Colgate Total', 150, 'products/dentifricio_colgate.jpg', 'Igiene e Casa', 'Dentifricio con formula antibatterica per una protezione completa della bocca.', 'Fluoruro di Sodio, Silice'),
  ('Spazzolino Oral-B CrossAction', 50, 'products/spazzolino_oral_b.jpg', 'Igiene e Casa', 'Spazzolino con setole a croce per una pulizia profonda e efficace.', 'Plastica, Nylon'),
  ('Shampoo Garnier Fructis', 400, 'products/shampoo_garnier_fructis.jpg', 'Igiene e Casa', 'Shampoo rinforzante con estratti di frutta per capelli più forti e lucenti.', 'Estratto di mela, Estratto di limone, Pantenolo'),
  ('Shampoo Sunsilk Brillantezza', 300, 'products/shampoo_sunsilk.jpg', 'Igiene e Casa', 'Shampoo con agenti illuminanti per capelli più luminosi e setosi.', 'Olio di Argan, Proteine della seta, Pantenolo'),
  ('Detersivo Dash Freschezza', 1000, 'products/detersivo_dash.jpg', 'Igiene e Casa', 'Detersivo concentrato per un bucato fresco e profumato a lungo.', 'Tensioattivi anionici, Enzimi, Profumo'),
  ('Ammorbidente Lenor Primavera', 500, 'products/ammo_bounce.jpg', 'Igiene e Casa', 'Ammorbidente con fragranze floreali per tessuti morbidi e profumati.', 'Quaternario di ammonio, Profumo'),
  ('Sgrassatore Cif Power & Shine', 750, 'products/sgrassatore_cif.jpg', 'Igiene e Casa', 'Sgrassatore con formula potente per una pulizia brillante e senza sforzo.', 'Tensioattivi non ionici, Solventi alcalini'),
  ('Ammorbidente Bounce', 500, 'products/ammo_bounce.jpg', 'Igiene e Casa', 'Ammorbidente con profumo di primavera per tessuti morbidi e freschi.', 'Quaternario di ammonio, Profumo');
  
INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES
  ('Pecorino Biraghi', 100, 'products/Pecorino_Biraghi.jpg', 'Salumi e Formaggi', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 7.0),
  ('Guanciale Beretta', 100, 'products/Guanciale_Beretta.jpg', 'Salumi e Formaggi', 'Farina 00 Barilla, ideale per impasti lievitati e pasta fresca.', 'nutrienti da specificare', 6.5),
  ('Prosciutto Crudo Negroni', 100, 'products/prosciutto_crudo_negroni.jpg', 'Salumi e Formaggi', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 7.0),
  ('Prosciutto Crudo Parma', 100, 'products/prosciutto_crudo_parma.jpg', 'Salumi e Formaggi', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 7.0),
  ('Parmigiano Parmareggio', 100, 'products/parmigiano_parmareggio.jpg', 'Salumi e Formaggi', 'Farina 00 Barilla, ideale per impasti lievitati e pasta fresca.', 'nutrienti da specificare', 7.0),
  ('Philadelphia', 100, 'products/philadelphia.jpg', 'Salumi e Formaggi', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 7.0),
  ('Philadelphia light', 100, 'products/philadelphia_light.jpg', 'Salumi e Formaggi', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 8.0),
  ('Pancetta Beretta', 100, 'products/pancetta_beretta.jpg', 'Salumi e Formaggi', 'Farina 00 Barilla, ideale per impasti lievitati e pasta fresca.', 'nutrienti da specificare', 6.5),
  ('Mortadella Fiorucci', 100, 'products/mortadella_fiorucci.jpg', 'Salumi e Formaggi', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 6.0),
  ('Salame Milano Negroni', 100, 'products/salame_milano_negroni.jpg', 'Salumi e Formaggi', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 7.0),
  ('Prosciutto Cotto Parmacotto', 100, 'products/prosciutto_cotto_parmacotto.jpg', 'Salumi e Formaggi', 'Farina 00 Barilla, ideale per impasti lievitati e pasta fresca.', 'nutrienti da specificare', 6.5),
  ('Prosciutto Cotto Citterio', 100, 'products/prosciutto_cotto_citterio.jpg', 'Salumi e Formaggi', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 7.0),
  ('Petto di Tacchino Aia', 100, 'products/petto_di_tacchino_aia.jpg', 'Salumi e Formaggi', 'Farina 00 Barilla, ideale per impasti lievitati e pasta fresca.', 'nutrienti da specificare', 8.5),
  ('Asiago Ferrari', 100, 'products/asiago_ferrari.jpg', 'Salumi e Formaggi', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 6.0),
  ('Leerdammer Original', 100, 'products/leerdammer_original.jpg', 'Salumi e Formaggi', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 7.0),
  ('Sottilette Classiche', 100, 'products/sottilette_classiche.jpg', 'Salumi e Formaggi', 'Farina 00 Barilla, ideale per impasti lievitati e pasta fresca.', 'nutrienti da specificare', 6.5),
  ('Sottilette light', 100, 'products/sottilette_light.jpg', 'Salumi e Formaggi', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 8.0);
  
INSERT INTO products (Nome, peso, image, category, description, nutrients, health) VALUES
  ('Dado Classico Star ', 100, 'products/dado_classico_star.jpg', 'Dispensa', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 5.0),
  ('Dado Vegetale Star ', 100, 'products/dado_vegetale_star.jpg', 'Dispensa', 'Pesto alla Genovese Barilla, unione perfetta tra basilico fresco italiano e Parmigiano Reggiano DOP.', 'nutrienti da specificare', 5.0),
  ('Insaporitore Ariosto', 50, 'products/insaporitore_ariosto.jpg', 'Dispensa', 'Uova fresche, ricche di proteine e versatili in cucina.', 'nutrienti da specificare', 7.0),
  ('Olio Monini', 1000, 'products/olio_monini.jpg', 'Dispensa', 'Passata di pomodoro Mutti, perfetta per sughi e salse.', 'nutrienti da specificare', 6.0),
  ('Olio De Cecco', 500, 'products/olio_de_cecco.jpg', 'Dispensa', 'Fagioli Valfrutta, ricchi di fibre e proteine.', 'nutrienti da specificare', 6.0),
  ('Bucatini Rummo', 500, 'products/bucatini_rummo.jpg', 'Dispensa', 'Mais Valfrutta, ideale per insalate e contorni.', 'nutrienti da specificare', 7.0),
  ('Fusilli Integrali Barilla', 500, 'products/fusilli_integrali_barilla.jpg', 'Dispensa', 'Riso Scotti, perfetto per risotti e piatti a base di riso.', 'nutrienti da specificare', 9.0),
  ('Penne Integrali De Cecco', 500, 'products/penne_integrali_de_cecco.jpg', 'Dispensa', 'Pelati Cirio, pomodori pelati di alta qualità.', 'nutrienti da specificare', 9.0),
  ('Tortellini Barilla', 500, 'products/tortellini_barilla.jpg', 'Dispensa', 'Ragù alla bolognese De Cecco, pronto per condire la tua pasta.', 'nutrienti da specificare', 7.0),
  ('Sfogliagrezza Rana', 500, 'products/sfogliagrezza_rana.jpg', 'Dispensa', 'Salsa Cacio e Pepe Biffi, dal gusto intenso e cremoso.', 'nutrienti da specificare', 7.0),
  ('Sale Italkali', 500, 'products/sale_italkali.jpg', 'Dispensa', 'Pesto alle noci Rana, aromatico e ricco di sapore.', 'nutrienti da specificare', 6.0),
  ('Zucchero Eridania', 500, 'products/zucchero_eridania.jpg', 'Dispensa', 'Pan bauletto Mulino Bianco, perfetto per tramezzini e toast.', 'nutrienti da specificare', 6.0),
  ('Caffè Kimbo ', 250, 'products/caffe_kimbo.jpg', 'Dispensa', 'American Texas Toast Morato, fette di pane tostate e spesse.', 'nutrienti da specificare', 6.5),
  ('Vincezovo Savoiardi', 300, 'products/vincenzovo_savoiardi.jpg', 'Dolci', 'Marmellata di lamponi Zueg, dolce e fruttata.', 'nutrienti da specificare', 6.5),
  ('Cacao Perugina', 200, 'products/cacao_perugina.jpg', 'Dispensa', 'Marmellata di albicocca Zueg, perfetta per la colazione.', 'nutrienti da specificare', 6.5),
  ('Rosmarino Cannamela', 100, 'products/rosmarino_cannamela.jpg', 'Dispensa', 'Marmellata di frutti rossi Zueg, perfetta per colazioni e merende.', 'nutrienti da specificare', 7.0),
  ('Misura Privolat', 400, 'products/misura_privolat.jpg', 'Dolci', 'Marmellata di fragole Santa Rosa, dolce e profumata.', 'nutrienti da specificare', 8.5),
  ('Oro Saiwa', 300, 'products/oro_saiwa.jpg', 'Dispensa', 'Nutella Ferrero, crema di cioccolato e nocciole.', 'nutrienti da specificare', 4.5),
  ('Sedano', 1000, 'products/Sedano.jpg', 'Vegetali', 'Crema alla nocciola Novi, irresistibile e cremosa.', 'nutrienti da specificare', 9.0);
  ('Pepe Nero Cannamela', 100, 'products/pepe_nero_cannamela.jpg', 'Dispensa', 'Marmellata di frutti rossi Zueg, perfetta per colazioni e merende.', 'nutrienti da specificare', 6.5),
  ('Besciamella Chef', 250, 'products/besciamella_chef.jpg', 'Dispensa', 'Marmellata di frutti rossi Zueg, perfetta per colazioni e merende.', 'nutrienti da specificare', 6.5);
  


CREATE TABLE Cart (
 Nome varchar(255) NOT NULL,
 Quantità int(11) NOT NULL,
 Categoria varchar(255) NOT NULL,
 Immagine varchar(255) NOT NULL,
 PRIMARY KEY (Nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
--- FINO A QUA TUTTO FUNZIONANTE ---

CREATE TABLE recipes (
  name VARCHAR(255) PRIMARY KEY,
  image VARCHAR(255),
  category VARCHAR(50),
  description TEXT,
  FOREIGN KEY (category) REFERENCES categories(name)
);

CREATE TABLE recipe_ingredients (
  recipe_name VARCHAR(255),
  ingredient VARCHAR(255),
  PRIMARY KEY (recipe_name, ingredient),
  FOREIGN KEY (recipe_name) REFERENCES recipes(name),
  FOREIGN KEY (ingredient) REFERENCES products(name)
);





-- Inserting recipes
INSERT INTO recipes (name, image, category, description) VALUES
('Pasta Carbonara', 'recipes/carbonara.jpg', 'Pasta', 'Classic Roman pasta dish with eggs, pancetta, and cheese'),
('Italian Tiramisu', 'recipes/tiramisu.jpg', 'Dessert', 'Elegant Italian dessert with layers of mascarpone cheese and ladyfingers soaked in coffee'),
('Lasagna alla Bolognese', 'recipes/lasagna.jpg', 'Pasta', 'Rich and hearty pasta dish with layers of pasta, Bolognese sauce, and cheese');

-- Inserting recipe ingredients
INSERT INTO recipe_ingredients (recipe_name, ingredient) VALUES
('Pasta Carbonara', 'Spaghetti'),
('Pasta Carbonara', 'Eggs'),
('Pasta Carbonara', 'Pancetta'),
('Pasta Carbonara', 'Parmesan Cheese'),
('Italian Tiramisu', 'Ladyfingers'),
('Italian Tiramisu', 'Mascarpone Cheese'),
('Italian Tiramisu', 'Cocoa Powder'),
('Lasagna alla Bolognese', 'Spaghetti'),
('Lasagna alla Bolognese', 'Bolognese Sauce'),
('Lasagna alla Bolognese', 'Parmesan Cheese');


CREATE TABLE supermarkets_products AS
SELECT 
    s.name AS supermarket_name, 
    s.chain AS supermarket_chain, 
    p.name AS product_name, 
    ROUND(RAND() * 10 + 1, 2) AS price
FROM 
    supermarkets s 
CROSS JOIN 
    products p;


