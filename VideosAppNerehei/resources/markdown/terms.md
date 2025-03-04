# Resum dels dos sprints

## Objectiu principal
El principal objectiu és desenvolupar una aplicació web similar a YouTube que permeti crear usuaris, gestionar vídeos i llistes. Aquesta aplicació es desenvoluparà durant el curs a través de diversos sprints.

---

## Sprint 1
- Es va iniciar el projecte amb Laravel i es van configurar les opcions necessàries (Jetstream, Livewire, PHPUnit, SQLite).
- Es van crear tests per a comprovar la funcionalitat dels *helpers*, incloent la creació d’usuaris per defecte (usuari genèric i professor). Els usuaris s’han associat a un *team*.
- Es van configurar credencials per defecte a la carpeta `config` i al fitxer `.env`.
- Es va seguir la metodologia TDD i AAA per a implementar i documentar els tests.

---

## Sprint 2
- Es van corregir els errors detectats al 1r sprint i es van configurar els tests perquè utilitzin una base de dades temporal.
- Es va crear la migració i el model de vídeos amb atributs com: id, títol, descripció, URL, data de publicació i referències a altres vídeos (*previous*, *next*) i a una sèrie (*series_id*).
- Es van implementar funcions al model per formatar la data de publicació amb la llibreria Carbon.
- Es va desenvolupar el controlador i les vistes per mostrar els vídeos (incloent la ruta *show*).
- Es van afegir usuaris i vídeos per defecte al *DatabaseSeeder*.
- Es va implementar un nou *layout* i es van afegir funcionalitats als *helpers*.
- Es van crear tests de funcionalitat per verificar la visualització de vídeos i comprovar el comportament amb vídeos inexistents.
- Es va instal·lar i configurar Larastan per analitzar el codi, detectar errors i corregir-los.

Aquest treball permet establir una base sòlida per a continuar desenvolupant funcionalitats més avançades als propers sprints.


## Sprint 3
- En aquest sprint s'han realitzat les següents tasques principals:

- Correcció d'errors del 2n sprint.
- Gestió de permisos: Instal·lació del paquet spatie/laravel-permission i definició dels permisos per als diferents rols d'usuari.
- Modificació del model d’usuaris: Creació de la migració per afegir el camp super_admin, i implementació de les funcions testedBy() i isSuperAdmin().
- Creació i gestió d'usuaris:
- Modificació de create_default_professor per afegir el rol de superadmin.
- Nova funció add_personal_team() per gestionar la creació d’equips.
- Creació de funcions per generar usuaris predeterminats:
- create_regular_user()
- create_video_manager_user()
- create_superadmin_user()
- Definició de permisos i portes d’accés a AppServiceProvider.
- Actualització del DatabaseSeeder amb permisos i usuaris per defecte (superadmin, regular user, video manager).
- Publicació i personalització dels stubs en Laravel.
- Tests:
- VideosManageControllerTest a tests/Feature/Videos, amb proves sobre la gestió de vídeos segons els permisos.
- UserTest a tests/Unit, per comprovar la funció isSuperAdmin().
- Verificació de codi amb Larastan per garantir qualitat i seguretat.

## Sprint 4
- Tasques realitzades:

- Corregir errors del 3r sprint: S'han corregit els errors detectats, especialment aquells relacionats amb els permisos d'accés a la ruta /videos_manage.

- Crear el controlador VideosManageController: Es van implementar les funcions index, store, show, edit, update, delete i destroy per a la gestió de vídeos mitjançant CRUD.

- Afegir la funció index al VideosController: Es va implementar la funció index per mostrar els vídeos disponibles.

- Afegir vídeos de prova: Es va garantir que estiguessin creats tres vídeos de prova en els helpers i que es trobessin al DatabaseSeeder.

- Crear vistes per al CRUD de vídeos:

- index.blade.php: mostra la taula de vídeos.
- create.blade.php: formulari per afegir vídeos amb l'atribut data-qa.
- edit.blade.php: permet editar vídeos existents.
- delete.blade.php: confirmació per eliminar vídeos.
- Vista de vídeos a la pàgina principal: Es va crear la vista index.blade.php per mostrar tots els vídeos de manera semblant a YouTube, amb enllaços per veure el detall de cada vídeo.

- Modificació de tests:

- Es va modificar el test user_with_permissions_can_manage_videos() per assegurar-se que els vídeos estiguin correctament gestionats.
- Es van crear nous tests per comprovar el comportament de l'aplicació amb diferents tipus d'usuari.
- Afegir permisos per la gestió de vídeos: Es van afegir els permisos per a la gestió de vídeos als helpers i es van assignar als usuaris corresponents.

- Afegir funcions de test a VideosManageControllerTest: Es van crear tests per verificar que els usuaris amb permisos poden afegir, actualitzar i eliminar vídeos.

- Creació de rutes per al CRUD de vídeos: Les rutes per al CRUD de vídeos es van protegir amb els permisos corresponents, assegurant que només els usuaris autenticats i amb permisos puguin accedir-hi.

- Navbar i footer: Es va afegir un navbar i un footer a la plantilla resources/layouts/videosapp, permetent la navegació entre pàgines.

- Actualització de la documentació: Es va afegir la informació corresponent d’aquest sprint a la documentació del projecte en resources/markdown/terms.

- Revisió de codi amb Larastan: Es va revisar el codi mitjançant Larastan per assegurar la seva qualitat i seguretat.
